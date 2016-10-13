<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Taskitem;

use Response;

class apiController extends Controller
{
    public function index(){
    	return Taskitem::get();

    }
}
