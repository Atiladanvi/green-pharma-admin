<?php

namespace App;

use Aspera\Spreadsheet\XLSX\Reader;
use DateTime;
use Illuminate\Support\Facades\DB;

class ImportSalesFromCsv
{
    private $csvFile;

    private $insert_chunk_size = 50;

    private $data = [];

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
                    if ($date) {
                        array_push($sales, ['data' => $date, 'valor' =>  $data[$row_count][$field], 'tipo' => $type, 'unidade_id' => $warehouse->id]);
                    }
                }

                foreach ($sales as $sale) {
                    $salesData = [
                        'descricao' => $data[$row_count]['DESCRIÇÃO'],
                        'fornecedor' => $data[$row_count]['FORNECEDOR'],
                        'unidade_id' => $sale['unidade_id'],
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

        $this->data = collect($this->data)->unique('ean')->toArray();

        $dataChunks = array_chunk($this->data, ceil(count($this->data) / $this->insert_chunk_size));

        foreach ($dataChunks as $dataChunk){
            DB::table('sales_months_reports')->upsert(
                $dataChunk,
                ['descricao', 'fornecedor', 'unidade_id', 'produto' , 'ean', 'tipo', 'data'],
                ['valor']
            );
        }

        $reader->close();
    }
}
