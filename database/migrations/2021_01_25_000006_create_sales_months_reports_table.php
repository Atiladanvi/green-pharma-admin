<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesMonthsReportsTable extends Migration
{
    public $tableName = 'sales_months_reports';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warehouse_id');
            $table->string('descricao');
            $table->string('fornecedor');
            $table->string('produto');
            $table->string('ean');
            $table->string('valor');
            $table->string('tipo');
            $table->date('data');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
