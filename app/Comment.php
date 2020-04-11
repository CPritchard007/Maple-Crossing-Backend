<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function discussion(){
        return $this->belongsTo(Discussion::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
