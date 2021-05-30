<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_series', function (Blueprint $table) {
            $table->id();
            $table->integer('article_id');
            $table->integer('series_id');
            $table->integer('order')->default(0)->comment('thu tu trong series, mac dinh la 0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_series');
    }
}
