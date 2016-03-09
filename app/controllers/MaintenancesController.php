<?php

class MaintenancesController extends \BaseController {

	/**
	 * Display a listing of maintenances
	 *
	 * @return Response
	 */
	public function index()
	{
		$maintenances = Maintenance::all();

		return View::make('maintenances.index', compact('maintenances'));
	}

	/**
	 * Show the form for creating a new maintenance
	 *
	 * @return Response
	 */
	public function create()
	{
		$items = Item::all();
		$tests = Test::all();
		return View::make('maintenances.create', compact('items', 'tests'));
	}

	/**
	 * Store a newly created maintenance in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Maintenance::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item = Item::find(Input::get('item_id'));
		$test = Input::get('test_id');

		$maintenance = new Maintenance;

		$maintenance->item()->associate($item);
		$maintenance->test_id = Input::get('test_id');
		$maintenance->outcome = Input::get('outcome');
		$maintenance->remarks = Input::get('remarks');
		$maintenance->tested_by = Confide::user()->username;
		$maintenance->date_tested = date('Y-m-d');
		$maintenance->save();


		return Redirect::route('maintenances.index');
	}

	/**
	 * Display the specified maintenance.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$maintenance = Maintenance::findOrFail($id);

		return View::make('maintenances.show', compact('maintenance'));
	}

	/**
	 * Show the form for editing the specified maintenance.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$maintenance = Maintenance::find($id);

		$items = Item::all();
		$tests = Test::all();
		return View::make('maintenances.edit', compact('maintenance','items', 'tests'));
	}

	/**
	 * Update the specified maintenance in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$maintenance = Maintenance::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Maintenance::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item = Item::find(Input::get('item_id'));
		$test = Input::get('test_id');

		

		$maintenance->item()->associate($item);
		$maintenance->test_id = Input::get('test_id');
		$maintenance->outcome = Input::get('outcome');
		$maintenance->remarks = Input::get('remarks');
		$maintenance->tested_by = Confide::user()->username;
		$maintenance->update();

		return Redirect::route('maintenances.index');
	}

	/**
	 * Remove the specified maintenance from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Maintenance::destroy($id);

		return Redirect::route('maintenances.index');
	}

}
