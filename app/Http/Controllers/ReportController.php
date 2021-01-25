<?php

namespace App\Http\Controllers;

use App\Tables\ReportTable;

class ReportController extends Controller
{
    public function index()
    {
        $table = (new ReportTable(tenant()->id))->setup();

        return view('report.index')->with(compact('table'));
    }
}
