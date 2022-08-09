<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivitySubmission extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getWorker(){
        return $this->belongsTo(User::class,'worker_id');
    }

    public function getStatusLabel($id){
        if($id==0){
            return '<span class="label label-warning">Pending</span>';
        }

        else if($id == 1){
            return '<span class="label label-success">Approved</span>';
        }

        else if($id == 2){
            return '<span class="label label-danger">Rejected</span>';
        }
    }

}
