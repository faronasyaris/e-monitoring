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
}
