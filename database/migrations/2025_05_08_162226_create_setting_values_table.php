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
        Schema::create('setting_sub_group_values', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('setting_group_id')->unsigned()->nullable();
            $table->string('setting_group_title', 150)->nullable();

            $table->bigInteger('setting_sub_group_id')->unsigned()->nullable();
            $table->string('setting_sub_group_title', 150)->nullable();

            $table->string('title', 150)->nullable();
            $table->text('value')->nullable();
            $table->enum('type', ['file', 'text'])->default('text');

            $table->tinyInteger('is_default')->default(0)->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_sub_group_values');
    }
};
