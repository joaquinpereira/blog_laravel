<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->nullable();
            $table->text('excerpt')->nullable();
            $table->mediumText('body')->nullable();
            $table->mediumText('iframe')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->references('id')->on('categories');
            $table->foreignId('user_id')->constrained()->references('id')->on('users');
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
        Schema::dropIfExists('posts');
    }
}
