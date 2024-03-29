<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlottingActivityOutcome extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public static function countOutcomePerformance($id)
    {
        $outcome = PlottingActivityOutcome::find($id);
        if ($outcome->target == 0) {
            return 0;
        }

        $performance = 0;
        $performance = round(($outcome->achievment / $outcome->target) * 100, 2);
        return $performance;
    }

    public function getOutcomeActivity()
    {
        return $this->belongsTo(ActivityOutcome::class, 'outcome_id');
    }
}
