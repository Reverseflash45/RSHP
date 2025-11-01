<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    // Karena database-mu pakai tabel 'user' (bukan 'users')
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'iduser' => 'integer',
    ];

    /**
     * Relasi ke role.
     * PENTING: di DB kamu namanya 'role_user' (bukan 'user_role')
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot(['status']);
    }
}
