<?php

namespace App\Models;

use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase;

    protected $fillable = [
        'id',
        'data'
    ];

    public function getTenantKey()
    {
        return $this->id;
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'data'
        ];
    }

    public function getIncrementing()
    {
        return true;
    }

    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id');
    }
}
