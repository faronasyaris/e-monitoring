<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlottingSubActivity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getPlotting()
    {
        return $this->hasMany(PlottingSubActivityOutput::class, 'outcome_id');
    }

    public function getSubActivity()
    {
        return $this->belongsTo(SubActivity::class, 'sub_activity_id');
    }

    public static function countFinancePerformance()
    {
    }
}
