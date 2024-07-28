<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index($uiid = null)
    {
        // fetching the user
        $user = DB::selectOne('SELECT uiid, name FROM inspector WHERE uiid = ? AND deleted_at IS NULL', [$uiid]);

        // Fetch inspections related to the user excluding soft-deleted records
        $inspections = DB::select('SELECT * FROM inspection WHERE uiid = ? AND deleted_at IS NULL ORDER BY created_at DESC', [$uiid]);

        // Fetch visits related to the user excluding soft-deleted records
        $visits = DB::select('SELECT * FROM visit WHERE uiid = ? AND deleted_at IS NULL ORDER BY created_at DESC', [$uiid]);

        // Process visits to get details of inspectors and team lead
        foreach ($visits as &$visit) {
            // Fetch the details of the team lead
            $visit->team_lead_details = DB::selectOne('SELECT * FROM inspector WHERE uiid = ?', [$visit->team_lead]);

            // Fetch the details of the inspectors in the list
            $inspectorIds = json_decode($visit->list_of_inspectors, true);
            if ($inspectorIds) {
                $visit->inspectors_details = DB::table('inspector')
                    ->whereIn('uiid', $inspectorIds)
                    ->get();
            } else {
                $visit->inspectors_details = collect();
            }
        }

        return view('user.user', [
            'user' => $user,
            'inspections' => $inspections,
            'visits' => $visits
        ]);
    }
}
