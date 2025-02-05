<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Translatable;


class About extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Translatable;

    protected $table = 'abouts';
    protected $guarded = [];
    protected $appends = ['pictures'];

    public $translatedAttributes = ['title','description','description_home','seo'];
    protected $hidden = ['translations'];
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
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
    public function aboutGallery()
    {
        return $this->hasMany(AboutGallery::class);
    }

}
