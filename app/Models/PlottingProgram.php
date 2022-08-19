<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlottingProgram extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getOutcome()
    {
        return $this->hasMany(PlottingProgramOutcome::class, 'plotting_program_id');
    }

    public function getProgram()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
