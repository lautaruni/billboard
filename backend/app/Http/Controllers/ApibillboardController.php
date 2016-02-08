<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApibillboardController extends Controller
{
    public function getWeek($start){
    	return response()->json(["message"=>"ok"]);
    }
}
