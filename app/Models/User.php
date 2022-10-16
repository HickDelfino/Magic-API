<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    //Gets all the cards saved for this user
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
