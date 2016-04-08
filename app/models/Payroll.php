<?php

class Payroll extends \Eloquent {
    public $table = "transact";

    /*

    use \Traits\Encryptable;


    protected $encryptable = [
        'basic_pay',
        'earning_amount',
        'taxable_income',
        'paye',
        'nssf_amount',
        'vol_amount',
        'nhif_amount',
        'net',
        'other_deductions',
        'total_deductions',
        'financial_month_year',

    ];
    */

public static $rules = [
        'period' => 'required',
        'account' => 'required'
    ];

    public static $messages = array(
        'period.required'=>'Please select period!',
        'account.required'=>'Please select account type!',
    );

    // Don't forget to fill this array
    protected $fillable = [];


    public function employees(){

        return $this->hasMany('Employee');
    }

    public static function allowances($id,$period){
    $allw = 0.00;
    
    $total_allws = DB::table('employee_allowances')
                     ->select(DB::raw('COALESCE(sum(allowance_amount),0.00) as total_allowances'))
                     ->where('employee_id', '=', $id)
                     ->get();
    foreach($total_allws as $total_allw){
    $allw = $total_allw->total_allowances;
    }
    return round($allw,2);

    }

    public static function reliefs($id,$period){
    $rel = 0.00;
    
    $total_rels = DB::table('employee_relief')
                     ->select(DB::raw('COALESCE(sum(relief_amount),0.00) as total_reliefs'))
                     ->where('employee_id', '=', $id)
                     ->get();
    foreach($total_rels as $total_rel){
    $rel = $total_rel->total_reliefs;
    }
    return round($rel,2);

    }

    public static function earnings($id,$period){
 
    $part = explode("-", $period);
    $start = $part[1]."-".$part[0]."-01";
    $end  = date('Y-m-t', strtotime($start));

    $earn = 0.00;

    $total_earns = DB::table('earnings')
                     ->select(DB::raw('COALESCE(sum(earnings_amount),0.00) as total_earnings,instalments'))
                     ->where(function ($query) use ($id,$start){
                       $query->where('employee_id', '=', $id)
                             ->where('formular', '=', 'Recurring')
                             ->where('first_day_month','<=',$start);
                       })
                      ->orWhere(function ($query) use ($id,$start) {
                        $query->where('employee_id', '=', $id)
                              ->where('instalments', '>', 0)
                              ->where('first_day_month','<=',$start)
                              ->where('last_day_month','>=',$start);
                        })->get();
                      
    foreach($total_earns as $total_earn){
    if($total_earn->instalments>=1){
    $earn = $total_earn->total_earnings;
    }else{
    $earn = 0.00;
    }
    }
    
    return round($earn,2);

    }
    
    public static function salary_pay($id,$period){
    $salary = 0.00;
    
    $pays = DB::table('employee')
                     ->select(DB::raw('COALESCE(sum(basic_pay),0.00) as total_pay'))
                     ->where('id', '=', $id)
                     ->get();
    foreach($pays as $pay){
    $salary = $pay->total_pay;
    }
    return round($salary,2);
   }

   public static function overtimes($id,$period){
    $otime = 0.00;
    
    $total_overtimes = DB::table('overtimes')
                     ->select(DB::raw('COALESCE(sum(amount*period),0.00) as overtimes'))
                     ->where('employee_id', '=', $id)
                     ->get();
    foreach($total_overtimes as $total_overtime){
    $otime = $total_overtime->overtimes;
    }
    return round($otime,2);

    }

    public static function total_benefits($id,$period){
    $total_earnings = 0.00;
    
    $total_earnings = static::allowances($id,$period)+static::earnings($id,$period)+static::overtimes($id,$period);

    return round($total_earnings,2);

    }

    public static function gross($id,$period){
    $total_gross = 0.00;
    
    $total_gross = static::salary_pay($id,$period)+static::total_benefits($id,$period);

    return round($total_gross,2);

    }


