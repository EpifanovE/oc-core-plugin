<?php namespace DigitFab\Leads\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDigitFabCoreWidgets extends Migration
{
    public function up()
    {
        Schema::create('digitfab_core_widgets', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 1024)->nullable();
            $table->string('type', 64);
            $table->string('area', 128);
            $table->smallInteger('order')->default(0);
            $table->string('classes', 1024)->nullable();
            $table->json('data')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('digitfab_core_widgets');
    }
}
