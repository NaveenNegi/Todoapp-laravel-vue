<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\TaskRequest;

use App\Taskitem;

use Response;

use Validator;

class apiController extends Controller
{
    public function index(){
    	return Taskitem::get();

    }

    public function store(Request $request){	

    	$task_item 				=	$request->item;

    	$save_task_item 		=	new Taskitem();
    	$save_task_item->list_item 	=	$task_item;
    	$result 				=	$save_task_item->save();
    	return Response::json();
    	
    }
}
