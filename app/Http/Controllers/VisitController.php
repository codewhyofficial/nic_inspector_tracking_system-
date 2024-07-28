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
        $inspectors = DB::select('SELECT uiid, name, inspector_rank, nationality, place_of_birth FROM inspector WHERE deleted_at IS NULL');
        return view('visit.addVisit', ['user' => $user, 'inspectors' => $inspectors]);
    }

    public function showUpdateVisitPage($uiid, $id)
    {
        $user = DB::selectOne('SELECT uiid, name FROM inspector WHERE uiid = ?', [$uiid]);
        $visit = DB::selectOne('SELECT * FROM visit WHERE id = ?', [$id]);
        $inspectors = DB::select('SELECT uiid, name, inspector_rank, nationality, place_of_birth FROM inspector WHERE deleted_at IS NULL');
        return view('visit.updateVisit', [
            'visit' => $visit,
            'user' => $user,
            'inspectors' => $inspectors
        ]);
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
            'list_of_inspectors' => 'required|array', // array of UIIDs
            'team_lead' => 'required|string|exists:inspector,uiid',
            'date_time_of_departure' => 'required|date',
            'remarks' => 'nullable|string',
            'captcha_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $captcha_code = $request->captcha_code;
        if (!Session::has('captcha_code') || empty($captcha_code) || strtolower($captcha_code) !== strtolower(Session::get('captcha_code'))) {
            return redirect()->back()
                ->withErrors(['captcha_code' => 'The captcha code entered is incorrect.'])
                ->withInput($request->all());
        }

        try {
            // Prepare list_of_inspectors as a comma-separated string
            $list_of_inspectors = implode(',', $request->list_of_inspectors);

            // Insert into visit table
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
                $list_of_inspectors,
                $request->team_lead,
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

    public function update(Request $request, $uiid, $id)
    {
        $validator = Validator::make($request->all(), [
            'inspector_name' => 'required|string|max:255',
            'purpose_of_visit' => 'required|string|max:255',
            'type_of_inspection' => 'required|string|max:255',
            'site_of_inspection' => 'required|string|max:255',
            'point_of_entry' => 'required|string|max:255',
            'date_time_of_arrival' => 'required|date',
            'list_of_inspectors' => 'required|array',
            'team_lead' => 'required|string|exists:inspector,uiid',
            'date_time_of_departure' => 'required|date',
            'remarks' => 'nullable|string',
            'captcha_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $captcha_code = $request->captcha_code;
        if (!Session::has('captcha_code') || empty($captcha_code) || strtolower($captcha_code) !== strtolower(Session::get('captcha_code'))) {
            return redirect()->back()
                ->withErrors(['captcha_code' => 'The captcha code entered is incorrect.'])
                ->withInput($request->all());
        }

        try {
            $list_of_inspectors = implode(',', $request->list_of_inspectors);

            // Update the visit record
            DB::update(
                'UPDATE visit SET
                purpose_of_visit = ?,
                type_of_inspection = ?,
                site_of_inspection = ?,  
                point_of_entry = ?,
                date_time_of_arrival = ?,
                list_of_inspectors = ?,
                team_lead = ?,
                date_time_of_departure = ?,
                remarks = ?
            WHERE id = ?',
                [
                    $request->purpose_of_visit,
                    $request->type_of_inspection,
                    $request->site_of_inspection,
                    $request->point_of_entry,
                    $request->date_time_of_arrival,
                    $list_of_inspectors,
                    $request->team_lead,
                    $request->date_time_of_departure,
                    $request->remarks,
                    $id
                ]
            );
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => 'An error occurred while processing your request. Please try again later.'])
                ->withInput($request->all());
        }

        return redirect()->route('user', ['uiid' => $uiid])->with('success', 'Visit details updated successfully.');
    }

    public function delete($uiid, $id)
    {
        try {
            $affectedRows = DB::update('UPDATE visit SET deleted_at = NOW() WHERE uiid = ? AND id = ?', [$uiid, $id]);

            if ($affectedRows) {
                return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Record not found or already deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete record']);
        }
    }
}
