<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id');
            $table->integer('level');
            $table->integer('order');
            $table->string('name');
            $table->string('banner')->nullable();
            $table->string('icon')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('bg_menu')->nullable();
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
