<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $table = "user_details";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = ['id', 'user_id', 'address'];
}
