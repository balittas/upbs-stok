<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'char';
    protected $fillable = ['id', 'category_id', 'name', 'image', 'description', 'price', 'slug'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
