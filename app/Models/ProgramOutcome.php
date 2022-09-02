<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramOutcome extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getPlotting()
    {
        return $this->hasMany(PlottingProgramOutcome::class, 'outcome_id');
    }

    public function getProgram()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }

    public static function countIndicatorPerformance($id)
    {
        $outcomes = ProgramOutcome::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('program_id', $id)->get();
        if ($outcomes->count() == 0) {
            return 0;
        }
        $totalPerformane = 0;
        $countOutcome = 0;
        foreach ($outcomes as $outcome) {
            $plotOutcome = PlottingProgramOutcome::countOutcomePerformance($outcome->getPlotting->where('month', session('month'))->first()->id);
            $totalPerformane += $plotOutcome;
            $countOutcome++;
        }

        $performance = round(($totalPerformane / $countOutcome), 2);
        return $performance;
    }

    public static function countPhysicalPerformance($program)
    {
        if (auth()->user()->role == 'Kepala Bidang') {
            $activities = Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->where('program_id', $program)->get();
        } else if (auth()->user()->role == 'Kepala Dinas') {
            $activities = Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('program_id', $program)->get();
        }
        if ($activities->count() == 0) {
            return 0;
        }
        $totalPerformane = 0;
        $countActivity = 0;
        foreach ($activities as $activity) {
            $plotOutcome = ActivityOutcome::countPhysicalPerformance($activity->id);
            $totalPerformane += $plotOutcome;
            $countActivity++;
        }
        $performance = round(($totalPerformane / $countActivity), 2);
        return $performance;
    }
}
