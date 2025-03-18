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
        Schema::create('appointment_immunizations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('weight', 6, 2)->nullable();
            $table->boolean('was_breastfeed');
            $table->tinyInteger('weight_id')->unsigned()->nullable();
            $table->foreign('weight_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->tinyInteger('cpab_id')->unsigned()->nullable();
            $table->foreign('cpab_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->integer('appointment_id')->unsigned()->index();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_immunizations');
    }
};
