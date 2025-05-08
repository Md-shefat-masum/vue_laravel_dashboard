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
        Schema::create('web_pages', function (Blueprint $table) {
            $table->id();

            $table->string('url',100)->nullable();
            $table->string('title',150)->nullable();
            $table->text('content')->nullable();
            $table->json('custom_fields')->nullable();

            $table->string('meta_title',150)->nullable();
            $table->string('meta_description',150)->nullable();
            $table->string('meta_keywords',150)->nullable();
            $table->string('og_image',150)->nullable();
            $table->string('og_description',150)->nullable();

            $table->boolean('requires_login')->default(false);
            $table->string('access_roles', 255)->nullable();

            $table->integer('views')->unsigned()->default(0);
            $table->bigInteger('template')->unsigned()->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug',50)->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_pages');
    }
};
