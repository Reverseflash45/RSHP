<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriKlinis extends Model
{
    use SoftDeletes;

    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori_klinis',
        'deleted_by',
    ];

    protected $casts = [
        'idkategori_klinis' => 'integer',
        'deleted_at'        => 'datetime',
        'deleted_by'        => 'integer',
    ];
}
