<?php

class Booking extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function client(){

		return $this->belongsTo('Client');
	}

	public function items(){

		return $this->hasMany('Bookingitem');
	}


	public static function add($data){

		$client = Client::find(array_get($data, 'client_id'));

		$booking = new Booking;

		$booking->client()->associate($client);
		$booking->event = array_get($data, 'event');
		$booking->save();
	}


	public static function getItems($id){

		//$items = array();
		$items = DB::table('bookingitems')->where('booking_id', '=', $id)->get();

		return $items;
	}

}