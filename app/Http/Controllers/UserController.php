<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index($uiid = null)
    {
        $user = DB::selectOne('SELECT * FROM inspector WHERE uiid = ? AND deleted_at IS NULL', [$uiid]);

        // Fetch inspections related to the user excluding soft-deleted records
        $inspections = DB::select('SELECT * FROM inspection WHERE uiid = ? AND deleted_at IS NULL ORDER BY created_at DESC', [$uiid]);

        // Fetch visits related to the user excluding soft-deleted records
        $visits = DB::select('SELECT * FROM visit WHERE uiid = ? AND deleted_at IS NULL ORDER BY created_at DESC', [$uiid]);
        return view('user.user', [
            'user' => $user,
            'inspections' => $inspections,
            'visits' => $visits
        ]);
    }
}
