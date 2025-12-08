<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'deleted_by',
    ];

    protected $casts = [
        'idkategori'  => 'integer',
        'deleted_at'  => 'datetime',
        'deleted_by'  => 'integer',
    ];

    public function kodeTindakan()
    {
        return $this->hasMany(KodeTindakan::class, 'idkategori', 'idkategori');
    }
}
