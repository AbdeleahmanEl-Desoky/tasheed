<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SingleProjectUnit extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'single_project_units';
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

    public function project()
    {
        return $this->belongsTo(SingleProject::class);
    }

    public function unitFeatures()
    {
        return $this->belongsToMany(FeatureUnit::class, 'project_unit_features');
    }
}
