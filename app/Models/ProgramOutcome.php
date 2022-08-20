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
}
