<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $users = DB::select('SELECT uiid, name, gender, nationality, place_of_birth, inspector_rank, isActive FROM inspector WHERE deleted_at IS NULL');
        return view('admin.admin', ['users' => $users]);
    }
}
