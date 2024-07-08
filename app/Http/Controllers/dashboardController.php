<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {

        if(request()->ajax()) {
            return view('dashboard.content');
        }
        return view('dashboard.index');
    }
}
