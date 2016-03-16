<?php

class ChecksController extends \BaseController {

	/**
	 * Display a listing of checks
	 *
	 * @return Response
	 */
	public function index()
	{
		$checks = Check::all();

		return View::make('checks.index', compact('checks'));
	}

	/**
	 * Show the form for creating a new check
	 *
	 * @return Response
	 */
	public function create()
	{
		$items = Item::all();
		return View::make('checks.create', compact('items'));
	}

	/**
	 * Store a newly created check in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Check::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item = Item::findOrFail(Input::get('item_id'));
		$check = new Check;

		$check->item()->associate($item);
		$check->date_out = Input::get('date_out');
		$check->date_expected_back = Input::get('expected_date_back');
		$check->remarks_out = Input::get('remarks_out');
		$check->checked_out_by = Confide::user()->username;
		$check->save();

		return Redirect::route('checks.index');
	}

	/**
	 * Display the specified check.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$check = Check::findOrFail($id);

		return View::make('checks.show', compact('check'));
	}

	/**
	 * Show the form for editing the specified check.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$check = Check::find($id);
		$items = Item::all();
		return View::make('checks.edit', compact('check', 'items'));
	}

	/**
	 * Update the specified check in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$check = Check::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Check::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item = Item::findOrFail(Input::get('item_id'));
		

		$check->item()->associate($item);
		$check->date_out = Input::get('date_out');
		$check->date_expected_back = Input::get('expected_date_back');
		$check->remarks_out = Input::get('remarks_out');
		$check->checked_out_by = Confide::user()->username;
		$check->update();

		return Redirect::route('checks.index');
	}

	/**
	 * Remove the specified check from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Check::destroy($id);

		return Redirect::route('checks.index');
	}


	public function checkin($id)
	{
		$check = Check::find($id);
		
		return View::make('checks.checkin', compact('check'));
	}


	public function docheckin($id)
	{
		$check = Check::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Check::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$check->date_in = Input::get('date_in');
		$check->condition_back = Input::get('condition_back');
		$check->remarks_in = Input::get('remarks_in');
		$check->checked_in_by = Confide::user()->username;
		$check->update();

		return Redirect::route('checks.index');
	}


}
