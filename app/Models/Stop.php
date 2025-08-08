<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    protected $guarded = [];
    
    public function Bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
