<?php namespace DigitFab\Core\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDigitFabCoreAddresses extends Migration
{
    public function up()
    {
        Schema::create('digitfab_core_addresses', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 1024)->nullable();
            $table->string('country', 1024)->nullable();
            $table->string('locality', 1024)->nullable();
            $table->string('region', 1024)->nullable();
            $table->string('postal_code', 1024)->nullable();
            $table->string('street_address', 1024)->nullable();
            $table->string('latitude', 128)->nullable();
            $table->string('longitude', 128)->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('digitfab_core_addresses');
    }
}
