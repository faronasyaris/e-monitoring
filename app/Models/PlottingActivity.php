<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlottingActivity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getPlotting()
    {
        return $this->hasMany(PlottingActivityOutcome::class, 'outcome_id');
    }

    public function getActivity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function countActivityBudget($activity)
    {
    }
}
