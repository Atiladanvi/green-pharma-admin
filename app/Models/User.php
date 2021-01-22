<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, CentralConnection;

    static $ADMINISTRADOR = 'administrador';

    static $ANALISTA = 'analista';

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
        return $this->roles->first()->name;
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
