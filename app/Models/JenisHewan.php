<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JenisHewan extends Model
{
    use SoftDeletes;

    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    public $timestamps = false;

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_jenis_hewan',
        'deleted_by',
    ];

    protected $casts = [
        'idjenis_hewan'    => 'integer',
        'nama_jenis_hewan' => 'string',
        'deleted_by'       => 'integer',
        'deleted_at'       => 'datetime',
    ];

    public function toArraySimple(): array
    {
        return [
            'idjenis_hewan'    => (int) $this->idjenis_hewan,
            'nama_jenis_hewan' => (string) $this->nama_jenis_hewan,
        ];
    }

    public function scopeOrdered(Builder $q): Builder
    {
        return $q->orderBy('idjenis_hewan', 'asc');
    }

    public static function getAll(): \Illuminate\Support\Collection
    {
        return static::query()
            ->select(['idjenis_hewan', 'nama_jenis_hewan'])
            ->ordered()
            ->get();
    }

    public static function findById(int $id): ?self
    {
        return static::query()
            ->select(['idjenis_hewan', 'nama_jenis_hewan'])
            ->where('idjenis_hewan', $id)
            ->first();
    }

    public static function createOne(string $nama): self
    {
        $data = ['nama_jenis_hewan' => $nama];

        $v = Validator::make($data, [
            'nama_jenis_hewan' => ['required', 'string', 'max:100'],
        ]);
        if ($v->fails()) {
            throw new ValidationException($v);
        }

        return static::create($data);
    }

    public static function updateOne(int $id, string $nama): bool
    {
        $v = Validator::make(
            ['nama_jenis_hewan' => $nama],
            ['nama_jenis_hewan' => ['required', 'string', 'max:100']]
        );
        if ($v->fails()) {
            throw new ValidationException($v);
        }

        $model = static::find($id);
        if (! $model) {
            return false;
        }

        $model->nama_jenis_hewan = $nama;
        return $model->save();
    }

    public static function deleteOne(int $id): bool
    {
        $model = static::find($id);
        if (! $model) {
            return false;
        }

        if (function_exists('auth') && auth()->check()) {
            $model->deleted_by = auth()->id();
            $model->save();
        }

        return (bool) $model->delete();
    }
}
