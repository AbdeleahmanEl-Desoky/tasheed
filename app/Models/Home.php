<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Translatable;

class Home extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Translatable;

    protected $table = 'homes';
    protected $guarded = [];
    protected $appends = ['pictures','seo'];
    public $translatedAttributes = ['title','description'];
    protected $hidden = ['translations'];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function getTranslationsAttribute($value)
    {
        $translations = $this->getRelationValue('translations')->toArray();

        foreach ($translations as &$translation) {
            $translation['seo'] = $this->seo; // Use the eager-loaded `seo`
        }

        return $translations;
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