    public static function tax($id,$period){
    $paye = 0.00;
    $total_pay = static::gross($id,$period);
    $total_nssf = static::nssf($id,$period);
    $taxable = $total_pay-$total_nssf;
    $emps = DB::table('employee')->where('id', '=', $id)->get();
    foreach($emps as $emp){
    if($emp->income_tax_applicable=='0'){
    $paye=0.00;
    }else if($emp->income_tax_applicable=='1' && $emp->income_tax_relief_applicable=='1'){
    if($taxable>=11135.67 && $taxable<19741){
    $paye = 1016.4+($taxable-10165)*15/100;
    $paye = $paye-1162.00-static::reliefs($id,$period);
    }else if($taxable>=19741 && $taxable<29317){
    $paye = 2452.8+($taxable-19741)*20/100;
    $paye = $paye-1162.00-static::reliefs($id,$period);
    }else if($taxable>=29317 && $taxable<38893){
    $paye = 4368+($taxable-29317)*25/100;
    $paye = $paye-1162.00-static::reliefs($id,$period);
    }else if($taxable>=38893){
    $paye = 6762+($taxable-38893)*30/100;
    $paye = $paye-1162.00-static::reliefs($id,$period);
    }else{
    $paye = 0.00;
    }
    }else if($emp->income_tax_applicable=='1' && $emp->income_tax_relief_applicable=='0'){
    if($taxable>=11135.67 && $taxable<19741){
    $paye = 1016.4+($taxable-10165)*15/100;
    $paye = $paye-static::reliefs($id,$period);
    }else if($taxable>=19741 && $taxable<29317){
    $paye = 2452.8+($taxable-19741)*20/100;
    $paye = $paye-static::reliefs($id,$period);
    }else if($taxable>=29317 && $taxable<38893){
    $paye = 4368+($taxable-29317)*25/100;
    $paye = $paye-static::reliefs($id,$period);
    }else if($taxable>=38893){
    $paye = 6762+($taxable-38893)*30/100;
    $paye = $paye-static::reliefs($id,$period);
    }else{
    $paye = 0.00;
    }
    }else if($emp->income_tax_applicable=='0' && $emp->income_tax_relief_applicable=='1'){
     $paye = 0.00;
    }
    }
    return round($paye,2);
   }

    public static function nssf($id,$period){
    $nssfAmt = 0.00;
    $total = static::gross($id,$period);
    $emps = DB::table('employee')->where('id', '=', $id)->get();
    foreach($emps as $emp){
    if($emp->social_security_applicable=='0'){
    $nssfAmt=0.00;
    }else{
    $nssf_amts = DB::table('social_security')->get();
    foreach($nssf_amts as $nssf_amt){
    $from=$nssf_amt->income_from;
    $to=$nssf_amt->income_to;
    if($total>=$from && $total<=$to){
    $nssfAmt=$nssf_amt->ss_amount_employee;
    }
    }
    }
    }
    return round($nssfAmt,2);
   }

   public static function nhif($id,$period){
    $nhifAmt = 0.00;
    $total = static::gross($id,$period);
    $emps = DB::table('employee')->where('id', '=', $id)->get();
    foreach($emps as $emp){
    if($emp->hospital_insurance_applicable=='0'){
    $nhifAmt=0.00;
    }else{
    $nhif_amts = DB::table('hospital_insurance')->get();
    foreach($nhif_amts as $nhif_amt){
    $from=$nhif_amt->income_from;
    $to=$nhif_amt->income_to;
    if($total>=$from && $total<=$to){
    $nhifAmt=$nhif_amt->hi_amount;
    }
    }
    }
   }
    return round($nhifAmt,2);
   }
    
    public static function deductions($id,$period){
    
    $part = explode("-", $period);
    $start = $part[1]."-".$part[0]."-01";
    $end  = date('Y-m-t', strtotime($start));

    $other_ded = 0.00;

    
    $deds = DB::table('employee_deductions')
                     ->select(DB::raw('COALESCE(sum(deduction_amount),0.00) as total_deduction,instalments'))
                     ->where(function ($query) use ($id,$start){
                       $query->where('employee_id', '=', $id)
                             ->where('formular', '=', 'Recurring')
                             ->where('first_day_month','<=',$start);
                       })
                      ->orWhere(function ($query) use ($id,$start) {
                        $query->where('employee_id', '=', $id)
                              ->where('instalments', '>', 0)
                              ->where('first_day_month','<=',$start)
                              ->where('last_day_month','>=',$start);
                        })->get();
    foreach($deds as $ded){
    if($ded->instalments>=1){
    $other_ded = $ded->total_deduction;
    }else{
    $other_ded = 0.00;
    }
    }
    return round($other_ded,2);
   }

   public static function total_deductions($id,$period){
    $total_deds = 0.00;
    
    $total_deds = static::tax($id,$period)+static::nssf($id,$period)+static::nhif($id,$period)+static::deductions($id,$period);

    return round($total_deds,2);

    }

