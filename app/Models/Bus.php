<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'buss';
    protected $guarded = [];

    public function stop()
    {
        return $this->hasMany(Stop::class);
    }
}
