<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokter_id',
        'pasien_id',
        'diagnosa',
        'catatan',
        'tanggal_pemeriksaan',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
