<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('not_founds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url');
            $table->ipAddress('ip');
            $table->string('referer')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('not_founds');
    }
};
