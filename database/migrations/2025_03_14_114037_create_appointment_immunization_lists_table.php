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
        Schema::create('appointment_immunization_lists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->boolean('is_completed')->default(0);
            $table->date('date_at')->nullable();
            $table->longText('remarks')->nullable();
            $table->tinyInteger('range_id')->unsigned()->nullable();
            $table->foreign('range_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->integer('vaccine_id')->unsigned()->index();
            $table->foreign('vaccine_id')->references('id')->on('immunizations')->onDelete('cascade');
            $table->integer('ai_id')->unsigned()->index();
            $table->foreign('ai_id')->references('id')->on('appointment_immunizations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_immunization_lists');
    }
};
