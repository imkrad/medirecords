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
        Schema::create('appointment_families', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('dropout_at')->nullable();
            $table->boolean('is_dropout')->default(0);
            $table->tinyInteger('reason_id')->unsigned()->nullable(); //reason family planning
            $table->foreign('reason_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->tinyInteger('method_id')->unsigned()->nullable(); //method family planning
            $table->foreign('method_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->tinyInteger('type_id')->unsigned()->nullable(); //type family planning
            $table->foreign('type_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
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
        Schema::dropIfExists('appointment_families');
    }
};
