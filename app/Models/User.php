<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function notes()
    {
        //one for many
        return $this->hasMany(Note::class);
    }
}
