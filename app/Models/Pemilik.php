<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    protected $fillable = [
        'nama','email','no_wa','alamat','iduser'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}