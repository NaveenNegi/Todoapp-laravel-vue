<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    protected $table 		=	"task_lists";
    protected $fillable 	=	['task_item'];
}
