<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $descricao
 * @property string $fornecedor
 * @property int $unidade_id
 * @property string $produto
 * @property string $ean
 * @property string $valor
 * @property string $tipo
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 */
class SalesMonth extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_months_reports';

    /**
     * @var array
     */
    protected $fillable = ['descricao', 'fornecedor', 'unidade_id', 'produto', 'ean', 'valor', 'tipo', 'data', 'created_at', 'updated_at'];

}
