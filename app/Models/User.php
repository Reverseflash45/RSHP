<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /** ========= Konfigurasi DB ========= */
    protected $table = 'user';          // <— tabelmu memang 'user'
    protected $primaryKey = 'iduser';   // <— PK custom
    public $timestamps = false;

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama', 'email', 'password'];

    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = [
        'iduser' => 'integer',
        'nama'   => 'string',
        'email'  => 'string',
    ];

    /** ========= Relasi ========= */
    public function roles(): BelongsToMany
    {
        // pivot user_role: {iduser, idrole, status}
        return $this->belongsToMany(Role::class, 'user_role', 'iduser', 'idrole')
                    ->withPivot(['status']);
    }

    /** ========= API mirip class native ========= */

    // set_user()
    public function set_user(int $iduser, string $nama, string $email, string $password): void
    {
        $this->iduser   = $iduser;
        $this->nama     = $nama;
        $this->email    = $email;
        $this->password = $password; // catatan: sudah di-hash di DB
    }

    // get_user()
    public function get_user(): array
    {
        return [
            'iduser'   => (int) $this->iduser,
            'nama'     => (string) $this->nama,
            'email'    => (string) $this->email,
            'password' => (string) $this->password,   // jangan kirim ke view publik
            'role'     => $this->get_role_aktif(),    // Role|null
        ];
    }

    // verify_password()
    public function verify_password(string $input_password): bool
    {
        return Hash::check($input_password, $this->password);
    }

    // get_id(), get_nama(), get_email()
    public function get_id(): int     { return (int) $this->iduser; }
    public function get_nama(): string{ return (string) $this->nama; }
    public function get_email(): string { return (string) $this->email; }

    /** ========= Role aktif — kompatibel dengan versi native ========= */

    // get_role_aktif(): ?Role
    public function get_role_aktif(): ?Role
    {
        return $this->roles()->wherePivot('status', 1)->first();
    }

    /**
     * set_role(Role $role):
     * - Jika $role->status === true, nonaktifkan role lain, aktifkan yang ini.
     * - Jika false, hanya menambah non-aktif.
     */
    public function set_role(Role $role): void
    {
        $active = (bool) ($role->get_data()['status'] ?? false);

        DB::transaction(function () use ($role, $active) {
            // pastikan sudah attach
            if (! $this->roles()->where('role.idrole', $role->idrole)->exists()) {
                $this->roles()->attach($role->idrole, ['status' => 0]);
            }

            if ($active) {
                // matikan semua
                $this->roles()->updateExistingPivot(
                    $this->roles()->pluck('role.idrole')->all(),
                    ['status' => 0]
                );
                // aktifkan yang dipilih
                $this->roles()->updateExistingPivot($role->idrole, ['status' => 1]);
            } else {
                // hanya pastikan role ada (status 0)
                $this->roles()->updateExistingPivot($role->idrole, ['status' => 0]);
            }
        });
    }

    /** ========= Static helpers ala native ========= */

    // getAll(): array<User> (kamu biasa pakai array; bisa juga Collection)
    public static function getAll(): array
    {
        /** @var Collection<int,User> $rows */
        $rows = static::query()->get();
        return $rows->all();
    }

    // findById()
    public static function findById(int $id): ?self
    {
        return static::query()->where('iduser', $id)->first();
    }

    // findByEmail()
    public static function findByEmail(string $email): ?self
    {
        return static::query()->where('email', $email)->first();
    }

    // save(DBconnection $db) → di Eloquent: $user->save()
    // Supaya kompatibel, sediakan createOne()
    public static function createOne(string $nama, string $email, string $plainPass): self
    {
        return static::create([
            'nama'     => $nama,
            'email'    => $email,
            'password' => Hash::make($plainPass),
        ]);
    }

    // updateNama(DBconnection $db, string $nama_baru)
    public function updateNama(string $nama_baru): bool
    {
        $this->nama = $nama_baru;
        return $this->save();
    }

    // resetPassword(DBconnection $db, string $plainPass = "123456")
    public function resetPassword(string $plainPass = '123456'): bool
    {
        $this->password = Hash::make($plainPass);
        return $this->save();
    }
}
