<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;
    const ROLE_SUPERADMIN = 2;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'integer',
        ];
    }

    public function isUser(): bool
    {
        return $this->is_admin === self::ROLE_USER;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin === self::ROLE_ADMIN;
    }

    public function isSuperAdmin(): bool
    {
        return $this->is_admin === self::ROLE_SUPERADMIN;
    }

    public function isAdminOrSuperAdmin(): bool
    {
        return $this->is_admin >= self::ROLE_ADMIN;
    }
    public function getRoleNameAttribute(): string
    {
        return match($this->is_admin) {
            self::ROLE_SUPERADMIN => 'Super Admin',
            self::ROLE_ADMIN => 'Admin',
            default => 'User',
        };
    }

    public static function getRoles(): array
    {
        return [
            self::ROLE_USER => 'User',
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_SUPERADMIN => 'Super Admin',
        ];
    }


    public function scopeByRole($query, $role)
    {
        return $query->where('is_admin', $role);
    }

    public function scopeAdmins($query)
    {
        return $query->where('is_admin', '>=', self::ROLE_ADMIN);
    }

    public function getFormattedUpdatedAtAttribute(): string
    {
        return Carbon::parse($this->attributes['updated_at'])->format('d-m-Y H:i');
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y H:i');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}