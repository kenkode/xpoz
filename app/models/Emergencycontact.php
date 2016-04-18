<?php

class Emergencycontact extends \Eloquent {

	// Add your validation rules here



	public static $rules = [
		'employee_id' => 'required',
		'name' => 'required',
		'id_number' => 'unique:emergencycontacts',
		'phone1' => 'unique:emergencycontacts',
		'phone2' => 'unique:emergencycontacts',
		'office_phone' => 'unique:emergencycontacts',
		'cellular_phone' => 'unique:emergencycontacts',
		'home_phone' => 'unique:emergencycontacts'
	];

	public static function rolesUpdate($id)
    {
        return array(
        'employee_id' => 'required',
		'name' => 'required',
		'id_number' => 'unique:emergencycontacts,id_number,' . $id,
		'phone1' => 'unique:emergencycontacts,phone1,' . $id,
		'phone2' => 'unique:emergencycontacts,phone2,' . $id,
		'office_phone' => 'unique:emergencycontacts,office_phone,' . $id,
		'cellular_phone' => 'unique:emergencycontacts,cellular_phone,' . $id,
		'home_phone' => 'unique:emergencycontacts,home_phone,'. $id,
        );
    }

	public static $messages = array(
		'employee_id.required'=>'Please select employee!',
        'name.required'=>'Please insert contact`s name!',
        'identity_number.unique'=>'That identity number already exists!',
        'phone1.unique'=>'That telephone number already exists!',
        'phone2.unique'=>'That phone number already exists!',
        'office_phone.unique'=>'That office telephone number already exists!',
        'cellular_phone.unique'=>'That cellular number already exists!',
        'home_phone.unique'=>'That home telephone number already exists!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function employee(){

		return $this->belongsTo('Employee');
	}

}