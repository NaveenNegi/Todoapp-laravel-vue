<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taskitem extends Model
{
    protected $table 		=	"taskitems";
    protected $fillable 	=	['list_item'];
}
