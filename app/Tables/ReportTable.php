<?php

namespace App\Tables;

use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;
use App\Models\SalesMonth;
use Illuminate\Database\Eloquent\Builder;

class ReportTable extends AbstractTable
{
    protected $warehouseId;

    public function __construct(int $warehouseId)
    {
        $this->warehouseId = $warehouseId;
    }

    protected function table(): Table
    {
        return (new Table())->model(SalesMonth::class)
        ->routes([
            'index' => ['name' => 'report.index']
        ])
        ->query(function (Builder $query) {
            $query->where('unidade_id', $this->warehouseId);
        });
    }

    protected function columns(Table $table): void
    {
        $table->column('id')->sortable(true)->title('ID');
        $table->column('produto')->sortable()->searchable()->title('Código');
        $table->column('ean')->sortable()->searchable()->title('Ean');
        $table->column('descricao')->sortable()->searchable()->title('Descrição');
        $table->column('fornecedor')->sortable()->searchable()->title('Fornecedor');
        $table->column('data')->dateTimeFormat('m/Y')->sortable()->title('Mês/Ano');
        $table->column('valor')->sortable()->title('Qt/Valor');
    }
}
