<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('subtitle',100);
            $table->string('slug',100);
            $table->text('body');
            $table->boolean('status')->nullable(true);
            $table->integer('posted_by')->nullable(true);
            $table->string('img')->nullable(true);
	        $table->boolean('like')->nullable(true);
	        $table->boolean('dislike')->nullable(true);
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
}
