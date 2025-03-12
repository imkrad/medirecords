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
        Schema::create('appointment_maternal_deliveries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('weight');
            $table->string('sex');
            $table->string('attendant_name');
            $table->string('attendant_type');
            $table->longText('remarks');
            $table->tinyInteger('outcome_id')->unsigned()->nullable(); 
            $table->foreign('outcome_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->tinyInteger('facility_id')->unsigned()->nullable(); 
            $table->foreign('facility_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->tinyInteger('delivery_id')->unsigned()->nullable();
            $table->foreign('delivery_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->integer('am_id')->unsigned()->index();
            $table->foreign('am_id')->references('id')->on('appointment_maternals')->onDelete('cascade');
            $table->datetime('delivery_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_maternal_deliveries');
    }
};
