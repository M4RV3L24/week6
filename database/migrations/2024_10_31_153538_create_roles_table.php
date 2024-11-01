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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::table('users', function($table) {
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function($table) {
            // Drop foreign key constraints first (FK indexes)
            $table->dropForeign(['role_id']);
            // Drop column
            $table->dropColumn('role_id');
        });

        // Drop roles table, after foreign key column has been deleted
        Schema::dropIfExists('roles');
    }
};
