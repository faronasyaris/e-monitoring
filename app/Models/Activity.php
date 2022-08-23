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
}
