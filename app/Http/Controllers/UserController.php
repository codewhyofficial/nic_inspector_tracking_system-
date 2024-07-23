<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index($uiid = null){
        $user = DB::selectOne('SELECT * FROM inspector WHERE uiid = ?', [$uiid]);
        $inspections = DB::select('SELECT * FROM inspection WHERE uiid = ?', [$uiid]);
        return view('user.user', ['user' => $user], ['inspections' => $inspections]);
    }
}
