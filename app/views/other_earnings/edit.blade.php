<?php

function asMoney($value) {
  return number_format($value, 2);
}

?>

@extends('layouts.payroll')

{{HTML::script('media/jquery-1.8.0.min.js') }}

<script type="text/javascript">
console.log(document.getElementById("instalments").value*document.getElementById("amount").value.replace(/,/g,''));
 function totalBalance() {
      var instals = document.getElementById("instalments").value;
      var amt = document.getElementById("amount").value.replace(/,/g,'');
      var total = instals * amt * 10;
      total=total.toLocaleString('en-US',{minimumFractionDigits: 2});
      document.getElementById("balance").value = total;

}

function totalB() {
      var instals = document.getElementById("instalments").value;
      var amt = document.getElementById("amount").value.replace(/,/g,'');
      var total = instals * amt;
      total=total.toLocaleString('en-US',{minimumFractionDigits: 2});
      document.getElementById("balance").value = total;

}

function getdate() {
    var tt = document.getElementById('ddate').value;
    var instals = document.getElementById("instalments").value;

    var date = new Date(tt);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate()  + parseInt(instals));
    
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var someFormattedDate = dd + '/' + mm + '/' + y;

    if(tt == '' || instals== ''){
    document.getElementById('edate').value = '';
    }else{
    document.getElementById('edate').value = someFormattedDate;
    }
}
</script>

<script type="text/javascript">
$(document).ready(function(){

$('#formular option#instals').each(function() {
    if (this.selected){
       $('#insts').show();
       $('#bal').show();
     }else{
       $('#insts').hide();
       $('#bal').hide();
     }
});

$('#formular').change(function(){
if($(this).val() == "Instalments"){
    $('#insts').show();
    $('#bal').show();
}else{
    $('#insts').hide();
    $('#bal').hide();
}
getdate();
});

$('#ddate').change(function(){
getdate();
});

function getdate() {
var tt = $('#ddate').val();

    var instals = $('#instalments').val();

    if(instals == 1){
    var instals = 1;
    }else{
     var instals = $('#instalments').val();
    }

    var date = new Date(tt);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + parseInt(instals));

    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var someFormattedDate = dd + '/' + mm + '/' + y;

    if($('#ddate').val() == ''){
    $('#edate').val();
    }else{
    $('#edate').val(someFormattedDate);
    }
}

});
</script>
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Employee Earning</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('other_earnings/update/'.$earning->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
                       <div class="form-group">
            <label for="username">Employee</label>
            <input class="form-control" placeholder="" type="text" readonly name="employee" id="employee" value="{{ $earning->first_name.' '.$earning->last_name }}">
        </div> 
                
                    </div>


                    <div class="form-group">
                        <label for="username">Earning Type <span style="color:red">*</span></label>
                        <select name="earning" id="earning" class="form-control">
                            <option></option>
                            @foreach($earningsettings as $earningsetting)
                            <option value="{{ $earningsetting->id }}"<?= ($earning->earning_id==$earningsetting->id)?'selected="selected"':''; ?>> {{ $earningsetting->earning_name }}</option>
                            @endforeach
                        </select>
                
                    </div>

        <div class="form-group">
            <label for="username">Narrative <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="narrative" id="narrative" value="{{ $earning->narrative}}">
        </div>

         <div class="form-group">
                        <label for="username">Formular <span style="color:red">*</span></label>
                        <select name="formular" id="formular" class="form-control forml">
                            <option></option>
                            <option value="One Time"<?= ($earning->formular=='One Time')?'selected="selected"':''; ?>>One Time</option>
                            <option value="Recurring"<?= ($earning->formular=='Recurring')?'selected="selected"':''; ?>>Recurring</option>
                            <option id="instals" value="Instalments"<?= ($earning->formular=='Instalments')?'selected="selected"':''; ?>>Instalments</option>
                        </select>
                
                    </div>

        <div class="form-group" id="insts">
            <label for="username">Instalments </label>
            <input class="form-control" placeholder="" onkeypress="totalB()" onkeyup="totalB()" type="text" name="instalments" id="instalments" value="{{ $earning->instalments}}">
        </div>

        <div class="form-group">
            <label for="username">Amount <span style="color:red">*</span></label>
            <input class="form-control" placeholder=""  onkeypress="totalBalance()" onkeyup="totalBalance()" type="text" name="amount" id="amount" value="{{ asMoney($earning->earnings_amount)}}">
           <script type="text/javascript">
           $(document).ready(function() {
           $('#amount').priceFormat();
           });
           </script> 
        </div>

        <div class="form-group bal_amt" id="bal">
            <label for="username">Total </label>
            <input class="form-control" placeholder="" readonly="readonly" type="text" name="balance" id="balance" value="{{ asMoney((double)$earning->earnings_amount * (double)$earning->instalments)}}">
        </div>
        
       

        <div class="form-group">
                        <label for="username">Earning Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control expiry" readonly="readonly" placeholder="" type="text" name="ddate" id="ddate" value="{{ $earning->earning_date }}">
                        </div>
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Employee Earning</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop