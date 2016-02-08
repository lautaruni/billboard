<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;

class DashboardController extends BackendController
{
    public function index(){
    	return view('dashboard.index');
    }
}
