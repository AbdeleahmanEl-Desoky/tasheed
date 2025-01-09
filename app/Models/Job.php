<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Job extends Model
{
    use HasFactory, Translatable;

    protected $table = 'jobs';
    protected $guarded = [];
    /**
     * Get the career that owns the job.
     */
    public function career()
    {
        return $this->belongsTo(Career::class);
    }
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
