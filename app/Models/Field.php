<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getUser(){
        return $this->hasMany(User::class,'field_id');
    }
}
