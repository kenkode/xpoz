<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactDeductionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transact_deductions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->default('0')->index('transact_deductions_employee_id_foreign');
			$table->integer('employee_deduction_id')->unsigned()->default('0')->index('transact_employee_deductions_deduction_id_foreign');
			$table->string('deduction_name');
			$table->string('deduction_amount')->default('0.00');
			$table->string('financial_month_year');
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
		Schema::drop('transact_deductions');
	}

}