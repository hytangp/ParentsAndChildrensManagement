<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parents_childrens', function (Blueprint $table) {
            $table->boolean('sent')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('parents_childrens', function (Blueprint $table) {
            $table->dropColumn('sent');
        });
    }
};