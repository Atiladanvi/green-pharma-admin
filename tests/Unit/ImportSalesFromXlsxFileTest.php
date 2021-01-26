<?php

namespace Tests\Unit;

use App\ImportSalesFromXlsx;
use App\Models\SalesMonth;
use App\Models\Warehouse;
use Tests\TestCase;

class ImportSalesFromXlsxFileTest extends TestCase
{
    public function test_process()
    {
        // get file path
        $filePath = __DIR__ . '/sales.xlsx';

        // get the first warehouse
        $ware =  Warehouse::get()->first();

        // instance and process file
        (new ImportSalesFromXlsx())
            ->setXlsxFile($filePath)
            ->process($ware, SalesMonth::$TYPE_QUANTITY);

        // assert database contains
        $this->assertDatabaseHas('sales_months_reports', [
            'produto' => "90255"
        ]);
    }
}
