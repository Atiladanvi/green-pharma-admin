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
            $table->string('descricao');
            $table->string('fornecedor', 100);
            $table->integer('unidade_id');
            $table->string('produto');
            $table->string('ean', 13);
            $table->string('valor', 50);
            $table->string('tipo', 45);
            $table->date('data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
