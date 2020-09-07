<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function type()
    {
        return $this->belongsTo(Category::class);
    }

    public function recalculationHistories()
    {
        return $this->hasMany(RecalculationHistory::class);
    }
}
