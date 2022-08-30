<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getOutcome()
    {
        return $this->hasMany(ActivityOutcome::class, 'activity_id');
    }

    public function getPlotting()
    {
        return $this->hasMany(PlottingActivity::class, 'activity_id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }

    public static function countActivityFinance($id)
    {
        $activity = Activity::where('id', $id)->first();
        $subActivities = SubActivity::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('activity_id', $activity->id)->get();
        $performance = 0;
        $totalBudget = 0;
        $totalFinanceRealization = 0;
        foreach ($subActivities as $subActivity) {
            $plot = $subActivity->getPlotting->where('month', session('month'))->first();
            $totalBudget += $plot->budget;
            $totalFinanceRealization += $plot->finance_realization;
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
