<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function products() : HasMany // get products
    {
        return $this->hasMany(Product::class);
    }

    public function productsWithTypes() : HasMany // get products with types
    {
        return $this->hasMany(Product::class)->with('type');
    }

    public function hasRole($roles) : bool // check user role
    {
        if (is_array($roles) && in_array($this->role, $roles)) {
            return true;
        }
        return $this->role === $roles;
    }

    /**
     * Check if the user has admin role
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}
