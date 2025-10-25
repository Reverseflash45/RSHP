<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Pemilik extends Model
{
    /** =========================
     *  Konfigurasi Eloquent
     *  ========================= */
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['no_wa', 'alamat', 'iduser'];

    protected $casts = [
        'idpemilik' => 'integer',
        'iduser'    => 'integer',
        'no_wa'     => 'string',
        'alamat'    => 'string',
    ];

    /** =========================
     *  Relasi
     *  ========================= */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /** =========================
     *  SETTER / GETTER ala native
     *  (opsional, jika masih dipakai)
     *  ========================= */
    public function set_pemilik(?int $idpemilik, ?string $no_wa, ?string $alamat): void
    {
        if ($idpemilik !== null) $this->idpemilik = $idpemilik;
        $this->no_wa  = $no_wa;
        $this->alamat = $alamat;
    }

    public function isComplete(): bool
    {
        return !empty($this->no_wa) && !empty($this->alamat);
    }

    public function get_idpemilik(): ?int { return $this->idpemilik; }
    public function get_no_wa(): ?string  { return $this->no_wa; }
    public function get_alamat(): ?string { return $this->alamat; }

    /**
     * Mirip to_array() di native, menggabungkan data user.
     */
    public function to_array(): array
    {
        $u = $this->relationLoaded('user') ? $this->user : $this->user()->first();
        return [
            'iduser'    => $u?->iduser,
            'nama'      => $u?->nama,
            'email'     => $u?->email,
            'idpemilik' => $this->idpemilik,
            'no_wa'     => $this->no_wa,
            'alamat'    => $this->alamat,
        ];
    }

    /** =========================
     *  VALIDASI INPUT
     *  ========================= */
    public static function rulesUser(bool $withPassword = true): array
    {
        $base = [
            'nama'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:120'],
        ];
        if ($withPassword) {
            $base['password'] = ['required', 'string', 'min:6'];
        }
        return $base;
    }

    public static function rulesPemilik(): array
    {
        return [
            'no_wa'  => ['required', 'string', 'max:30'],
            'alamat' => ['required', 'string', 'max:255'],
        ];
        }
    /** =========================
     *  CREATE (user + pemilik) ala native::create(...)
     *  return array: status, message, iduser, idpemilik
     *  ========================= */
    public static function createWithUser(
        string $nama,
        string $email,
        string $password,
        string $no_wa,
        string $alamat
    ): array {
        // Trim
        $nama = trim($nama); $email = trim($email);
        $no_wa = trim($no_wa); $alamat = trim($alamat);

        // Validasi
        $v1 = Validator::make(
            compact('nama','email','password'),
            self::rulesUser(true)
        );
        $v2 = Validator::make(
            compact('no_wa','alamat'),
            self::rulesPemilik()
        );

        if ($v1->fails() || $v2->fails()) {
            $errors = array_merge($v1->errors()->toArray(), $v2->errors()->toArray());
            return ['status' => 'error', 'message' => $errors];
        }

        try {
            $result = DB::transaction(function () use ($nama, $email, $password, $no_wa, $alamat) {
                // Cek email unik di table user
                if (User::where('email', $email)->exists()) {
                    throw new \Exception('Email sudah terdaftar');
                }

                // Insert user
                $user = new User();
                $user->nama = $nama;
                $user->email = $email;
                $user->password = Hash::make($password);
                $user->save();

                // Insert pemilik
                $pemilik = new self();
                $pemilik->no_wa  = $no_wa;
                $pemilik->alamat = $alamat;
                $pemilik->iduser = (int)$user->iduser;
                $pemilik->save();

                return [
                    'status'    => 'success',
                    'message'   => 'Registrasi berhasil',
                    'iduser'    => (int)$user->iduser,
                    'idpemilik' => (int)$pemilik->idpemilik,
                ];
            });

            return $result;
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /** =========================
     *  FINDERS ala native
     *  ========================= */

    // NULL kalau user tsb bukan pemilik
    public static function findByUserId(int $iduser): ?self
    {
        return self::query()
            ->where('iduser', $iduser)
            ->with('user')
            ->first();
    }

    // Untuk _pemilik_auth.php yang memanggil findByEmail
    public static function findByEmail(string $email): ?self
    {
        $user = User::where('email', $email)->first();
        if (!$user) return null;
        return self::findByUserId((int)$user->iduser);
    }

    /** =========================
     *  LIST (ADMIN) ala getAll()
     *  ========================= */
    public static function getAll(): \Illuminate\Support\Collection
    {
        return self::query()
            ->select(['pemilik.idpemilik', 'pemilik.no_wa', 'pemilik.alamat', 'user.nama', 'user.email'])
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->orderBy('pemilik.idpemilik', 'asc')
            ->get();
    }

    /** =========================
     *  UPDATE (ADMIN) ala update(...)
     *  ========================= */
    public static function updateComposite(
        int $idpemilik,
        string $nama,
        string $email,
        ?string $password,
        string $no_wa,
        string $alamat
    ): array {
        // Validasi input dasar
        $vUser = Validator::make(
            ['nama'=>$nama,'email'=>$email] + ($password ? ['password'=>$password] : []),
            self::rulesUser($withPassword = (bool)$password)
        );
        $vOwner = Validator::make(compact('no_wa','alamat'), self::rulesPemilik());

        if ($vUser->fails() || $vOwner->fails()) {
            $errors = array_merge($vUser->errors()->toArray(), $vOwner->errors()->toArray());
            return ['status' => 'error', 'message' => $errors];
        }

        try {
            DB::transaction(function () use ($idpemilik, $nama, $email, $password, $no_wa, $alamat) {
                $pemilik = self::lockForUpdate()->find($idpemilik);
                if (!$pemilik) {
                    throw new \Exception('Data pemilik tidak ditemukan');
                }

                $user = User::lockForUpdate()->find($pemilik->iduser);
                if (!$user) {
                    throw new \Exception('User tidak ditemukan');
                }

                // Update user
                $user->nama = $nama;
                $user->email = $email;
                if ($password && $password !== '') {
                    $user->password = Hash::make($password);
                }
                $user->save();

                // Update pemilik
                $pemilik->no_wa  = $no_wa;
                $pemilik->alamat = $alamat;
                $pemilik->save();
            });

            return ['status' => 'success', 'message' => 'Tersimpan'];
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /** =========================
     *  UPSERT & DELETE ala native
     *  ========================= */
    public static function upsertByUserId(int $iduser, string $no_wa, string $alamat): bool
    {
        $no_wa = trim($no_wa);
        $alamat = trim($alamat);
        if ($no_wa === '' || $alamat === '') return false;

        $row = self::where('iduser', $iduser)->first();
        if ($row) {
            $row->update(['no_wa' => $no_wa, 'alamat' => $alamat]);
            return true;
        }
        self::create(['iduser' => $iduser, 'no_wa' => $no_wa, 'alamat' => $alamat]);
        return true;
    }

    public static function deleteByUserId(int $iduser): bool
    {
        return (bool) self::where('iduser', $iduser)->delete();
    }

    /** =========================
     *  LABEL ROLE
     *  ========================= */
    public function getDisplayRole(): string
    {
        return 'Pemilik';
    }

    /** =========================
     *  Helper kompatibilitas native
     *  ========================= */
    public static function create(array $attributes = [], array $options = [])
    {
        // override agar IDE happy terhadap return type self
        /** @var self $model */
        $model = parent::create($attributes, $options);
        return $model;
    }
}
