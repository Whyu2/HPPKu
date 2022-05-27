<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Btkl extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_btkl',
        'besaran',
        'keterangan'
    ];
}
