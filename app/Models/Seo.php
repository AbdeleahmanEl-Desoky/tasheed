<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $table = 'seos';
    protected $guarded = [];
    // protected $appends = ['pictures'];

    // public function registerMediaCollections(): void
    // {
    //     $this->addMediaCollection('images')
    //         ->useDisk('public');
    // }

    // public function getPicturesAttribute()
    // {
    //     return $this->getMedia();
    // }
    public function seoble()
    {
        return $this->morphTo();
    }
}
