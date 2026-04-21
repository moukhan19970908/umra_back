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
        Schema::table('books', function (Blueprint $table) {
            $table->string('full_name');
            $table->foreignId('country_id')->constrained();
            $table->string('address');
            $table->foreignId('marital_status_id')->constrained();
            $table->string('profession');
            $table->string('work_address');
            $table->string('whatsapp_number');
            $table->integer('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            //
        });
    }
};
