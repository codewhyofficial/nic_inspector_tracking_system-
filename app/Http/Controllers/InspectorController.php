<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;
use Ramsey\Uuid\Uuid;

class InspectorController extends Controller
{
    public function showAddInspectorPage()
    {
        return view('inspector.addInspector');
    }

    public function showUpdateInspectorPage($uiid)
    {
        $inspector = DB::selectOne('SELECT * FROM inspector WHERE uiid = ?', [$uiid]);

        return view('inspector.updateInspector', compact('inspector'));
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        
        $result = DB::select("SELECT 1 FROM user_login WHERE email = ? LIMIT 1", [$email]);

        // Check if the result is not empty
        $exists = !empty($result);

        return response()->json(['exists' => $exists]);
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
        $existingUser = DB::select('SELECT * FROM user_login WHERE email = ?', [$request->userid]);
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
            // Insert into user_login table
            DB::insert('INSERT INTO user_login (email, uiid, password, name) VALUES (?, ?, ?, ?)', [$request->userid, $uiid, $hashedPassword, $request->name]);

            // Now insert into inspector table
            DB::insert('INSERT INTO inspector (uiid, name, gender, DOB, nationality, place_of_birth, passport_number, UNLP_number, inspector_rank, qualification, professional_experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
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

        } catch (\Exception $e) {
            return redirect()->route('addInspector')
            ->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])
            ->withInput($request->all());
        }
        return redirect()->route('admin')->with('success', 'new inspector registered successfully.');
    }

    public function Update(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            'remarks' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->route('updateInspector', ['uiid' => $request->uiid])->withErrors($validator)->withInput($request->all());
        }

        $captcha_code = $request->captcha_code;
        if (!Session::has('captcha_code') || empty($captcha_code) || strtolower($captcha_code) !== strtolower(Session::get('captcha_code'))) {
            // Captcha validation failed
            return redirect()->route('updateInspector', ['uiid' => $request->uiid])
                ->withErrors(['captcha_code' => 'The captcha code entered is incorrect.'])
                ->withInput($request->all());
        }

        try {
            DB::update(
                'UPDATE inspector SET 
                name = ?, 
                gender = ?, 
                DOB = ?, 
                nationality = ?, 
                place_of_birth = ?, 
                passport_number = ?, 
                UNLP_number = ?, 
                inspector_rank = ?, 
                qualification = ?, 
                professional_experience = ?, 
                remarks = ?
            WHERE uiid = ?',
                [
                    $request->input('name'),
                    $request->input('gender'),
                    $request->input('dob'),
                    $request->input('nationality'),
                    $request->input('placeofbirth'),
                    $request->input('passport'),
                    $request->input('unlp'),
                    $request->input('rank'),
                    $request->input('qualification'),
                    $request->input('experience'),
                    $request->input('remarks'),
                    $request->uiid,
                ]
            );

            DB::update('UPDATE user_login SET name = ? WHERE uiid = ?', [$request->input('name'), $request->uiid]);
            DB::update('UPDATE inspection SET name = ? WHERE uiid = ?', [$request->input('name'), $request->uiid]);
        } catch (\Exception $e) {
            return redirect()->route('updateInspector', ['uiid' => $request->uiid])
                ->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])
                ->withInput($request->all());
        }

        Session::put('name', $request->name);

        if (Session::get('role') === 'admin') {
            return redirect()->route('admin')->with('success', 'Inspector details updated successfully.');
        } else {
            return redirect()->route('user', ['uiid' => $request->uiid])->with('success', 'Inspector details updated successfully.');
        }
    }

    public function updateActiveStatus(Request $request, $uiid){
        $isActive = $request->input('isActive');

        try {
            DB::update('UPDATE inspector SET isActive = ? WHERE uiid = ?', [$isActive, $uiid]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete($uiid){
        try {
            // perform a soft delete
            $affectedRows = DB::update('UPDATE inspector SET deleted_at = NOW() WHERE uiid = ?', [$uiid]);

            if ($affectedRows) {
                return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Inspector not found or already deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete inspector']);
        }
    }
}
