<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesMonth extends Model
{
    static $TYPE_VALUE = 'VALUE';

    static $TYPE_QUANTITY = 'QUANTITY';

    protected $table = 'sales_months_reports';

    protected $fillable = [
        'descricao', 'fornecedor', 'unidade_id', 'produto', 'ean', 'valor', 'tipo', 'data'
    ];
}
