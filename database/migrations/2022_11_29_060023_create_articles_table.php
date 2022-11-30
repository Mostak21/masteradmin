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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->string('category');
            $table->string('thumbnail')->nullable();
            $table->string('photos')->nullable();
            $table->string('slug');
            $table->string('keywords')->nullable();
            $table->string('video_link')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('published');
            $table->integer('featured');
            $table->integer('district')->nullable();
            $table->integer('subdistrict')->nullable();
            $table->integer('area')->nullable();
            $table->integer('status')->nullable();
            $table->integer('editor_id')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('articles');
    }
};
