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

    	$data  		=	array();
    	$data['list']	=	Taskitem::where('complete','=', 0)->get();
    	$data['complete'] =	Taskitem::where('complete', '=', 1)->get();
    	return $data;

    }

    public function store(Request $request){	

    	$task_item 				=	$request->item;

    	$save_task_item 		=	new Taskitem();
    	$save_task_item->list_item 	=	$task_item;
    	$result 				=	$save_task_item->save();
    	return Response::json();
    	
    }

    public function update($edit_id,Request $request){

    	$task_item 				=	$request->item;

    	$updateTask 			=	Taskitem::where('id',$edit_id)->update([
    				'list_item' => 	$request->item
    		]);
    	return Response::json($updateTask);

    }

    public function delete($delete_id,Request $request){

    	$delete_task 	=	Taskitem::where('id',$delete_id)->first();
    	if($delete_task){
    		$delete 	=	$delete_task->delete();
    	}

    	return Response::json();
    }

    public function complete($complete_id,Request $request){

    	$completeTask 		=	Taskitem::where('id',$complete_id)->update([
    			'complete' 	=> 	1
    		]);
    	return Response::json();
    }
}
