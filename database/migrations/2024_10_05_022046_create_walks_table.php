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
        Schema::create('walks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dog_owner_id')->unsigned();
            $table->foreign('dog_owner_id')
                  ->references('id')
                  ->on('dog_owner')->onDelete('cascade');
            $table->dateTime('started_at');
            $table->dateTime('finished_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walks');
    }
};
