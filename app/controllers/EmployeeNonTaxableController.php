<?php

class EmployeeNonTaxableController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$nontaxables = DB::table('employee')
		          ->join('employeenontaxables', 'employee.id', '=', 'employeenontaxables.employee_id')
		          ->join('nontaxables', 'employeenontaxables.nontaxable_id', '=', 'nontaxables.id')
		          ->where('in_employment','=','Y')
		          ->select('employeenontaxables.id','first_name','middle_name','last_name','nontaxable_amount','name')
		          ->get();
		return View::make('employeenontaxables.index', compact('nontaxables'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */

   public function create()
	{
		$employees = DB::table('employee')
		          ->where('in_employment','=','Y')
		          ->get();
		$nontaxables = Nontaxable::all();
		$currency = Currency::find(1);
		return View::make('employeenontaxables.create',compact('employees','nontaxables','currency'));
	}

	public function createnontaxable()
	{
      $postdeduction = Input::all();
      $data = array('name' => $postdeduction['name'], 
      	            'organization_id' => 1,
      	            'created_at' => DB::raw('NOW()'),
      	            'updated_at' => DB::raw('NOW()'));
      $check = DB::table('nontaxables')->insertGetId( $data );

		if($check > 0){
         
		Audit::logaudit('Nontaxables', 'create', 'created: '.$postdeduction['name']);
        return $check;
        }else{
         return 1;
        }
      
	} 

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Employeenontaxable::$rules, Employeenontaxable::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$nontaxable = new Employeenontaxable;

		$nontaxable->employee_id = Input::get('employee');

		$nontaxable->nontaxable_id = Input::get('income');

		$nontaxable->formular = Input::get('formular');

		if(Input::get('formular') == 'Instalments'){
		$nontaxable->instalments = Input::get('instalments');
        $insts = Input::get('instalments');

		$a = str_replace( ',', '', Input::get('amount') );
        $nontaxable->nontaxable_amount = $a;

        $d=strtotime(Input::get('idate'));

        $nontaxable->nontaxable_date = date("Y-m-d", $d);

        $effectiveDate = date('Y-m-d', strtotime("+".($insts-1)." months", strtotime(Input::get('idate'))));

        $First  = date('Y-m-01', strtotime(Input::get('idate')));
        $Last   = date('Y-m-t', strtotime($effectiveDate));

        $nontaxable->first_day_month = $First;

        $nontaxable->last_day_month = $Last;

	    }else{
	    $nontaxable->instalments = '1';
        $a = str_replace( ',', '', Input::get('amount') );
        $nontaxable->nontaxable_amount = $a;

        $d=strtotime(Input::get('idate'));

        $nontaxable->nontaxable_date = date("Y-m-d", $d);

        $First  = date('Y-m-01', strtotime(Input::get('idate')));
        $Last   = date('Y-m-t', strtotime(Input::get('idate')));
        

        $nontaxable->first_day_month = $First;

        $nontaxable->last_day_month = $Last;

	    }

        
		$nontaxable->save();

		Audit::logaudit('Employeenontaxables', 'create', 'assigned: '.$nontaxable->nontaxable_amount.' to '.Employee::getEmployeeName(Input::get('employee')));

		return Redirect::route('employeenontaxables.index')->withFlashMessage('Employee non taxable income successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$nontaxable = Employeenontaxable::findOrFail($id);

		return View::make('employeenontaxables.show', compact('nontaxable'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$nontax = Employeenontaxable::find($id);
		$employees = Employee::all();
        $nontaxables = Nontaxable::all();
        $currency = Currency::find(1);
		return View::make('employeenontaxables.edit', compact('nontax','employees','nontaxables','currency'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$nontaxable = Employeenontaxable::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Employeenontaxable::$rules, Employeenontaxable::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$nontaxable->nontaxable_id = Input::get('income');

		$nontaxable->formular = Input::get('formular');

		if(Input::get('formular') == 'Instalments'){
		$nontaxable->instalments = Input::get('instalments');
        $insts = Input::get('instalments');

		$a = str_replace( ',', '', Input::get('amount') );
        $nontaxable->nontaxable_amount = $a;

        $d=strtotime(Input::get('idate'));

        $nontaxable->nontaxable_date = date("Y-m-d", $d);

        $effectiveDate = date('Y-m-d', strtotime("+".($insts-1)." months", strtotime(Input::get('idate'))));

        $First  = date('Y-m-01', strtotime(Input::get('idate')));
        $Last   = date('Y-m-t', strtotime($effectiveDate));

        $nontaxable->first_day_month = $First;

        $nontaxable->last_day_month = $Last;

	    }else{
	    $nontaxable->instalments = '1';
        $a = str_replace( ',', '', Input::get('amount') );
        $nontaxable->nontaxable_amount = $a;

        $d=strtotime(Input::get('idate'));

        $nontaxable->nontaxable_date = date("Y-m-d", $d);

        $First  = date('Y-m-01', strtotime(Input::get('idate')));
        $Last   = date('Y-m-t', strtotime(Input::get('idate')));
        

        $nontaxable->first_day_month = $First;

        $nontaxable->last_day_month = $Last;

	    }

		$nontaxable->update();

		Audit::logaudit('employeenontaxables', 'update', 'assigned: '.$nontaxable->nontaxable_amount.' for '.Employee::getEmployeeName($nontaxable->employee_id));

		return Redirect::route('employeenontaxables.index')->withFlashMessage('Employee non taxable income successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$nontaxable = Employeenontaxable::findOrFail($id);
		Employeenontaxable::destroy($id);

		Audit::logaudit('Employeenontaxables', 'delete', 'deleted: '.$nontaxable->nontaxable_amount.' for '.Employee::getEmployeeName($nontaxable->employee_id));

		return Redirect::route('employeenontaxables.index')->withDeleteMessage('Employee non taxable income successfully deleted!');
	}

	public function view($id){

		$nontaxable = DB::table('employee')
		          ->join('employeenontaxables', 'employee.id', '=', 'employeenontaxables.employee_id')
		          ->join('nontaxables', 'employeenontaxables.nontaxable_id', '=', 'nontaxables.id')
		          ->where('employeenontaxables.id','=',$id)
		          ->select('employeenontaxables.id','first_name','last_name','middle_name','formular','instalments','nontaxable_amount','name','nontaxable_date','last_day_month','photo','signature')
		          ->first();

		$organization = Organization::find(1);

		return View::make('employeenontaxables.view', compact('nontaxable'));
		
	}

}
