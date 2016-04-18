<?php

class OccurencesettingsController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$occurences = Occurencesetting::all();

        
		Audit::logaudit('Occurencesettings', 'view', 'viewed occurence settings');


		return View::make('occurencesettings.index', compact('occurences'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('occurencesettings.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Occurencesetting::$rules, Occurencesetting::$messsages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$occurence = new Occurencesetting;

		$occurence->occurence_type = Input::get('type');

        $occurence->organization_id = '1';

		$occurence->save();

		Audit::logaudit('Occurencesettings', 'create', 'created: '.$occurence->occurence_type);


		return Redirect::route('occurencesettings.index')->withFlashMessage('Occurence type successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$occurence = Occurencesetting::findOrFail($id);

		return View::make('Occurencesettings.show', compact('occurence'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$occurence = Occurencesetting::find($id);

		return View::make('occurencesettings.edit', compact('occurence'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$occurence = Occurencesetting::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Occurencesetting::$rules, Occurencesetting::$messsages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$occurence->occurence_type = Input::get('type');
		$occurence->update();

		Audit::logaudit('Occurencesettings', 'update', 'updated: '.$occurence->occurence_type);

		return Redirect::route('occurencesettings.index')->withFlashMessage('Occurence type successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$occurence = Occurencesetting::findOrFail($id);
		Occurencesetting::destroy($id);

		Audit::logaudit('Occurencesettings', 'delete', 'deleted: '.$occurence->occurence_type);

		return Redirect::route('occurencesettings.index')->withDeleteMessage('Occurence type successfully deleted!');
	}

}
