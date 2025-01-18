<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPageTranslation extends Model
{
    use HasFactory;

    protected $table = 'blog_page_translations';
    protected $guarded = [];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
