<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VisitController extends Controller
{
    public function showAddVisitPage($uiid)
    {
        $user = DB::selectOne('SELECT uiid, name FROM inspector WHERE uiid = ?', [$uiid]);
        return view('visit.addVisit', ['user' => $user]);
    }

    public function showUpdateVisitPage()
    {
        return view('visit.updateVisit');
    }

    public function Add(Request $request, $uiid)
    {
        $validator = Validator::make($request->all(), [
            'inspector_name' => 'required|string|max:255',
            'purpose_of_visit' => 'required|string|max:255',
            'type_of_inspection' => 'required|string|max:255',
            'site_to_be_inspected' => 'required|string|max:255',
            'point_of_entry' => 'required|string|max:255',
            'date_time_of_arrival' => 'required|date',
            // 'list_of_inspectors' => 'nullable|exists:inspectors,UIID',
            // 'teamlead' => 'required|exists:inspectors,UIID',
            'date_time_of_departure' => 'required|date',
            'remarks' => 'nullable|string',
            'captcha_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $captcha_code = $request->captcha_code;
        if (!Session::has('captcha_code') || empty($captcha_code) || strtolower($captcha_code) !== strtolower(Session::get('captcha_code'))) {
            // Captcha validation failed
            return redirect()->back()
                ->withErrors(['captcha_code' => 'The captcha code entered is incorrect.'])
                ->withInput($request->all());
        }

        try {
            // Insert into inspection table using raw SQL
            DB::insert('INSERT INTO visit ( 
                    uiid,
                    purpose_of_visit,
                    type_of_inspection,
                    site_of_inspection,
                    point_of_entry,
                    date_time_of_arrival,
                    list_of_inspectors,
                    team_lead,
                    date_time_of_departure,
                    remarks
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $uiid, 
                $request->purpose_of_visit,
                $request->type_of_inspection,
                $request->site_to_be_inspected,
                $request->point_of_entry,
                $request->date_time_of_arrival,
                $request->list_of_inspectors, // Ensure this is formatted correctly
                $request->teamlead,
                $request->date_time_of_departure,
                $request->remarks
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => 'An error occurred while processing your request. Please try again later.'])
                ->withInput($request->all());
        }

        return redirect()->route('user', ['uiid' => $uiid])->with('success', 'Visit details added successfully.');

    }
}
