<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityOutcomeHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function getActivity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function getOutcomeActivity()
    {
        return $this->belongsTo(ActivityOutcome::class, 'outcome_id');
    }
}
