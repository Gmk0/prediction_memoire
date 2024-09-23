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
        Schema::create('prediction_results', function (Blueprint $table) {
            $table->id();
            $table->string('prediction')->nullable();
            $table->longText('recommandations')->nullable();
            $table->string('interprétation');
            $table->longText('classe')->nullable();
            $table->string('model_type')->nullable();
            $table->foreignId('medical_data_id')->constrained('medical_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediction_results');
    }
};
