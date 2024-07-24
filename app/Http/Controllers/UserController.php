<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index($uiid = null)
    {
        $user = DB::selectOne('SELECT * FROM inspector WHERE uiid = ?', [$uiid]);
        $inspections = DB::select('SELECT * FROM inspection WHERE uiid = ? ORDER BY created_at DESC', [$uiid]);
        $visits = DB::select('SELECT * FROM visit WHERE uiid = ? ORDER BY created_at DESC', [$uiid]);
        return view('user.user', [
            'user' => $user,
            'inspections' => $inspections,
            'visits' => $visits
        ]);
    }
}
