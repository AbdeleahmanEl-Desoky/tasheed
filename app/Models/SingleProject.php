<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SingleProject extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'single_projects';
    protected $guarded = [];
    protected $appends = ['pictures'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk('public');
    }

    public function getPicturesAttribute()
    {
        return $this->getMedia();
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'project_features');
    }

    public function units()
    {
        return $this->hasMany(SingleProjectUnit::class);
    }
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
