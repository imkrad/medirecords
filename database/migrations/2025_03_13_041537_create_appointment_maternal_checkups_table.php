<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointment_maternal_checkups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->longText('remarks');
            $table->integer('am_id')->unsigned()->index();
            $table->foreign('am_id')->references('id')->on('appointment_maternals')->onDelete('cascade');
            $table->date('checkup_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_maternal_checkups');
    }
};
