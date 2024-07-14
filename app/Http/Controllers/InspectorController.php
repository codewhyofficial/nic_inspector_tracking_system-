<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class InspectorController extends Controller
{
    public function showAddInspectorPage()
    {
        return view('inspector.addInspector');
    }

    public function showUpdateInspectorPage()
    {
        return view('inspector.updateInspector');
    }

    public function Add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required|email',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'nationality' => 'required|string|max:255',
            'placeofbirth' => 'required|string|max:255',
            'passport' => 'required|string|size:9|regex:/^[A-Z][0-9]{8}$/',
            'unlp' => 'required|string|size:9|regex:/^[A-Z]{2}[0-9]{7}$/',
            'rank' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'clearance' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'remarks' => 'nullable|string|max:1000',
            'captcha_code' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('addInspector')->withErrors($validator)->withInput($request->all());
        }

        $captcha_code = $request->captcha_code;
        if (!Session::has('captcha_code') || empty($captcha_code) || strtolower($captcha_code) !== strtolower(Session::get('captcha_code'))) {
            // Captcha validation failed
            return redirect()->route('addInspector')
                ->withErrors(['captcha_code' => 'The captcha code entered is incorrect.'])
                ->withInput($request->all());
        }

        // check if the user exists
        $existingUser = DB::select('SELECT * FROM user_login WHERE user_id = ?', [$request->userid]);
        if (!empty($existingUser)) {
            return redirect()->route('addInspector')
                ->withErrors(['userid' => 'This userid already exists'])
                ->withInput($request->all());
        }

        $password = Str::random(12);
        $hashedPassword = hash('sha256', $password);

        // Generate a unique UUID
        $uiid = Uuid::uuid4()->toString();

        // Check if UUID already exists in inspector table
        $uiidExists = DB::select('SELECT * FROM user_login WHERE uiid = ?', [$uiid]);
        while (!empty($uiidExists)) {
            // If UUID exists, generate a new one until unique
            $uiid = Uuid::uuid4()->toString();
            $uiidExists = DB::select('SELECT * FROM user_login WHERE uiid = ?', [$uiid]);
        }

        try {

            // Insert into user_login table using raw SQL
            DB::insert('INSERT INTO user_login (user_id, UIID, password) VALUES (?, ?, ?)', [$request->userid, $uiid, $hashedPassword]);

            // Now insert into inspector table using raw SQL
            DB::insert('INSERT INTO inspector (UIID, name, gender, DOB, nationality, place_of_birth, passport_number, UNLP_number, inspector_rank, qualification, professional_experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $uiid,
                $request->name,
                $request->gender,
                $request->dob,
                $request->nationality,
                $request->placeofbirth,
                $request->passport,
                $request->unlp,
                $request->rank,
                $request->qualification,
                $request->experience,
            ]);
            
            // sending mail to user with login credentials after successfull account creation 
            $mailData = [
                'userid' => $request->userid,
                'password' => $password
            ];
            Mail::to($request->userid)->send(new AccountCreated($mailData));

            return redirect()->intended('/inspector/update');
            
        } catch (\Exception $e) {
            return redirect()->route('addInspector')
                ->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])
                ->withInput($request->all());
        }
    }
}

