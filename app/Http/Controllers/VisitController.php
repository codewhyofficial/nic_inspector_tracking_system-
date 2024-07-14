<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function showAddVisitPage(){
        return view('visit.addVisit');
    }

    public function showUpdateVisitPage(){
        return view('visit.updateVisit');
    }
}
