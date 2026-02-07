<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_soft_deletes_to_tickets_table.php
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->softDeletes(); // Adds 'deleted_at' column
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
