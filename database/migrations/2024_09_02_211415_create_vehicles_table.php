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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string("plate");
            $table->string("engine_serial")->nullable();
            $table->string("serial_number")->nullable();
            $table->string("color")->nullable();
            $table->integer("year");
            $table->foreignId("vehicle_model_id")->constrained();
            $table->foreignId("owner_id")->constrained("users");
            $table->string("main_image")->nullable();
            $table->timestamps();
            $table->foreignId("user_id")->constrained("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
