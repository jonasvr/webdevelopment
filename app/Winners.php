<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winners extends Model
{
    protected $table    = 'winners';

	protected $fillable = ['FK_user','FK_inquiry'];

	protected $hidden   = [];
}
