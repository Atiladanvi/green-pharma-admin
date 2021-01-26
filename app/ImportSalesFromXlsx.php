<?php

namespace App;

use Aspera\Spreadsheet\XLSX\Reader;
use DateTime;
use Illuminate\Support\Facades\DB;

class ImportSalesFromXlsx
{
    private $xlsxFile;

    private $upsert_chunk_size = 50;

    private $data = [];

    public function setXlsxFile($xlsxFile)
    {
        $this->xlsxFile = $xlsxFile;

        return $this;
    }

    public function process($warehouse, $type)
    {
        $reader = new Reader();
        $reader->open($this->xlsxFile);

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
                    if ($date) {
                        array_push($sales, ['data' => $date, 'valor' =>  $data[$row_count][$field], 'tipo' => $type, 'warehouse_id' => $warehouse->id]);
                    }
                }
                foreach ($sales as $sale) {
                    $salesData = [
                        'descricao' => $data[$row_count]['DESCRIÇÃO'],
                        'fornecedor' => $data[$row_count]['FORNECEDOR'],
                        'warehouse_id' => $sale['warehouse_id'],
                        'produto' => $data[$row_count]['PRODUTO'],
                        'ean' =>  $data[$row_count]['EAN'],
                        'tipo' => $sale['tipo'],
                        'valor' => $sale['valor'],
                        'data' => $sale['data']->format('Y-m-d')
                    ];
                    array_push($this->data, $salesData);
                }
                $row_count++;
            }
        }

        $reader->close();

        $dataChunks = array_chunk($this->data, ceil(count($this->data) / $this->upsert_chunk_size));
        $this->data = [];

        foreach ($dataChunks as $dataChunk){
            DB::table('sales_months_reports')->upsert(
                $dataChunk,
                ['descricao', 'fornecedor', 'warehouse_id', 'produto' , 'ean', 'tipo', 'data'],
                ['valor']
            );
        }

    }
}
