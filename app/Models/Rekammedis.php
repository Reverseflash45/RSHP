<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;

    protected $fillable = [
        'idtemu_dokter',     
        'diagnosa',
        'catatan',
        'berat_badan',
        'suhu',
        'denyut_jantung',
        'respirasi',
        'created_by',        
        'created_at',        
    ];

    

    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idtemu_dokter', 'idtemu_dokter');
    }

    public function details()
    {
        return $this->hasMany(RekamMedisDetail::class, 'idrekam_medis', 'idrekam_medis');
    }
}