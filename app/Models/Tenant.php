<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    protected $fillable = [
        'data'
    ];

    public function getTenantKey()
    {
        return $this->id;
    }

    public static function getCustomColumns(): array
    {
        return [
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
