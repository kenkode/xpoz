<?php

class Maintenance extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function item(){

		return $this->belongsTo('Item');
	}


	public function tests(){

		return $this->belongsToMany('Test');
	}

}