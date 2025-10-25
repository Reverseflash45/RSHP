<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JenisHewan extends Model
{
    /** =========================
     *  Konfigurasi Eloquent
     *  ========================= */
    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    public $timestamps = false;

    // Jika PK integer auto-increment:
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh di-mass-assign
    protected $fillable = ['nama_jenis_hewan'];

    // Casting kolom → mirip fromRow() di native
    protected $casts = [
        'idjenis_hewan'    => 'integer',
        'nama_jenis_hewan' => 'string',
    ];

    /** =========================
     *  Accessor / Helper
     *  ========================= */

    /**
     * Mirip method get() di class native:
     * kembalikan array ringkas dari instance saat ini.
     */
    public function toArraySimple(): array
    {
        return [
            'idjenis_hewan'    => (int) $this->idjenis_hewan,
            'nama_jenis_hewan' => (string) $this->nama_jenis_hewan,
        ];
    }

    /** =========================
     *  Query Scopes
     *  ========================= */

    /**
     * scopeOrdered: ORDER BY idjenis_hewan ASC
     */
    public function scopeOrdered(Builder $q): Builder
    {
        return $q->orderBy('idjenis_hewan', 'asc');
    }

    /** =========================
     *  Static API (wrapper ala native)
     *  ========================= */

    /**
     * getAll(): kembalikan Collection<JenisHewan>
     * Gunakan ->map->toArraySimple() di controller jika mau array sederhana.
     */
    public static function getAll(): \Illuminate\Support\Collection
    {
        return static::query()
            ->select(['idjenis_hewan', 'nama_jenis_hewan'])
            ->ordered()
            ->get();
    }

    /**
     * findById(int $id): ?JenisHewan
     */
    public static function findById(int $id): ?self
    {
        return static::query()
            ->select(['idjenis_hewan', 'nama_jenis_hewan'])
            ->where('idjenis_hewan', $id)
            ->first();
    }

    /**
     * createOne(string $nama): JenisHewan
     * Lempar ValidationException jika input tidak valid.
     */
    public static function createOne(string $nama): self
    {
        $data = ['nama_jenis_hewan' => $nama];

        // Validasi ringan (opsional)
        $v = Validator::make($data, [
            'nama_jenis_hewan' => ['required', 'string', 'max:100'],
        ]);
        if ($v->fails()) {
            throw new ValidationException($v);
        }

        return static::create($data);
    }

    /**
     * updateOne(int $id, string $nama): bool
     * true jika berhasil, false jika id tidak ditemukan.
     * Lempar ValidationException jika input tidak valid.
     */
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
        if (!$model) {
            return false;
        }
        $model->nama_jenis_hewan = $nama;
        return $model->save();
    }

    /**
     * deleteOne(int $id): bool
     * Hard delete seperti class native-mu.
     * (Kalau mau soft delete, aktifkan SoftDeletes dan ganti ->delete() sesuai kebutuhan.)
     */
    public static function deleteOne(int $id): bool
    {
        $model = static::find($id);
        return $model ? (bool) $model->delete() : false;
    }
}
