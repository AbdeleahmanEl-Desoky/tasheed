<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTranslation extends Model
{
    use HasFactory;

    protected $table = 'home_translations';
    protected $guarded = [];
    protected $with = ['seo'];
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
