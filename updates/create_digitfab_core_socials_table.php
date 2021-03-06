<?php namespace DigitFab\Core\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDigitFabCoreSocials extends Migration
{
    public function up()
    {
        Schema::create('digitfab_core_socials', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 1024)->nullable();
            $table->string('type', 1024)->nullable();
            $table->string('link', 1024)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('icon_class', 1024)->nullable();
            $table->integer('sort_order')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('digitfab_core_socials');
    }
}
