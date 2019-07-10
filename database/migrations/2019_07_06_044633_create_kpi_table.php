<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable(); // Tên KPI
            $table->string('code')->nullable(); // Mã KPI
            $table->string('unit')->nullable(); // ĐVT
            $table->integer('trend')->nullable()->default(1); // Chiều hướng tốt
            $table->double('percent', 8, 2)->nullable(); // Tỷ trọng
            $table->double('target', 8, 2)->nullable(); // Chỉ tiêu
            $table->double('perform', 8, 2)->nullable(); // Thực hiện
            $table->double('per_perform', 8, 2)->nullable(); // % thực hiện
            $table->double('score', 8, 2)->nullable(); // Điểm
            $table->double('efficiency', 8, 2)->nullable(); // hiệu suất
            $table->integer('user_id')->nullable()->default(1); // user id
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
        Schema::dropIfExists('kpis');
    }
}
