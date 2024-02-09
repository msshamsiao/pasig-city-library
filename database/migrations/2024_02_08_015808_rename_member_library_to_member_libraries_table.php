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
        Schema::table('member_libraries', function (Blueprint $table) {
            $table->renameColumn('member_library_name', 'name');
            $table->renameColumn('member_library_email', 'email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_libraries', function (Blueprint $table) {
            $table->renameColumn('member_library_name', 'name');
            $table->renameColumn('member_library_email', 'email');
        });
    }
};
