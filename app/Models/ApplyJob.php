<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;


    protected $table = 'apply_jobs';
    protected $guarded = [];
    /**
     * Get the career that owns the job.
     */
    public function career()
    {
        return $this->belongsTo(Job::class);
    }
}
