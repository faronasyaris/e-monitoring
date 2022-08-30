<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getOutcome()
    {
        return $this->hasMany(ProgramOutcome::class, 'program_id');
    }
    public function getPlotting()
    {
        return $this->hasMany(PlottingProgram::class, 'program_id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }

    public static function countProgramFinance($id)
    {
        $program = Program::where('id', $id)->first();
        $activities = Activity::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('program_id', $program->id)->get();
        $performance = 0;
        $totalBudget = 0;
        $totalFinanceRealization = 0;
        foreach ($activities as $activity) {
            $activityFinance = Activity::countActivityFinance($activity->id);
            $totalBudget += $activityFinance['totalBudget'];
            $totalFinanceRealization += $activityFinance['totalFinance'];
        }

        if ($totalBudget == 0 || $totalFinanceRealization == 0) {
            $performance = 0;
        } else {
            $performance = round(($totalFinanceRealization / $totalBudget) * 100, 2);
        }

        $data = [
            'performance' => $performance,
            'totalBudget' => $totalBudget,
            'totalFinance' => $totalFinanceRealization,
        ];

        return $data;
    }
}
