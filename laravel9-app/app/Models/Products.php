<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    /**
     * Get the category that owns the comment.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
