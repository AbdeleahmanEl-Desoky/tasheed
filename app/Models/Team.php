<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Translatable;
class Team extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Translatable;

    protected $table = 'teams';
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
}
