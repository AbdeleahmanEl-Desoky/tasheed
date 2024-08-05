<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Home extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'homes';
    protected $guarded = [];
    protected $appends = ['pictures'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk('public');
    }

    public function getPicturesAttribute()
    {
        return $this->getMedia('images')->map(function (Media $media) {
            return [
                'id' => $media->id,
                'file_name' => $media->file_name,
                'original_url' => $media->getUrl(), // Get the original URL
                'size' => $media->size,
            ];
        });
    }
}