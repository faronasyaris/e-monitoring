<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivityOutput extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }

    public static function countIndicatorPerformance($id)
    {
        $outcomes = SubActivityOutput::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('sub_activity_id', $id)->get();
        if ($outcomes->count() == 0) {
            return 0;
        }
        $totalPerformane = 0;
        $countOutcome = 0;
        foreach ($outcomes as $outcome) {
            $plotOutcome = PlottingSubActivityOutput::countOutcomePerformance($outcome->getPlotting->where('month', session('month'))->first()->id);
            $totalPerformane += $plotOutcome;
            $countOutcome++;
        }

        $performance = round(($totalPerformane / $countOutcome), 2);
        return $performance;
    }

    public function getPlotting()
    {
        return $this->hasMany(PlottingSubActivityOutput::class, 'outcome_id');
    }

    public function getSubActivity()
    {
        return $this->belongsTo(SubActivity::class, 'sub_activity_id');
    }
}
