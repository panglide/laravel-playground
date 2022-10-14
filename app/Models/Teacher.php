<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'email',
    ];

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function coach() {
        return $this->hasOne(Coach::class);
    }
}
