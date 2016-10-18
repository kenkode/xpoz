<?php

class AssetsController extends \BaseController {

	/**
	 * Display a listing of assets
	 *
	 * @return Response
	 */
	public function index()
	{
		$assets = Asset::all();

		return View::make('assets.index', compact('assets'));
	}

	/**
	 * Show the form for creating a new asset
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('assets.create');
	}

	/**
	 * Store a newly created asset in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Asset::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$asset = new Asset;
		$asset->name = array_get($data, 'name');
		$asset->purchase_date = array_get($data, 'purchase_date');
		$asset->quantity = array_get($data, 'quantity');
		$asset->cost = array_get($data, 'cost');
		$asset->asset_type = array_get($data, 'type');
		$asset->supplier = array_get($data, 'supplier');
		$asset->receipt_number = array_get($data, 'receipt_number');
		$asset->serial_number = array_get($data, 'serial_numberer');
		$asset->life_years = array_get($data, 'life_years');
		$asset->dep_policy = array_get($data, 'dep_policy');
		$asset->accumulated_dep_amount = array_get($data, 'accumulated_dep_amount');
		$asset->disposal_date = array_get($data, 'disposal_date');
		$asset->disposal_method = array_get($data, 'disposal_method');
		$asset->disposal_amount = array_get($data, 'disposal_amount');
		$asset->save();

		return Redirect::route('assets.index');
	}

	/**
	 * Display the specified asset.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$asset = Asset::findOrFail($id);

		return View::make('assets.show', compact('asset'));
	}

	/**
	 * Show the form for editing the specified asset.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$asset = Asset::find($id);

		return View::make('assets.edit', compact('asset'));
	}

	/**
	 * Update the specified asset in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$asset = Asset::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Asset::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		
		$asset->name = array_get($data, 'name');
		$asset->purchase_date = array_get($data, 'purchase_date');
		$asset->quantity = array_get($data, 'quantity');
		$asset->cost = array_get($data, 'cost');
		$asset->asset_type = array_get($data, 'type');
		$asset->supplier = array_get($data, 'supplier');
		$asset->receipt_number = array_get($data, 'receipt_number');
		$asset->serial_number = array_get($data, 'serial_numberer');
		$asset->life_years = array_get($data, 'life_years');
		$asset->dep_policy = array_get($data, 'dep_policy');
		$asset->accumulated_dep_amount = array_get($data, 'accumulated_dep_amount');
		$asset->disposal_date = array_get($data, 'disposal_date');
		$asset->disposal_method = array_get($data, 'disposal_method');
		$asset->disposal_amount = array_get($data, 'disposal_amount');
		$asset->update();


		return Redirect::route('assets.index');
	}

	/**
	 * Remove the specified asset from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Asset::destroy($id);

		return Redirect::route('assets.index');
	}



	public function dispose($id)
	{
		$asset = Asset::find($id);

		return View::make('assets.dispose', compact('asset'));
	}


	public function submitdispose($id)
	{
		$asset = Asset::find($id);

		$asset->disposal_date = Input::get('disposal_date');
		$asset->disposal_method = Input::get('disposal_methodis');
		$asset->disposal_amount = Input::get('disposal_amount');
		$asset->is_disposed = true;
		$asset->update();
		
		

		return Route::to('assets');
	}


}
