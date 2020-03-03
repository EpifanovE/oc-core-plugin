<?php namespace EEV\Core\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEevCoreAddresses extends Migration
{
    public function up()
    {
        Schema::create('eev_core_addresses', function($table)
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
        Schema::dropIfExists('eev_core_addresses');
    }
}
