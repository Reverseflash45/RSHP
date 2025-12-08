<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ras extends Model
{
    use SoftDeletes;

    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    public $timestamps = false;

    protected $fillable = [
        'nama_ras',
        'idjenis_hewan',
        'deleted_by',
    ];

    protected $casts = [
        'idras_hewan'    => 'integer',
        'idjenis_hewan'  => 'integer',
        'nama_ras'       => 'string',
        'deleted_by'     => 'integer',
        'deleted_at'     => 'datetime',
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
}
