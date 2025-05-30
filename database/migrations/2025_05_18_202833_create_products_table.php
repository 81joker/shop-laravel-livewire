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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('price');
            $table->unsignedInteger('main_image_id')->nullable();

            // $table->unsignedBigInteger('main_image_id')->nullable();
            // $table->foreign('main_image_id')->references('id')->on('images')->nullOnDelete();
            //  $table->foreignId('main_image_id')->nullable()->constrained('images')->onDelete('cascade')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
