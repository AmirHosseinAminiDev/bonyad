<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'major',
        'education_level',
        'job_status',
        'job',
        'job_type',
        'birth_date',
        'address',
        'war_document',
        'active_basij',
        'marriage_status',
    ];
}
