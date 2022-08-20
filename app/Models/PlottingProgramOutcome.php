<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlottingProgramOutcome extends Model
{
    use HasFactory;
    protected $guarded = ['id'];



    public static function countOutcomePerformance($id)
    {
        $outcome = PlottingProgramOutcome::find($id);
        if ($outcome->target == 0) {
            return 0;
        }

        $performance = 0;
        $performance = round(($outcome->achievment / $outcome->target) * 100, 2);
        return $performance;
    }

    public function getOutcomeProgram()
    {
        return $this->belongsTo(ProgramOutcome::class, 'outcome_id');
    }
}
