<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function customUser()
    {
        return $this->belongsTo(CustomUser::class, 'user_id');
    }
}
