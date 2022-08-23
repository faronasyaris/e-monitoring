<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getSubActivityOutput()
    {
        return $this->hasMany(SubActivityOutput::class, 'sub_activity_id');
    }

    public function getPlotting()
    {
        return $this->hasMany(PlottingSubActivity::class, 'sub_activity_id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }
}
