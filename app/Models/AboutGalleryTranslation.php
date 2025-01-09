<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutGalleryTranslation extends Model 
{
    use HasFactory;

    protected $table = 'about_gallery_translations';

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
