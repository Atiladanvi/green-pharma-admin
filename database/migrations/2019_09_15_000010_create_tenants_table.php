<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    public $tableName = 'tenants';

    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->json('data')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
