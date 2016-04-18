<?php

class BookingitemsController extends \BaseController {

	/**
	 * Display a listing of bookingitems
	 *
	 * @return Response
	 */
	public function index()
	{
		$bookingitems = Bookingitem::all();

		return View::make('bookingitems.index', compact('bookingitems'));
	}

	/**
	 * Show the form for creating a new bookingitem
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('bookingitems.create');
	}

	/**
	 * Store a newly created bookingitem in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Bookingitem::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Bookingitem::create($data);

		return Redirect::route('bookingitems.index');
	}

	/**
	 * Display the specified bookingitem.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$bookingitem = Bookingitem::findOrFail($id);

		return View::make('bookingitems.show', compact('bookingitem'));
	}

	/**
	 * Show the form for editing the specified bookingitem.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$bookingitem = Bookingitem::find($id);

		return View::make('bookingitems.edit', compact('bookingitem'));
	}

	/**
	 * Update the specified bookingitem in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$bookingitem = Bookingitem::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Bookingitem::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$bookingitem->update($data);

		return Redirect::route('bookingitems.index');
	}

	/**
	 * Remove the specified bookingitem from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Bookingitem::destroy($id);

		return Redirect::route('bookingitems.index');
	}

}
