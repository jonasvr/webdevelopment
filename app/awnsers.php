<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class awnsers extends Model
{
    protected $table    = 'awnsers';

	protected $fillable = ['awnser','shifting'];

	protected $hidden   = ['FK_inquiry','FK_user'];
}
