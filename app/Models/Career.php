<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers';
    protected $guarded = [];
    /**
     * Get the jobs for the career.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}


