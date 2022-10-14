<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function schools()
    {
        return $this->hasMany(School::class, 'nces_district_id', 'nces_district_id');
    }
}
