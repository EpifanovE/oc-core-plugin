<?php namespace DigitFab\Core\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDigitFabCoreWorkingPeriods extends Migration
{
    public function up()
    {
        Schema::create('digitfab_core_working_periods', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('day', 16);
            $table->time('time_from')->nullable()->unsigned(false)->default(null);
            $table->time('time_till')->nullable()->unsigned(false)->default(null);
            $table->boolean('around_the_clock')->nullable()->default(false);
            $table->integer('sort_order')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('digitfab_core_working_periods');
    }
}
