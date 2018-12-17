<?php

namespace Garnet;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
