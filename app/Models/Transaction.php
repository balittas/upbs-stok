<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'char';
    protected $fillable = ['id', 'user_id', 'paid_total', 'status', 'alamat', 'zip_code', 'kabupaten_kota', 'provinsi', 'no_hp', 'nama_penerima', 'bukti_transfer_produk', 'bukti_transfer_ongkir', 'total_produk', 'total_ongkir', 'qty', 'order_notes', 'coordinate_map'];
}
