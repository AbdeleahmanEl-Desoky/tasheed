<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class ApplyJob extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    protected $table = 'apply_jobs';
    protected $guarded = [];
    /**
     * Get the career that owns the job.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk('public');
    }

    public function getPicturesAttribute()
    {
        return $this->getMedia();
    }
}
