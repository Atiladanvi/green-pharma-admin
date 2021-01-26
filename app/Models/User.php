<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    static $ADMIN = 'admin';

    static $ANALYST = 'analyst';

    protected $fillable = [
        'name',
        'tenant_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
      'role'
    ];

    public function getRoleAttribute()
    {
        return $this->roles->first()->name ?? null;
    }
}
