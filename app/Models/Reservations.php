<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function place(){
        return $this->belongsTo(Place::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
