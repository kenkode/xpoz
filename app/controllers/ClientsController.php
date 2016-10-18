<?php

class ClientsController extends \BaseController {

	/**
	 * Display a listing of clients
	 *
	 * @return Response
	 */
	public function index()
	{
		$clients = Client::all();

		Audit::logaudit('Clients', 'client', 'viewed clients');

		return View::make('clients.index', compact('clients'));
	}

	/**
	 * Show the form for creating a new client
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('clients.create');
	}

	/**
	 * Store a newly created client in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Client::$rules, Client::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$client = new Client;

		$client->name = Input::get('name');
		$client->contact_person = Input::get('cname');
		$client->email = Input::get('email_office');
		$client->contact_person_email = Input::get('email_personal');
		$client->contact_person_phone = Input::get('mobile_phone');
		$client->phone = Input::get('office_phone');
		$client->address = Input::get('address');
		$client->type = Input::get('type');
		$client->save();

        Audit::logaudit('Clients', 'create', 'created: '.$client->name);

		return Redirect::route('clients.index')->withFlashMessage('Client successfully created!');
	}

	/**
	 * Display the specified client.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client = Client::findOrFail($id);

		return View::make('clients.show', compact('client'));
	}

	/**
	 * Show the form for editing the specified client.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = Client::find($id);

		return View::make('clients.edit', compact('client'));
	}

	/**
	 * Update the specified client in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$client = Client::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Client::rolesUpdate($client->id), Client::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$client->name = Input::get('name');
		$client->contact_person = Input::get('cname');
		$client->email = Input::get('email_office');
		$client->contact_person_email = Input::get('email_personal');
		$client->contact_person_phone = Input::get('mobile_phone');
		$client->phone = Input::get('office_phone');
		$client->address = Input::get('address');
		$client->type = Input::get('type');

		$client->update();

		Audit::logaudit('Clients', 'update', 'updated: '.$client->name);

		return Redirect::route('clients.index')->withFlashMessage('Client successfully updated!');
	}

	/**
	 * Remove the specified client from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$client = Client::findOrFail($id);
		Client::destroy($id);
        Audit::logaudit('Clients', 'delete', 'deleted: '.$client->name);
		return Redirect::route('clients.index')->withDeleteMessage('Client successfully deleted!');
	}

}
