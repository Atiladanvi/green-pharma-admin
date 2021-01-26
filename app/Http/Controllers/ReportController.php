<?php

namespace App\Http\Controllers;

use App\Tables\ReportTable;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $table = (new ReportTable($request->get('warehouse_id') ?? null))->setup();

        return view('report.index')->with(compact('table'));
    }
}
