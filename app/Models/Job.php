<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;


    protected $table = 'jobs';
    protected $guarded = [];
    /**
     * Get the career that owns the job.
     */
    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
