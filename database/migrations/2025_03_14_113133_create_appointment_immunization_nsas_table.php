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
        Schema::create('appointment_immunization_nsas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->boolean('is_completed')->default(0);
            $table->date('date_at')->nullable();
            $table->string('age');
            $table->decimal('length', 5, 2)->nullable();
            $table->decimal('weight', 6, 2)->nullable();
            $table->tinyInteger('range_id')->unsigned()->nullable();
            $table->foreign('range_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->tinyInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
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
        Schema::dropIfExists('appointment_immunization_nsas');
    }
};
