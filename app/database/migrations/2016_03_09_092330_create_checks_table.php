<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('item_id')->unsigned();
			$table->foreign('item_id')->references('id')->on('items');
			$table->date('date_out');
			$table->date('date_expected_back')->nullable();
			$table->date('date_in')->nullable();
			$table->string('checked_out_by')->nullable();
			$table->string('checked_in_by')->nullable();
			$table->string('remarks_out')->nullable();
			$table->string('remarks_in')->nullable();
			$table->string('condition_back')->nullable();
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
		Schema::drop('checks');
	}

}
