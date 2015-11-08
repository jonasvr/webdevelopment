<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//zelf toegevoegt
use Illuminate\Database\Eloquent\SoftDeletes;

class questions extends Model
{
	use SoftDeletes;
    
	protected $table    = 'questions';

	protected $fillable = ['question','awnser','option1','option2','option3','quizID'];

	protected $hidden   = [ ];

	protected $dates    = ['deleted_at'];
}

