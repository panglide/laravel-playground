<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district() 
    {
        return $this->belongsTo(District::class, 'nces_district_id', 'nces_district_id');
    }
}
