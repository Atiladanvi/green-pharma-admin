<?php

namespace App;

use Aspera\Spreadsheet\XLSX\Reader;
use DateTime;
use Illuminate\Support\Facades\DB;

class ImportSalesFromCsv
{
    private $csvFile;

    public $insert_chunk_size = 50;

    public function setCsvFile($csvFile)
    {
        $this->csvFile = $csvFile;

        return $this;
    }

    public function process($warehouse, $type)
    {
        $reader = new Reader();
        $reader->open($this->csvFile);

        $data = [];
        $fields = [];
        $row_count = 0;

        foreach ($reader as $key => $row) {
            if ($key === 1) {
                $fields = $row;
            } else {
                foreach ($row as $i => $item) {
                    $data[$row_count][$fields[$i]] = $item;
                }

                $fields = array_keys($data[$row_count]);
                $sales = [];

                foreach ($fields as $field) {
                    $date = DateTime::createFromFormat('m/Y', $field);
                    if ($date && is_numeric($data[$row_count][$field])) {
                        array_push($sales, ['data' => $date, 'valor' =>  $data[$row_count][$field], 'tipo' => $type, 'unidade_id' => $warehouse->id]);
                    }
                }
                foreach ($sales as $sale) {
                    $salesData = [
                        'descricao' => $data[$row_count]['DESCRIÇÃO'],
                        'fornecedor' => $data[$row_count]['FORNECEDOR'],
                        'produto' => $data[$row_count]['PRODUTO'],
                        'ean' =>  $data[$row_count]['EAN'],
                        'tipo' => $sale['tipo'],
                        'unidade_id' => $sale['unidade_id'],
                        'data' => $sale['data']->format('Y-m-d'),
                        'valor' => $sale['valor']
                    ];

                    DB::table('sales_months_reports')->updateOrInsert($salesData);
                }
                $row_count++;
            }
        }
        $reader->close();
    }
}
