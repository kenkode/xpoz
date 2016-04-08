<?php

class Overtime extends \Eloquent {
/*
	use \Traits\Encryptable;


	protected $encryptable = [

		'allowance_name',
	];
	*/

public static $rules = [
        'employee' => 'required',
		'type' => 'required',
		'amount' => 'required'
	];

	public static $messsages = array(
        'employee.required'=>'Please select employee!',
        'type.required'=>'Please select overtime type!',
        'amount.required'=>'Please insert amount!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function employee(){

		return $this->belongsTo('Employee');
	}

}