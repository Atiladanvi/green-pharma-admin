<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name', 'uf'
    ];

    public $timestamps = false;

    public function sales()
    {
        return $this->hasMany(SalesMonth::class);
    }
}
