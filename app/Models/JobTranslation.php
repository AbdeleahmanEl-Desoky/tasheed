<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTranslation extends Model
{
    use HasFactory;

    protected $table = 'job_translations';
    protected $guarded = [];


    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
