@extends('layouts.erp')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Fixed Asset</h3>

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


       

		 <form method="POST" action="{{{ URL::to('assets') }}}" accept-charset="UTF-8">
   
    <fieldset>

         

        <div class="form-group">
            <label for="username">Asset Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Date Purchased</label>
            <input class="form-control datepicker21" placeholder="" type="text" name="purchase_date" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Purchase Cost</label>
            <input class="form-control" placeholder="" type="text" name="cost" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Expected Life Years</label>
            <input class="form-control" placeholder="" type="text" name="life_years" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Serial Number</label>
            <input class="form-control" placeholder="" type="text" name="serial_number" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Receipt Number</label>
            <input class="form-control" placeholder="" type="text" name="receipt_number" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Accumulated Depreciation Amount</label>
            <input class="form-control" placeholder="" type="text" name="accumulated_dep_amount" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Disposal Date</label>
            <input class="form-control datepicker21" placeholder="" type="text" name="disposal_date" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Disposal Method</label>
            <input class="form-control" placeholder="" type="text" name="disposal_method" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Disposal Amount </label>
            <input class="form-control" placeholder="" type="text" name="disposal_amount" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Depreciation Policy</label>
            <select class="form-control" name="dep_policy">
                
                <option value="reducing balance">Reducing Balance</option>
                <option value="straight line">Straight Line</option>
                
            </select>
            
        </div>




       

        







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Asset</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop