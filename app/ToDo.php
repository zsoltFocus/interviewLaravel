<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
