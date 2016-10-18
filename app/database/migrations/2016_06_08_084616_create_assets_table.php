<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->date('purchase_date')->nullable();
			$table->int('quantity')->nullable();
			$table->double('cost', 15,2)->nullable();
			$table->string('asset_type')->nullable();
			$table->string('supplier')->nullable();
			$table->string('receipt_number')->nullable();
			$table->string('serial_number')->nullable();
			$table->integer('life_years')->nullable();
			$table->string('dep_policy')->nullable();
			$table->double('accumulated_dep_amount', 15,2)->nullable();
			$table->date('disposal_date')->nullable();
			$table->string('disposal_method')->nullable();
			$table->double('disposal_amount', 15,2)->nullable();
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
		Schema::drop('assets');
	}

}
