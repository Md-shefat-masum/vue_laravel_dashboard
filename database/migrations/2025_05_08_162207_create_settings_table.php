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
        Schema::create('setting_groups', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150)->nullable();

            $table->tinyInteger('is_default')->default(0)->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);

            $table->timestamps();
        });

        Schema::create('setting_sub_groups', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('setting_group_id')->unsigned()->nullable();
            $table->string('setting_group_title', 150)->nullable();

            $table->string('title', 150)->nullable();

            $table->tinyInteger('is_multiple')->default(0)->nullable();
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
        Schema::dropIfExists('setting_groups');
        Schema::dropIfExists('setting_sub_groups');
    }
};
