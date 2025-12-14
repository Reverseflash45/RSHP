<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idtemu_dokter';
    public $timestamps = false;

    protected $fillable = [
        'idpet',
        'idrole_user',   // dokter (role_user.idrole_user)
        'no_urut',
        'status',
        'waktu_daftar',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokterRoleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'idtemu_dokter', 'idtemu_dokter');
    }
}
