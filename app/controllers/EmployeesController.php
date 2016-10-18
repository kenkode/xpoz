<?php

class EmployeesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$employees = Employee::getActiveEmployee();

		 Audit::logaudit('Employees', 'view', 'viewed employee list');

		return View::make('employees.index', compact('employees'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$branches = Branch::all();
		$employees = Employee::all();
		$departments = Department::all();
		$jgroups = Jobgroup::all();
		$etypes = EType::all();
		$banks = Bank::all();
		$bbranches = BBranch::all();
		$educations = Education::all();
		return View::make('employees.create', compact('employees','branches','departments','etypes','jgroups','banks','bbranches','educations'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	$validator = Validator::make($data = Input::all(), Employee::$rules,Employee::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		
        
        try
        {
        $employee = new Employee;

       if ( Input::hasFile('image')) {

            $file = Input::file('image');
            $name = time().'-'.$file->getClientOriginalName();
            $file = $file->move('public/uploads/employees/photo', $name);
            $input['file'] = '/public/uploads/employees/photo'.$name;
            $employee->photo = $name;
        }else{
        	$employee->photo = 'default_photo.png';
        }

        if ( Input::hasFile('signature')) {

            $file = Input::file('signature');
            $name = time().'-'.$file->getClientOriginalName();
            $file = $file->move('public/uploads/employees/signature/', $name);
            $input['file'] = '/public/uploads/employees/signature/'.$name;
            $employee->signature = $name;
        }else{
        	$employee->signature = 'sign_av.jpg';
        }

		$employee->personal_file_number = Input::get('personal_file_number');
		$employee->first_name = Input::get('fname');
		$employee->last_name = Input::get('lname');
		$employee->middle_name = Input::get('mname');
		$employee->identity_number = Input::get('identity_number');
		if(Input::get('passport_number') != null){
		$employee->passport_number = Input::get('passport_number');
	    }else{
        $employee->passport_number = null;
	    }
	    if(Input::get('pin') != null){
		$employee->pin = Input::get('pin');
		}else{
        $employee->pin = null;
	    }
	    if(Input::get('social_security_number') != null){
		$employee->social_security_number = Input::get('social_security_number');
	    }else{
        $employee->social_security_number = null;
	    }
	    if(Input::get('hospital_insurance_number') != null){
		$employee->hospital_insurance_number = Input::get('hospital_insurance_number');
	    }else{
        $employee->hospital_insurance_number = null;
	    }
	    if(Input::get('work_permit_number') != null){
		$employee->work_permit_number = Input::get('work_permit_number');
	    }else{
        $employee->work_permit_number = null;
	    }
        $employee->job_title = Input::get('jtitle');
        $employee->education_type_id = Input::get('education');
        $a = str_replace( ',', '', Input::get('pay') );
        $employee->basic_pay = $a;
        $employee->gender = Input::get('gender');
        $employee->marital_status = Input::get('status');
        $employee->yob = Input::get('dob');
        $employee->citizenship = Input::get('citizenship');
        $employee->mode_of_payment = Input::get('modep');
        if(Input::get('bank_account_number') != null ){
        $employee->bank_account_number = Input::get('bank_account_number');
        }else{
        $employee->bank_account_number = null;
	    }
	    if(Input::get('bank_eft_code') != null ){
        $employee->bank_eft_code = Input::get('bank_eft_code');
        }else{
        $employee->bank_eft_code = null;
        }if(Input::get('swift_code') != null ){
        $employee->swift_code = Input::get('swift_code');
        }else{
        $employee->swift_code = null;
        }
        if(Input::get('email_office') != null ){
        $employee->email_office = Input::get('email_office');
        }else{
        $employee->email_office = null;
        }
        if(Input::get('email_personal') != null ){
        $employee->email_personal = Input::get('email_personal');
        }else{
        $employee->email_personal = null;
        }
        if(Input::get('telephone_mobile') != null ){
        $employee->telephone_mobile = Input::get('telephone_mobile');
        }else{
        $employee->telephone_mobile = null;
        }
        $employee->postal_address = Input::get('address');
        $employee->postal_zip = Input::get('zip');
        $employee->date_joined = Input::get('djoined');
	    $employee->bank_id = Input::get('bank_id');
	    $employee->bank_branch_id = Input::get('bbranch_id');
	    $employee->branch_id = Input::get('branch_id');
	    $employee->department_id = Input::get('department_id');
	    $employee->job_group_id = Input::get('jgroup_id');
		$employee->type_id = Input::get('type_id');

        $employee->kin_name = Input::get('kin_name');
        $employee->kin_email = Input::get('kin_email');
        $employee->kin_phone = Input::get('kin_phone');
	    $employee->kin_idno = Input::get('kin_idno');
	    $employee->kin_relationship = Input::get('relationship');

		if(Input::get('i_tax') != null ){
		$employee->income_tax_applicable = '1';
	    }else{
	    $employee->income_tax_applicable = '0';
	    }
	    if(Input::get('i_tax_relief') != null ){
	    $employee->income_tax_relief_applicable = '1';
	    }else{
	    $employee->income_tax_relief_applicable = '0';
	    }
	    if(Input::get('a_nhif') != null ){
	    $employee->hospital_insurance_applicable = '1';
	    }else{
	    $employee->hospital_insurance_applicable = '0';
	    }
	    if(Input::get('a_nssf') != null ){
		$employee->social_security_applicable = '1';
	    }else{
	    $employee->social_security_applicable = '0';
	    }
		$employee->organization_id = '1';


		$employee->save();

        if(Input::get('supervisor') != null || Input::get('supervisor') != ""){

		$supervisor = new Supervisor;

		$supervisor->supervisor_id = Input::get('supervisor');

		$supervisor->employee_id = $employee->id;
        
        $supervisor->save();
        }

		 Audit::logaudit('Employee', 'create', 'created: '.$employee->personal_file_number.'-'.$employee->first_name.' '.$employee->last_name);

		return Redirect::route('employees.index')->withFlashMessage('Employee successfully created!');
		 }
    catch (FormValidationException $e)
    {
        return Redirect::back()->withInput()->withErrors($e->getErrors());
    }
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$employee = Employee::findOrFail($id);

		return View::make('employees.show', compact('employee'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$employee = Employee::find($id);
		$branches = Branch::all();
		$departments = Department::all();
		$jgroups = Jobgroup::all();
		$etypes = EType::all();
		$banks = Bank::all();
		$bbranches = BBranch::all();
		$educations = Education::all();
		$supervisor = Supervisor::where('employee_id',$id)->first();
		$count = Supervisor::where('employee_id',$id)->count();
		$subordinates = Employee::all();
		return View::make('employees.edit', compact('count','supervisor','subordinates','branches','educations','departments','etypes','jgroups','banks','bbranches','employee'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$employee = Employee::findOrFail($id);

		//$validator = Employee::validateUpdate(Input::all(), $id);

		$validator = Validator::make(Input::all(), Employee::rolesUpdate($employee->id),Employee::$messages);

		//$validator = Validator::make($data = Input::all(), Employee::$rules,Employee::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        if ( Input::hasFile('image')) {

            $file = Input::file('image');
            $name = time().'-'.$file->getClientOriginalName();
            $file = $file->move('public/uploads/employees/photo', $name);
            $input['file'] = '/public/uploads/employees/photo'.$name;
            $employee->photo = $name;
        }else{
        	$employee->photo = Input::get('photo');
        }

        if ( Input::hasFile('signature')) {

            $file = Input::file('signature');
            $name = time().'-'.$file->getClientOriginalName();
            $file = $file->move('public/uploads/employees/signature/', $name);
            $input['file'] = '/public/uploads/employees/signature/'.$name;
            $employee->signature = $name;
        }else{
        	$employee->signature = Input::get('sign');
        }

		$employee->personal_file_number = Input::get('personal_file_number');
		$employee->first_name = Input::get('fname');
		$employee->last_name = Input::get('lname');
		$employee->middle_name = Input::get('mname');
		$employee->identity_number = Input::get('identity_number');
		if(Input::get('passport_number') != null){
		$employee->passport_number = Input::get('passport_number');
	    }else{
        $employee->passport_number = null;
	    }
	    if(Input::get('pin') != null){
		$employee->pin = Input::get('pin');
		}else{
        $employee->pin = null;
	    }
	    if(Input::get('social_security_number') != null){
		$employee->social_security_number = Input::get('social_security_number');
	    }else{
        $employee->social_security_number = null;
	    }
	    if(Input::get('hospital_insurance_number') != null){
		$employee->hospital_insurance_number = Input::get('hospital_insurance_number');
	    }else{
        $employee->hospital_insurance_number = null;
	    }
	    if(Input::get('work_permit_number') != null){
		$employee->work_permit_number = Input::get('work_permit_number');
	    }else{
        $employee->work_permit_number = null;
	    }
        $employee->job_title = Input::get('jtitle');
        $a = str_replace( ',', '', Input::get('pay') );
        $employee->basic_pay = $a;
        $employee->education_type_id = Input::get('education');
        $employee->gender = Input::get('gender');
        $employee->marital_status = Input::get('status');
        $employee->yob = Input::get('dob');
        $employee->citizenship = Input::get('citizenship');
        $employee->mode_of_payment = Input::get('modep');

        $employee->kin_name = Input::get('kin_name');
        $employee->kin_email = Input::get('kin_email');
        $employee->kin_phone = Input::get('kin_phone');
	    $employee->kin_idno = Input::get('kin_idno');
	    $employee->kin_relationship = Input::get('relationship');

        if(Input::get('bank_account_number') != null ){
        $employee->bank_account_number = Input::get('bank_account_number');
        }else{
        $employee->bank_account_number = null;
	    }
	    if(Input::get('bank_eft_code') != null ){
        $employee->bank_eft_code = Input::get('bank_eft_code');
        }else{
        $employee->bank_eft_code = null;
        }if(Input::get('swift_code') != null ){
        $employee->swift_code = Input::get('swift_code');
        }else{
        $employee->swift_code = null;
        }
        if(Input::get('email_office') != null ){
        $employee->email_office = Input::get('email_office');
        }else{
        $employee->email_office = null;
        }
        if(Input::get('email_personal') != null ){
        $employee->email_personal = Input::get('email_personal');
        }else{
        $employee->email_personal = null;
        }
        if(Input::get('telephone_mobile') != null ){
        $employee->telephone_mobile = Input::get('telephone_mobile');
        }else{
        $employee->telephone_mobile = null;
        }
        $employee->postal_address = Input::get('address');
        $employee->postal_zip = Input::get('zip');
        $employee->date_joined = Input::get('djoined');
	    $employee->bank_id = Input::get('bank_id');
	    $employee->bank_branch_id = Input::get('bbranch_id');
	    $employee->branch_id = Input::get('branch_id');
	    $employee->department_id = Input::get('department_id');
	    $employee->job_group_id = Input::get('jgroup_id');
		$employee->type_id = Input::get('type_id');
		if(Input::get('i_tax') != null ){
		$employee->income_tax_applicable = '1';
	    }else{
	    $employee->income_tax_applicable = '0';
	    }
	    if(Input::get('i_tax_relief') != null ){
	    $employee->income_tax_relief_applicable = '1';
	    }else{
	    $employee->income_tax_relief_applicable = '0';
	    }
	    if(Input::get('a_nhif') != null ){
	    $employee->hospital_insurance_applicable = '1';
	    }else{
	    $employee->hospital_insurance_applicable = '0';
	    }
	    if(Input::get('a_nssf') != null ){
		$employee->social_security_applicable = '1';
	    }else{
	    $employee->social_security_applicable = '0';
	    }
	    if(Input::get('active') != null ){
		$employee->in_employment = 'Y';
	    }else{
	    $employee->in_employment = 'N';
	    }

		$employee->update();

		$c = Supervisor::where('employee_id', $employee->id)->count();


		if($c>0){

		$supervisor = Supervisor::where('employee_id',$employee->id)->first();

		$supervisor->supervisor_id = Input::get('supervisor');

		$supervisor->employee_id = $employee->id;
        
        $supervisor->update();
        }


		else if(Input::get('supervisor') != null || Input::get('supervisor') != ""){

		$supervisor = new Supervisor;

		$supervisor->supervisor_id = Input::get('supervisor');

		$supervisor->employee_id = $employee->id;
        
        $supervisor->save();
        }

		 Audit::logaudit('Employee', 'update', 'updated: '.$employee->personal_file_number.'-'.$employee->first_name.' '.$employee->last_name);

		 if(Confide::user()->user_type == 'member'){
		 	return Redirect::to('dashboard');
		 } else {
		 	return Redirect::route('employees.index')->withFlashMessage('Employee successfully updated!');
		 }
		
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$employee = Employee::findOrFail($id);
		
		Employee::destroy($id);

		 Audit::logaudit('Employee', 'delete', 'deleted: '.$employee->personal_file_number.'-'.$employee->first_name.' '.$employee->last_name);


		return Redirect::route('employees.index')->withDeleteMessage('Employee successfully deleted!');
	}

	public function deactivate($id)
	{

		$employee = Employee::findOrFail($id);
		
		DB::table('employee')->where('id',$id)->update(array('in_employment'=>'N'));

		Audit::logaudit('Employee', 'deactivate', 'deactivated: '.$employee->personal_file_number.'-'.$employee->first_name.' '.$employee->last_name);


		return Redirect::route('employees.index')->withDeleteMessage('Employee successfully deactivated!');
	}

	public function activate($id)
	{

		$employee = Employee::findOrFail($id);

		$employee->date_joined=date("Y-m-d");

		$employee->in_employment="Y";

		$employee->update();

		Audit::logaudit('Employee', 'activate', 'activated: '.$employee->personal_file_number.'-'.$employee->first_name.' '.$employee->last_name);


		return Redirect::to('deactives')->withFlashMessage($employee->personal_file_number.'-'.$employee->first_name.' '.$employee->last_name.' successfully activated!');
	}

	public function view($id){

		$employee = Employee::find($id);

		$appraisals = Appraisal::where('employee_id', $id)->get();

		$c = Supervisor::where('employee_id', $id)->count();

        $contacts = Emergencycontact::where('employee_id', $id)->get();

        $occurences = Occurence::where('employee_id', $id)->get();

        $properties = Property::where('employee_id', $id)->get();

        $documents = Document::where('employee_id', $id)->get();

        $benefits = Employeebenefit::where('jobgroup_id', $employee->job_group_id)->get();

        $count = Employeebenefit::where('jobgroup_id', $employee->job_group_id)->count();

		$organization = Organization::find(1);

		return View::make('employees.view', compact('c','employee','appraisals','contacts','documents','occurences','properties','benefits','count'));
		
	}

	public function viewdeactive($id){

		$employee = Employee::find($id);

		$appraisals = Appraisal::where('employee_id', $id)->get();

		$c = Supervisor::where('employee_id', $id)->count();

        $kins = Nextofkin::where('employee_id', $id)->get();

        $occurences = Occurence::where('employee_id', $id)->get();

        $properties = Property::where('employee_id', $id)->get();

        $documents = Document::where('employee_id', $id)->get();

        $benefits = Employeebenefit::where('jobgroup_id', $employee->job_group_id)->get();

        $count = Employeebenefit::where('jobgroup_id', $employee->job_group_id)->count();
     
		$organization = Organization::find(1);

		return View::make('employees.viewdeactive', compact('c','employee','appraisals','kins','documents','occurences','properties','benefits','count'));
		
	}

}
