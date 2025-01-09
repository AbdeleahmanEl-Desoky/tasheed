<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProjectUnitFeature extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'project_unit_features';
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

    public function singleProjectUnit()
    {
        return $this->belongsTo(SingleProjectUnit::class, 'single_project_unit_id');
    }

    public function featureUnit()
    {
        return $this->belongsTo(FeatureUnit::class, 'feature_unit_id');
    }
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
