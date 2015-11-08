<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//zelf toegevoegt
use Illuminate\Database\Eloquent\SoftDeletes;

class Quizname extends Model
{
    use SoftDeletes;
    
	protected $table    = 'quiznames';

	protected $fillable = ['name','start','stop'];

	protected $hidden   = [ ];

	protected $dates    = ['deleted_at'];
}
