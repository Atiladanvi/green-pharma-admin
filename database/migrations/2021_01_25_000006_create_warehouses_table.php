<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousesTable extends Migration
{
    public $tableName = 'warehouses';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('uf', 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
