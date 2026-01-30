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
        Schema::create('parents_childrens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('children_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('parents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('children_id')->references('id')->on('childrens')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents_childrens');
    }
};
