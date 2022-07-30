<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getSubActivityOutput(){
        return $this->hasMany(SubActivityOutput::class,'sub_activity_id');
    }

    public function getSubActivitySubmission(){
        return $this->hasMany(SubActivitySubmission::class,'sub_activity_id');
    }

    public function getSubActivityWorker(){
        return $this->hasMany(SubActivityWorker::class,'sub_activity_id');
    }
}
