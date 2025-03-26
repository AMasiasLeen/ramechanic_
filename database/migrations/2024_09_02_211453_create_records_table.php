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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->date("date_in");
            $table->foreignId("vehicle_id")->constrained("vehicles");
            $table->string("short_description");
            $table->text("long_description");
            // $table->string("main_image");
            $table->text("images")->nullable();
            $table->timestamps();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
