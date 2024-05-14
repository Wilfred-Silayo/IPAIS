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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->unsignedBigInteger('lost_item_id')->nullable();
            $table->unsignedBigInteger('crime_id')->nullable();
            $table->foreign('crime_id')->references('id')
            ->on('crimes')->onDelete('cascade');
            $table->foreign('lost_item_id')->references('id')
            ->on('lost_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
