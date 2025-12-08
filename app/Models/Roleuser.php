<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    use SoftDeletes;

    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $timestamps = false;

    protected $fillable = [
        'iduser',
        'idrole',
        'status',
        'deleted_by',
    ];

    protected $casts = [
        'idrole_user' => 'integer',
        'iduser'      => 'integer',
        'idrole'      => 'integer',
        'status'      => 'integer',
        'deleted_at'  => 'datetime',
        'deleted_by'  => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}
