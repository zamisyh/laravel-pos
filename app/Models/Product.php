<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'stock', 'price', 'description', 'image', 'category_id', 'code'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
