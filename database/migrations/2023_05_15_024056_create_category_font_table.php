<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_font', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('font_id');

            $table->foreign('category_id')
                ->on('categories')
                ->references('id');
            $table->foreign('font_id')
                ->on('fonts')
                ->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_font');
    }
};
