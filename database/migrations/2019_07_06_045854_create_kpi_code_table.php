<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpiCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(); // Mã KPI
            $table->text('config')->nullable(); // Cấu hình thang do khi chi tieu giao = 0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_code');
    }
}