    public static function net($id,$period){
    $total_net = 0.00;
    
    $total_net = static::gross($id,$period)-static::total_deductions($id,$period);

    return round($total_net,2);

    }

     public static function asMoney($value){

        return number_format($value, 2);

    }

    public static function processedsalaries($id,$period){

    $salary = 0.00;
    
    $pays = DB::table('transact')
                     ->select('employee_id',DB::raw('COALESCE(sum(basic_pay),0.00) as total_pay'))
                     ->where('financial_month_year' ,'=', $period)
                     ->where('employee_id', '=', $id)
                     ->groupBy('employee_id')
                     ->get();

    foreach($pays as $pay){
    $salary = $pay->total_pay;
    }
    
    return  number_format($salary,2);

    }

    public static function processedhouseallowances($id,$period){

    $hallw = 0.00;
    
    $total_hallws = DB::table('transact_allowances')
                     ->select('employee_id',DB::raw('COALESCE(sum(allowance_amount),0.00) as total_allowances'))
                     ->where('financial_month_year' ,'=', $period)
                     ->where('employee_id', '=', $id)
                     ->where('employee_allowance_id', '=', 1)
                     ->groupBy('employee_id')
                     ->get();

    foreach($total_hallws as $total_hallw){
    $hallw = $total_hallw->total_allowances;
    }
    
    return  number_format($hallw,2);

    }

   public static function processedtransportallowances($id,$period){

    $tallw = 0.00;
    
    $total_tallws = DB::table('transact_allowances')
                     ->select('employee_id',DB::raw('COALESCE(sum(allowance_amount),0.00) as total_allowances'))
                     ->where('financial_month_year' ,'=', $period)
                     ->where('employee_id', '=', $id)
                     ->where('employee_allowance_id', '=', 2)
                     ->groupBy('employee_id')
                     ->get();

    foreach($total_tallws as $total_tallw){
    $tallw = $total_tallw->total_allowances;
    }
    
    return  number_format($tallw,2);

    }

    public static function processedotherallowances($id,$period){

    $oallw = 0.00;
    
    $total_oallws = DB::table('transact_allowances')
                     ->select('employee_id',DB::raw('COALESCE(sum(allowance_amount),0.00) as total_allowances'))
                     ->where('financial_month_year' ,'=', $period)
                     ->where('employee_id', '=', $id)
                     ->where('employee_allowance_id', '<>', 1)
                     ->where('employee_allowance_id', '<>', 2)
                     ->groupBy('employee_id')
                     ->get();

    foreach($total_oallws as $total_oallw){
    $oallw = $total_oallw->total_allowances;
    }
    
    return  number_format($oallw,2);

    }

    public static function processedreliefs($id,$period){

    $rel = 0.00;
    
    $total_rels = DB::table('transact_reliefs')
                     ->select('employee_id',DB::raw('COALESCE(sum(relief_amount),0.00) as total_reliefs'))
                     ->where('financial_month_year' ,'=', $period)
                     ->where('employee_id', '=', $id)
                     ->groupBy('employee_id')
                     ->get();

    foreach($total_rels as $total_rel){
    $rel = $total_rel->total_reliefs;
    }
    
    return  number_format($rel,2);

    }

    public static function processedearnings($id,$period){

    $earn = 0.00;
    
    $total_earns = DB::table('transact_earnings')
        ->select('employee_id',DB::raw('COALESCE(sum(relief_amount),0.00) as total_earnings'))
        ->where('financial_month_year' ,'=', $period)
        ->where('employee_id' ,'=', $id)
        ->groupBy('employee_id')
        ->get();

    foreach($total_earns as $total_earn){
    $earn = $total_earn->total_earnings;
    }
    
    return  number_format($earn,2);

    }

   public static function processedovertimes($id,$period){

    $otime = 0.00;
    
    $total_overtimes = DB::table('transact_overtimes')
                     ->select('employee_id',DB::raw('COALESCE(sum(overtime_period*overtime_amount),0.00) as overtimes'))
                     ->where('financial_month_year' ,'=', $period)
                     ->where('employee_id' ,'=', $id)
                     ->groupBy('employee_id')
                     ->get();

    foreach($total_overtimes as $total_overtime){
    $otime = $total_overtime->overtimes;
    }
    
    return  number_format($otime,2);

    }

}