<?php

class BookingsController extends \BaseController {

	/**
	 * Display a listing of bookings
	 *
	 * @return Response
	 */
	public function index()
	{
		$bookings = Booking::all();

		return View::make('bookings.index', compact('bookings'));
	}

	/**
	 * Show the form for creating a new booking
	 *
	 * @return Response
	 */
	public function create()
	{
		$clients = Client::all();
		$employees = Employee::all();
		return View::make('bookings.create', compact('clients', 'employees'));
	}

	/**
	 * Store a newly created booking in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Booking::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Booking::create($data);

		return Redirect::route('bookings.index');
	}

	/**
	 * Display the specified booking.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$booking = Booking::findOrFail($id);

		return View::make('bookings.show', compact('booking'));
	}

	/**
	 * Show the form for editing the specified booking.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$booking = Booking::find($id);

		return View::make('bookings.edit', compact('booking'));
	}

	/**
	 * Update the specified booking in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$booking = Booking::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Booking::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$booking->update($data);

		return Redirect::route('bookings.index');
	}

	/**
	 * Remove the specified booking from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$bk = Booking::find($id);
		$bk->is_cancelled = true;
		$bk->update();


		return Redirect::route('bookings.index');
	}


	public function add(){

		$data = Input::all();
		Session::put( 'booking', array(
    					
    					'client_id' => array_get($data, 'client_id'), 
    					'start_date' => array_get($data, 'start_date'),
    					'end_date' => array_get($data, 'end_date'),
    					'event' => array_get($data, 'event'),
    					'venue' => array_get($data, 'venue'),
    					'lead' => array_get($data, 'lead')
    					)
   					);

		

  		Session::put('bookingitems', []);

  		$bookingitems =Session::get('bookingitems');
  		$booking =Session::get('booking');
  		$items = Item::all();

  		return View::make('bookings.bookingitems', compact('bookingitems', 'booking', 'items'));
	}


	public function additems(){

		$data = Input::all();

		Session::push('bookingitems', array(

					'item' => array_get($data, 'item')

				)
			);
		$bookingitems =Session::get('bookingitems');
  		$booking =Session::get('booking');
  		$items = Item::all();

  		return View::make('bookings.bookingitems', compact('bookingitems', 'booking', 'items'));

	}


	public function commit(){

		$bookingitems =Session::get('bookingitems');
  		$booking =Session::get('booking');

  		echo '<pre>';
  		print_r($booking);

  		/*$client = Client::findOrFail($booking['client_id']);

  		
  		$booking = new Booking;
  		$booking->client()->associate($client);
  		$booking->event = $booking['event'];
  		$booking->start_date = $booking['start_date'];
  		$booking->end_date = $booking['end_date'];
  		$booking->venue = $booking['venue'];
  		$booking->lead = $booking['lead'];
  		$booking->save();

  		foreach($bookingitems as $bookingitem){
  			
  				$item = Item::findOrFail($bookingitem['item']);
  				$bookingitem = new Bookingitem;
  				$bookingitem->item()->associate($item);
  				$bookingitem->booking()->associate($booking);
  				$bookingitem->save();
  		}

*/

	}

}
