<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SingleProjectTranslation extends Model
{
    use HasFactory;

    protected $table = 'single_project_translations';
    protected $guarded = [];
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
