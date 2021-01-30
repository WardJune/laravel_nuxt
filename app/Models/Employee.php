<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date_of_birth', 'job_title', 'profiles'];
    protected $casts = ['profiles' => 'array'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
