<?php

namespace App\Exports;

use App\Models\SalesMonth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SalesMonthsExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('report.table', [
            'results' => SalesMonth::query()
                ->where('fornecedor', '=' , request()->get('fornecedor'))
                ->where('warehouse_id', '=' , request()->get('unidade'))
                ->where('tipo', '=' , request()->get('tipo'))
                ->when(request()->get('data_inicial') && request()->get('data_final'),function (\Illuminate\Database\Eloquent\Builder $q){
                    return $q->whereBetween('data' , [request()->get('data_inicial'), request()->get('data_final')]);
                })
                ->get()
                ->groupBy('descricao')
        ]);
    }
}
