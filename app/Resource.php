<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resource extends Model
{

    function user(){
        return $this->belongsTo(User::class);
    }

}
