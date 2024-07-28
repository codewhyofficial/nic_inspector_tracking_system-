<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InspectionController extends Controller
{
    public function showAddInspectionPage($uiid = null)
    {
        $user = DB::selectOne('SELECT uiid, name FROM inspector WHERE uiid = ?', [$uiid]);
        return view('inspection.addInspection', ['user' => $user]);
    }

    public function showUpdateInspectionPage($uiid, $id)
    {
        $inspection = DB::selectOne('SELECT * FROM inspection WHERE id = ?', [$id]);
        return view('inspection.updateInspection', ['inspection' => $inspection]);
    }

    public function Add(Request $request, $uiid)
    {
        $validator = Validator::make($request->all(), [
            'inspector_name' => 'required|string|max:255',
            'inspection_category' => 'required|string|max:255',
            'date_of_joining' => 'required|date',
            'status' => 'required|string|max:50',
            'remarks' => 'nullable|string|max:1000',
            'captcha_code' => 'required|string'
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
            // Insert into inspection table
            DB::insert('INSERT INTO inspection (uiid, name, inspection_category, date_of_joining, status, remarks) VALUES (?, ?, ?, ?, ?, ?)', [
                $uiid,
                $request->inspector_name,
                $request->inspection_category,
                $request->date_of_joining,
                $request->status,
                $request->remarks
            ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => 'An error occurred while processing your request. Please try again later.'])
                ->withInput($request->all());
        }

        return redirect()->route('user', ['uiid' => $uiid])->with('success', 'Inspection details added successfully.');
    }

    public function Update(Request $request, $uiid, $id)
    {
        $validator = Validator::make($request->all(), [
            'inspector_name' => 'required|string|max:255',
            'inspection_category' => 'required|string|max:255',
            'date_of_joining' => 'required|date',
            'status' => 'required|string|max:50',
            'remarks' => 'nullable|string|max:1000',
            'captcha_code' => 'required|string'
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
            DB::update(
                'UPDATE inspection SET inspection_category = ?, date_of_joining = ?, status = ?, remarks = ? WHERE id = ?',
                [
                    $request->inspection_category,
                    $request->date_of_joining,
                    $request->status,
                    $request->remarks,
                    $id
                ]
            );
        } catch (\Exception $e) {
            return redirect()->back()
            ->with(['error' => 'An error occurred while processing your request. Please try again later.'])
            ->withInput($request->all());
        }

        return redirect()->route('user', ['uiid' => $uiid])->with('success', 'Inspection details updated successfully.');
    }

    public function delete($uiid, $id){
        try {
            $affectedRows = DB::update('UPDATE inspection SET deleted_at = NOW() WHERE uiid = ? AND id = ?', [$uiid, $id]);

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
