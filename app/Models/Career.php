<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Career extends Model
{
    use HasFactory, Translatable;

    protected $table = 'careers';
    protected $guarded = [];
    public $translatedAttributes = ['title','description'];
    protected $hidden = ['translations'];
    /**
     * Get the jobs for the career.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

}


