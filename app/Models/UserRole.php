<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    #[Fillable(['name'])]

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
