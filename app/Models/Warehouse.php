<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $uf
 * @property string $created_at
 * @property string $updated_at
 * @property Sale[] $sales
 */
class Warehouse extends Model
{
    protected $fillable = ['name', 'uf', 'created_at', 'updated_at'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
