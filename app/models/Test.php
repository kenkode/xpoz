<?php

class Test extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function maintenances(){

		return $this->belongsToMany('Maintenance');
	}


	public static function getName($id){

		$test = Test::find($id);

		return $test->name;

	}

}