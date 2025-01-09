<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUnitFeatureTranslation extends Model
{
    use HasFactory;

    protected $table = 'project_unit_feature_translations';
    protected $guarded = [];
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
