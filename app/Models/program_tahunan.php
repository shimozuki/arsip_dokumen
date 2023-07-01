<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class program_tahunan extends Model
{
    use HasFactory;
    protected $table = "program_tahunan";
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul_program', 'keterangan', 'tgl_mulai', 'tg_akhir',
    ];
}
