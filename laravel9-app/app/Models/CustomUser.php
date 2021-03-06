<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends Model
{
    use HasFactory;

    protected $table = 'custom_user';

    public function orders()
    {
        return $this->hasMany(Orders::class, 'user_id');
    }
}
