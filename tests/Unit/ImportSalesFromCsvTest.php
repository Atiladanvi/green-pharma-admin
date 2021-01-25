<?php

namespace Tests\Unit;

use App\ImportSalesFromCsv;
use App\Models\SalesMonth;
use App\Models\Warehouse;
use Tests\TestCase;

class ImportSalesFromCsvTest extends TestCase
{
    public function test_process()
    {
        $file = __DIR__ . '/venda_01_01_2020_01_12_2020_06_01_2021_15_44_53_MG_1.xlsx';

        $ware =  Warehouse::get()->first();
        $valuetype = 'value';

        (new ImportSalesFromCsv())
            ->setCsvFile($file)
            ->process($ware, $valuetype);

        $sales = SalesMonth::get()->first();

        $this->assertIsObject($sales);

    }
}
