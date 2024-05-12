<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'children_count'
    ];

    /**
     * @return HasOne
     */
    public function masterRequest(): HasOne
    {
        return $this->hasOne(MasterRequest::class);
    }
}
