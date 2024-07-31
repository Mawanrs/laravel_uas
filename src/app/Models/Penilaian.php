<?php

namespace App\Models;

use DateTimeInterface;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Penilaian extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'penilaians';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const Keterangan = [
        'LULUS' => 'LULUS',
        'Tidak LULUS' => 'Tidak LULUS',
    ];

    public function tambahSiswaa()
    {
        return $this->belongsTo(Tambah_siswaa::class, 'tambah_siswaa_id');
    }

    protected $fillable = [
        'tambah_siswaa_id',
        'prestasi',
        'nilai_displin',
        'nilai_absensi', 
        'nilai_mpe',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}