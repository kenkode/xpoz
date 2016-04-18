<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccurencesettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('occurencesettings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('occurence_type');
			$table->integer('organization_id')->unsigned()->default('0')->index('occurencesettings_organization_id_foreign');
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
		Schema::drop('occurencesettings');
	}

}
