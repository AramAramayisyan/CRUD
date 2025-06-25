<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Spatie\Permission\Traits\HasRoles;

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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productsWithTypes()
    {
        return $this->hasMany(Product::class)->with('type');
    }

    public function hasRole($roles)
    {
        if (is_array($roles) && in_array($this->role, $roles)) {
            return true;
        }
        return $this->role === $roles;
    }
}
