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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->longText('header_image');
            $table->string('name');
            $table->longText('description');
            $table->text('short_description');
            $table->bigInteger('price');
            $table->string('slug')->unique();
            $table->longText('embedded_maps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
