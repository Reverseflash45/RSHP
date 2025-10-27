<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_role', 'keterangan'];
    protected $casts = [
        'idrole' => 'integer',
        'nama_role' => 'string',
        'keterangan' => 'string',
    ];

    // Relasi ke baris pivot
    public function roleUser(): HasMany
    {
        return $this->hasMany(RoleUser::class, 'idrole', 'idrole');
    }

    // Many-to-many ke user lewat user_role
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role', 'idrole', 'iduser')
                    ->withPivot(['status']);
    }
}
