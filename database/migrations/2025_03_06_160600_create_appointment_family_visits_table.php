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
        Schema::create('appointment_family_visits', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('bloodpressure',100)->nullable();
            $table->string('pulserate',100)->nullable();
            $table->string('temperature',100)->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('af_id')->unsigned()->index();
            $table->foreign('af_id')->references('id')->on('appointment_families')->onDelete('cascade');
            $table->date('visited_at')->nullable();
            $table->date('scheduled_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_family_visits');
    }
};
