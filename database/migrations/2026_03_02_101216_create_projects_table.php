<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('title_short')->nullable();
            $table->string('category')->nullable();
            $table->string('price')->nullable();
            $table->string('duration')->nullable();
            $table->string('complexity')->nullable();
            $table->string('client')->nullable();
            $table->string('website')->nullable();
            $table->boolean('has_logo')->default(false);
            $table->string('logo')->nullable();
            $table->string('logo_color')->nullable();
            $table->text('task')->nullable();
            $table->json('tags')->nullable();
            $table->text('solution_text')->nullable();
            $table->json('solution_list')->nullable();
            $table->json('technologies')->nullable();
            $table->json('results')->nullable();
            $table->json('details')->nullable();
            $table->text('result')->nullable();
            $table->integer('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};