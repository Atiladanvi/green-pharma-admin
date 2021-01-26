<?php

namespace App\Http\Controllers;

use App\Exports\SalesMonthsExport;
use App\Forms\ImportReportForm;
use App\Forms\ExportReportForm;
use App\ImportSalesFromXlsx;
use App\Models\SalesMonth;
use App\Models\Warehouse;
use App\Tables\ReportTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Kris\LaravelFormBuilder\FormBuilder;

class ReportController extends Controller
{
    public function exporter(Request $request, FormBuilder $formBuilder)
    {
        $response = [];

        $wareHouse = Warehouse::find($request->get('unidade'));

        if ($request->get('export'))
            return (new SalesMonthsExport())->download($wareHouse->name.$request->get('data_inicial').$request->get('data_final').'.xlsx', \Maatwebsite\Excel\Excel::XLSX);

        if (!$request->get('filter'))
            $response['table'] = (new ReportTable($request->get('warehouse_id') ?? null))->setup();

        if ($request->get('filter'))
            $response['results'] = SalesMonth::query()
                ->where('fornecedor', '=' , $request->get('fornecedor'))
                ->where('warehouse_id', '=' , $request->get('unidade'))
                ->where('tipo', '=' , $request->get('tipo'))
                ->when($request->get('data_inicial') && $request->get('data_final'),function (Builder $q) use ($request){
                    return $q->whereBetween('data' , [$request->get('data_inicial'), $request->get('data_final')]);
                })
                ->get()
                ->groupBy('descricao');

        $response['form'] = $formBuilder->create(ExportReportForm::class, [
            'method' => 'GET',
            'url' => route('report.exporter'),
            'model' => [
                'tipo' => $request->get('tipo'),
                'fornecedor' => $request->get('fornecedor'),
                'unidade' => $request->get('unidade'),
                'data_inicial' => $request->get('data_inicial'),
                'data_final' => $request->get('data_final'),
            ]
        ]);

        return view('report.exporter')->with($response);
    }

    public function importer(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(ImportReportForm::class, [
            'method' => 'POST',
            'url' => route('report.import')
        ]);

        return view('report.importer', compact('form'));
    }

    public function import(Request $request)
    {
        $filePath = $request->file('file')->move('imports/'.Str::uuid(). '.xslx');

        try {
            (new ImportSalesFromXlsx())
                ->setXlsxFile($filePath)
                ->process(
                    Warehouse::find($request->get('unidade')),
                    collect([SalesMonth::$TYPE_VALUE, SalesMonth::$TYPE_QUANTITY])
                        ->has($request->get('tipo')) ? $request->get('tipo') : SalesMonth::$TYPE_QUANTITY
                );
        }catch (\Exception $exception){
            report($exception);
            return redirect()->route('report.exporter')
                ->with('err', $exception->getMessage());
        }

        return redirect()->route('report.exporter')
            ->with('msg', 'Your file has been imported successfully !');
    }

}
