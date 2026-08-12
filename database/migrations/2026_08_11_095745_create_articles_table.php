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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('h1')->nullable();
            $table->string('excerpt', 500)->nullable();
            $table->longText('content')->nullable();

            $table->string('category')->nullable();
            $table->json('tags')->nullable();

            $table->string('image')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->boolean('is_active')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->unsignedInteger('sort')->default(0);

            $table->timestamps();

            $table->index('is_active');
            $table->index('published_at');
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
