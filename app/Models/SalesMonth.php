<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SalesMonth extends Model
{
    static $TYPE_VALUE = 'VALUE';

    static $TYPE_QUANTITY = 'QUANTITY';

    protected $table = 'sales_months_reports';

    protected $fillable = [
        'descricao', 'fornecedor', 'warehouse_id', 'produto', 'ean', 'valor', 'tipo', 'data'
    ];

    public $timestamps  = false;


    public function getDataAttribute($value)
    {
        return is_string($value) ? Carbon::createFromFormat('F j Y H:i:s:A', $value)->format('m/Y') : $value;
    }
}
