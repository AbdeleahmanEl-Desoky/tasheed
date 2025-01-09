<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureUnitTranslation extends Model 
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'feature_unit_translations';
    protected $guarded = [];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
