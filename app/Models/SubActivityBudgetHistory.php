<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivityBudgetHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getSubActivity()
    {
        return $this->belongsTo(SubActivity::class, 'sub_activity_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
