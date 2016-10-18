<?php

class ItemsController extends \BaseController {

	/**
	 * Display a listing of items
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Item::all();

		Audit::logaudit('Items', 'view', 'viewed items');

		return View::make('items.index', compact('items'));
	}

	/**
	 * Show the form for creating a new item
	 *
	 * @return Response
	 */
	public function create()
	{
		$itemcategories = Itemcategory::all();
		$locations = Location::all();

		return View::make('items.create', compact('itemcategories', 'locations'));
	}

	/**
	 * Store a newly created item in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Item::$rules, Item::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item = new Item;

		$item->name = Input::get('name');
		$item->description = Input::get('description');
		$item->purchase_price= Input::get('pprice');
		$item->selling_price = Input::get('sprice');
		$item->category = Input::get('category');
		$item->sku= Input::get('sku');
		$item->tag_id = Input::get('tag');
		$item->reorder_level = Input::get('reorder');
		$item->duration = Input::get('duration');
		$item->location_id = Input::get('location_id');
		$item->save();

		Audit::logaudit('Items', 'create', 'created: '.$item->name);

		return Redirect::route('items.index')->withFlashMessage('Item successfully created!');
	}

	/**
	 * Display the specified item.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = Item::findOrFail($id);

		return View::make('items.show', compact('item'));
	}

	/**
	 * Show the form for editing the specified item.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = Item::find($id);

		$itemcategories = Itemcategory::all();
		$locations = Location::all();

		return View::make('items.edit', compact('item', 'itemcategories', 'locations'));
	}

	/**
	 * Update the specified item in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$item = Item::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Item::$rules, Item::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item->name = Input::get('name');
		$item->description = Input::get('description');
		$item->purchase_price= Input::get('pprice');
		$item->selling_price = Input::get('sprice');
		$item->category = Input::get('category');
		$item->sku= Input::get('sku');
		$item->tag_id = Input::get('tag');
		$item->reorder_level = Input::get('reorder');
		$item->duration = Input::get('duration');
		$item->location_id = Input::get('location_id');
		$item->update();

        Audit::logaudit('Items', 'update', 'updated: '.$item->name);

		return Redirect::route('items.index')->withFlashMessage('Item successfully updated!');
	}

	/**
	 * Remove the specified item from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = Item::findOrFail($id);
		Item::destroy($id);

		Audit::logaudit('Items', 'delete', 'deleted: '.$item->name);

		return Redirect::route('items.index')->withDeleteMessage('Item successfully deleted!');
	}

}
