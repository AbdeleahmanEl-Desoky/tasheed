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
    protected $appends = ['pictures', 'seo'];
    public $translatedAttributes = ['title', 'description'];
    protected $hidden = ['translations'];

    public function getTranslationsAttribute(): array
    {
        $translations = $this->getRelationValue('translations')->toArray();

        foreach ($translations as &$translation) {
            $homeTranslation = $this->translations->find($translation['id']);
            $translation['seo'] = $homeTranslation && $homeTranslation->seo
                ? $homeTranslation->seo->toArray()
                : null;
        }

        return $translations;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->useDisk('public');
    }

    public function getPicturesAttribute(): \Illuminate\Support\Collection
    {
        return $this->getMedia('images');
    }
}
