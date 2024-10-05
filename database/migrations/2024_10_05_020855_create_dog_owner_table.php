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
        Schema::create('dog_owner', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dog_id')->unsigned();
            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('dog_id')
                  ->references('id')
                  ->on('dogs')->onDelete('cascade');
            $table->foreign('owner_id')
                  ->references('id')
                  ->on('owners')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dog_owner');
    }
};
