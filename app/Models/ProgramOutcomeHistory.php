<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramOutcomeHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getProgram()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function getOutcomeProgram()
    {
        return $this->belongsTo(ProgramOutcome::class, 'outcome_id');
    }
}
