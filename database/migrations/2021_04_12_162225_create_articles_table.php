<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title', 255);
            $table->string('slug')->unique();
            $table->integer('category_id')->default(0)->comment('0: unknown');
            $table->string('excerpt')->nullable()->comment('short description');
            $table->text('content');
            $table->string('image')->nullable();
            $table->integer('series_id')->nullable()->default(0);
            $table->integer('series_order')->nullable()->default(0);
            $table->tinyInteger('status')->default(1)->comment('1:publish, 2:draft, 3:deleted, 4:pending');
            $table->tinyInteger('type')->default(1)->comment('1:article, 2:learn, 3:tips');
            $table->json('link_references')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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