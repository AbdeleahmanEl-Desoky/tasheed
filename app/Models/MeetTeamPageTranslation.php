<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetTeamPageTranslation extends Model 
{
    use HasFactory;

    protected $table = 'meet_team_page_translations';
    protected $guarded = [];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
