<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivityWorker extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getUser(){
        return $this->belongsTo(User::class,'worker_id','id');
    }

    public function getActivity(){
        return $this->belongsTo(SubActivity::class,'sub_activity_id');
    }

}
