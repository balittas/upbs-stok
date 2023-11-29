<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = "product_categories";
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'char';
    protected $fillable = ['id', 'name'];
}
