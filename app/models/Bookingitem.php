<?php

class Bookingitem extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function booking(){

		return $this->belongsTo('Booking');
	}

	public function item(){

		return $this->belongsTo('Item');
	}

}