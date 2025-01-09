<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    public $guarded = [];
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoble');
    }
}
