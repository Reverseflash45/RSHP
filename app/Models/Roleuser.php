<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleUser extends Model
{
    // Tabel pivot: user_role { iduser, idrole, status }
    protected $table = 'user_role';

    // Eloquent tidak mendukung composite PK. Biarkan tanpa PK increment.
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;   // dibiarkan null

    protected $fillable = ['iduser', 'idrole', 'status'];
    protected $casts = [
        'iduser' => 'integer',
        'idrole' => 'integer',
        'status' => 'integer',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // Relasi ke Role
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}
