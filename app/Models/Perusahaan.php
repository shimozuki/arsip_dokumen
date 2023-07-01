<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = "dusun";
    protected $primaryKey = 'id_dusun';
    protected $fillable = [
        'no_pen', 'nama_dusun'
    ];
}