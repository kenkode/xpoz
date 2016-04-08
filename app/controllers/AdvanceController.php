<?php

class AdvanceController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
        $accounts = Account::all();

		return View::make('advances.index', compact('accounts'));
	}

    public function preview_advance()
	{

		$employees = DB::table('employee')
                  ->join('employee_deductions', 'employee.id', '=', 'employee_deductions.employee_id')
		          ->where('in_employment','=','Y')
                  ->where('deduction_id',1)
		          ->get();

		//print_r($accounts);

		Audit::logaudit('advance salary', 'preview', 'previewed advance salaries');


		return View::make('advances.preview', compact('employees'));
	}

    public function valid()
	{
		$period = Input::get('period');

		//print_r($accounts);

		return View::make('advances.valid', compact('period'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = DB::table('employee')
                  ->join('employee_deductions', 'employee.id', '=', 'employee_deductions.employee_id')
                  ->where('in_employment','=','Y')
                  ->where('deduction_id',1)
                  ->where('instalments','>',0)
                  ->get();
		$period = Input::get('period');
		$account = Input::get('account');

		//print_r($accounts);

		Audit::logaudit('Advance Salaries', 'preview', 'previewed advance salaries');

		return View::make('advances.preview', compact('employees','period','account'));
	}

	public function del_exist()
	{
    $postedit = Input::all();
    $part1    = $postedit['period1'];
    $part2    = $postedit['period2'];
    $part3    = $postedit['period3'];

    $period   = $part1.$part2.$part3;  

    $data   = DB::table('transact_advances')->where('financial_month_year', '=', $period)->delete();
   
    if($data > 0){
      return 0;
    }else{
      return 1;
    }
    

    exit();
	}

	public function display(){
      $display = "";
      $postedit = Input::all();
      $part1    = $postedit['period1'];
      $part2    = $postedit['period2'];
      $part3    = $postedit['period3'];

      $fperiod   = $part1.$part2.$part3; 
      $employees = DB::table('employee')
                  ->join('employee_deductions', 'employee.id', '=', 'employee_deductions.employee_id')
                  ->where('in_employment','=','Y')
                  ->where('deduction_id',1)
                  ->where('instalments','>',0)
                  ->get();
        
        $i=1;
        foreach($employees as $employee){
        $deductions = number_format($employee->deduction_amount);

        $display .="
        <tr>

          <td> $i </td>
          <td >$employee->personal_file_number</td>
          <td>$employee->first_name $employee->last_name </td>
          <td align='right'>$deductions</td>
          
        </tr>
        ";
         $i++;
         
        } 
        return $display;
        exit();

    }

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$employees = DB::table('employee')
                  ->join('employee_deductions', 'employee.id', '=', 'employee_deductions.employee_id')
                  ->where('in_employment','=','Y')
                  ->where('deduction_id',1)
                  ->where('instalments','>',0)
                  ->get();
		foreach ($employees as $employee) {
		$advance = new Advance;

		$advance->employee_id = $employee->personal_file_number;
		$advance->amount = $employee->deduction_amount; 
		$advance->financial_month_year = Input::get('period');
        $advance->account_id = Input::get('account');
        $advance->save();
		}

        $period = Input::get('period'); 
        Audit::logaudit('Advance Salaries', 'process', 'processed advance salaries for '.$period);
    
	return Redirect::route('advance.index')->withFlashMessage('Advance Salaries successfully processed!');
         

	}

	

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$advance = Advance::findOrFail($id);

		return View::make('advances.show', compact('advance'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$deduction = Deduction::find($id);

		return View::make('deductions.edit', compact('deduction'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$deduction = Deduction::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Deduction::$rules, Deduction::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$deduction->deduction_name = Input::get('name');
		$deduction->update();

		return Redirect::route('deductions.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Deduction::destroy($id);

		return Redirect::route('deductions.index');
	}

}
