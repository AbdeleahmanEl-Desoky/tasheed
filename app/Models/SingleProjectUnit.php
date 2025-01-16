<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Translatable;

class SingleProjectUnit extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Translatable;

    protected $table = 'single_project_units';
    protected $guarded = [];
    protected $appends = ['pictures'];
    protected $casts = [
        'data' => 'array',  // Automatically decode JSON strings to array
    ];
    public $translatedAttributes = ['title','description'];
    protected $hidden = ['translations'];
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
