<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityOutcome extends Model
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
        $outcomes = ActivityOutcome::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('activity_id', $id)->get();
        if ($outcomes->count() == 0) {
            return 0;
        }
        $totalPerformane = 0;
        $countOutcome = 0;
        foreach ($outcomes as $outcome) {
            $plotOutcome = PlottingActivityOutcome::countOutcomePerformance($outcome->getPlotting->where('month', session('month'))->first()->id);
            $totalPerformane += $plotOutcome;
            $countOutcome++;
        }

        $performance = round(($totalPerformane / $countOutcome), 2);
        return $performance;
    }

    public static  function countPhysicalPerformance($activity)
    {
        $subActivities = SubActivity::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->where('activity_id', $activity)->get();
        if ($subActivities->count() == 0) {
            return 0;
        }
        $totalPerformane = 0;
        $countSubActivity = 0;
        foreach ($subActivities as $subActivity) {
            $plotOutcome = SubActivityOutput::countIndicatorPerformance($subActivity->id);
            $totalPerformane += $plotOutcome;
            $countSubActivity++;
        }
        $performance = round(($totalPerformane / $countSubActivity), 2);
        return $performance;
    }

    public function getPlotting()
    {
        return $this->hasMany(PlottingActivityOutcome::class, 'outcome_id');
    }

    public function getActivity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
