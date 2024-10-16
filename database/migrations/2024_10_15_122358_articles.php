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
        Schema::connection('english')->create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('news_id');
            $table->timestamps();});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
