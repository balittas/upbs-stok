<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "carts";
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'char';
    protected $fillable = ['id', 'user_id', 'detail_product_id', 'transaction_id', 'status'];

    public function detail_product()
    {
        return $this->hasMany(DetailProduct::class);
    }
}
