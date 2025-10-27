<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    // Skema legacy
    protected $table = 'user';           // tabel kamu memang 'user'
    protected $primaryKey = 'iduser';    // PK custom
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom-kolom yang wajar di legacy
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
        'nama'   => 'string',
        'email'  => 'string',
    ];

    // Relasi role via pivot user_role {iduser, idrole, status}
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role', 'iduser', 'idrole')
                    ->withPivot(['status']);
    }
}
