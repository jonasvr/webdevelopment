<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//zelf toegevoegt
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    protected $table    = 'inquiries';

	protected $fillable = ['question','awnser','option1','option2','option3','start','stop'];

	protected $hidden   = [ ];

	protected $dates    = ['deleted_at'];
}
