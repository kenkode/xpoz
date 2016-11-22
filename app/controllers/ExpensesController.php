<?php

class ExpensesController extends \BaseController {

	/**
	 * Display a listing of expenses
	 *
	 * @return Response
	 */
	public function index()
	{
		$expenses = Expense::all();

		return View::make('expenses.index', compact('expenses'));
	}

	/**
	 * Show the form for creating a new expense
	 *
	 * @return Response
	 */
	public function create()
	{
		$from_ac = Account::where('category', 'ASSET')->get();
		$to_ac = Account::where('category', 'LIABILITY')->orWhere('category', 'EXPENSE')->get();

		return View::make('expenses.create',compact('from_ac', 'to_ac'));
	}

	/**
	 * Store a newly created expense in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Expense::$rules, Expense::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$zero_filled = sprintf("%07d", (DB::table('expenses')->count())+1);
		$prefix = 'EXP';
		$ref_no = $prefix.$zero_filled;

		// SAVE ALL INPUT DATA IN AN ARRAY
		$input = array(
			'date' => date('Y-m-d'),
			'debit_account' => Input::get('to_account'),
			'credit_account' => Input::get('from_account'),
			'amount' => Input::get('amount'),
			'initiated_by' => Confide::user()->id
		);

		$expense = new Expense;

		$expense->name = Input::get('name');
		$expense->type = Input::get('type');
		$expense->amount = Input::get('amount');		
		$expense->date = date("Y-m-d",strtotime(Input::get('date')));
		$expense->account_id = Input::get('from_account');
		$expense->ref_no = $ref_no;
		$expense->save();

		if(Input::get('type') == "Expenditure"){
			$desc = array('description' => 'Spent KES. '.Input::get('amount').' on '.Input::get('name'));
			$input = array_merge($input, $desc);
			
        	DB::table('accounts')
            ->join('expenses','accounts.id','=','expenses.account_id')
            ->where('accounts.id', Input::get('from_account'))
            ->decrement('accounts.balance', Input::get('amount'));

         DB::table('accounts')
            ->join('expenses','accounts.id','=','expenses.account_id')
            ->where('accounts.id', Input::get('to_account'))
            ->increment('accounts.balance', Input::get('amount'));

         // SAVE TRANSACTION
         $acTransaction = new AccountTransaction;
         $journal = new Journal;
         $acTransaction->createTransaction($input);
         $journal->journal_entry($input);

		} else if(Input::get('type') == "Bill"){
			$desc = array(
				'description' => 'Created a Bill worth KES. '.Input::get('amount').' on '.Input::get('name'),
				'status' => 'BILL'
			);
			$input = array_merge($input, $desc);

         DB::table('accounts')
            ->join('expenses','accounts.id','=','expenses.account_id')
            ->where('accounts.id', Input::get('to_account'))
            ->increment('accounts.balance', Input::get('amount'));

         // SAVE TRANSACTION
         $acTransaction = new AccountTransaction;
         $acTransaction->createTransaction($input);
		}

		return Redirect::route('expenses.index')->withFlashMessage('Expense successfully created!');
	}

	/**
	 * Display the specified expense.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$expense = Expense::findOrFail($id);

		return View::make('expenses.show', compact('expense'));
	}

	/**
	 * Show the form for editing the specified expense.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$expense = Expense::find($id);
		$from_ac = Account::where('category', 'ASSET')->get();
		$to_ac = Account::where('category', 'LIABILITY')->orWhere('category', 'EXPENSE')->get();


		return View::make('expenses.edit', compact('expense','from_ac','to_ac'));
	}

	/**
	 * Update the specified expense in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$expense = Expense::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Expense::$rules, Expense::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
    
		$account = DB::table('expenses')->where('id', $id)->select('amount', 'account_id')->first();
		//return $account;
		/*$zero_filled = sprintf("%07d", $expense->id);
		$prefix = 'EXP';
		$ref_no = $prefix.$zero_filled;*/

		$expense->name = Input::get('name');
		$expense->type = Input::get('type');
		$expense->amount = Input::get('amount');
		$expense->date = date("Y-m-d",strtotime(Input::get('date')));
		$expense->account_id = Input::get('from_account');
		//$expense->ref_no = $ref_no;

		$expense->update();

		if($account->account_id === Input::get('from_account')){
			$bal = Input::get('amount') - $account->amount;
			DB::table('accounts')
            ->join('expenses','accounts.id','=','expenses.account_id')
            ->where('accounts.id', Input::get('from_account'))
            ->decrement('accounts.balance', $bal);
            /*if(Input::get('type') == 'Expenditure'){
            	
            }*/
		} else{
			DB::table('accounts')
            ->where('accounts.id', $account->account_id)
            ->increment('accounts.balance', $account->amount);
      DB::table('accounts')
            ->join('expenses','accounts.id','=','expenses.account_id')
            ->where('accounts.id', Input::get('account'))
            ->decrement('accounts.balance', Input::get('amount'));
		}

		return Redirect::route('expenses.index')->withFlashMessage('Expense successfully updated!');
	}

	/**
	 * Remove the specified expense from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Expense::destroy($id);

		return Redirect::route('expenses.index')->withDeleteMessage('Expense successfully deleted!');
	}

}
