<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    use HasFactory;

    protected $table = "detail_products";
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'char';
    protected $fillable = ['id', 'product_id', 'asal', 'panen', 'kelas', 'db', 'sisa', 'produksi', 'masuk', 'keluar_komersial', 'keluar_nonkomersial', 'tahun', 'bulan', 'slug'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
