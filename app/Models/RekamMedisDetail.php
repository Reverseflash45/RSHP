<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedisDetail extends Model
{
    protected $table = 'rekam_medis_detail';
    protected $primaryKey = 'iddetail';
    public $timestamps = false;

    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan',
        'qty',
        'harga',
        'subtotal',
        'catatan',
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    public function kodeTindakan()
    {
        return $this->belongsTo(KodeTindakan::class, 'idkode_tindakan', 'idkode_tindakan');
    }
}
