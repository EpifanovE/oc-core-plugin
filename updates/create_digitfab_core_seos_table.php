<?php namespace DigitFab\Core\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class TableCreateDigitFabCoreSeos extends Migration
{
    public function up()
    {
        Schema::create('digitfab_core_seos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 1024)->nullable();
            $table->string('description', 2048)->nullable();
            $table->string('keywords', 1024)->nullable();
            $table->boolean('indexing')->default(true);
            $table->integer('has_seo_id')->nullable();
            $table->string('has_seo_type')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('digitfab_core_seos');
    }
}
