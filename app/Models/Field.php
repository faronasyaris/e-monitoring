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

    public static function getField($field){
        $field_name = Field::select('name')->where('id',$field)->first()->name;
        return $field_name;
    }
}
