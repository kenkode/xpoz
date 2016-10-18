<?php

class NssfRates extends \Eloquent {

	public $table = "social_security";

public static $rules = [
		'tier' => 'required',
		'i_from' => 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/',
		'i_to' => 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/',
		'employee_amount' => 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/',
		'employer_amount' => 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/',
	];

public static $messages = array(
        'tier.required'=>'Please insert tier type!',
        'i_from.required'=>'Please insert income from amount!',
        'i_from.regex'=>'Please insert a valid income from amount!',
        'i_to.required'=>'Please insert income to amount!',
        'i_to.regex'=>'Please insert a valid income to amount!',
        'employee_amount.required'=>'Please insert employee amount!',
        'employee_amount.regex'=>'Please insert a valid employee amount!',
        'employer_amount.required'=>'Please insert employer amount!',
        'employer_amount.regex'=>'Please insert a valid employer amount!',
    );

	// Don't forget to fill this array
	protected $fillable = [];

}