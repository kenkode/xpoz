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
            <div class="right-inner-addon ">
            <i class="glyphicon glyphicon-calendar"></i>
            <input readonly class="form-control datepicker21" placeholder="" type="text" name="purchase_date" id="name" value="{{{ Input::old('name') }}}">
        </div>
        </div>

        <div class="form-group">
            <label for="username">Quantity</label>
            <input class="form-control" placeholder="" type="text" name="quantity" id="quantity" value="{{{ Input::old('quantity') }}}">
        </div>

        <div class="form-group">
            <label for="username">Purchase Cost</label>
            <input class="form-control" placeholder="" type="text" name="cost" id="cost" value="{{{ Input::old('cost') }}}">
        </div>

        <div class="form-group">
            <label for="username">Asset Type</label>
            <input class="form-control" placeholder="" type="text" name="type" id="type" value="{{{ Input::old('type') }}}">
        </div>

        <div class="form-group">
            <label for="username">Expected Life Years</label>
            <input class="form-control" placeholder="" type="text" name="life_years" id="life_years" value="{{{ Input::old('life_years') }}}">
        </div>

        <div class="form-group">
            <label for="username">Serial Number</label>
            <input class="form-control" placeholder="" type="text" name="serial_number" id="serial_number" value="{{{ Input::old('serial_number') }}}">
        </div>

        <div class="form-group">
            <label for="username">Receipt Number</label>
            <input class="form-control" placeholder="" type="text" name="receipt_number" id="receipt_number" value="{{{ Input::old('receipt_number') }}}">
        </div>

        <div class="form-group">
            <label for="username">Accumulated Depreciation Amount</label>
            <input class="form-control" placeholder="" type="text" name="accumulated_dep_amount" id="name" value="{{{ Input::old('name') }}}">
        </div>

        <div class="form-group">
            <label for="username">Disposal Date</label>
            <div class="right-inner-addon ">
            <i class="glyphicon glyphicon-calendar"></i>
            <input readonly class="form-control datepicker21" placeholder="" type="text" name="disposal_date" id="disposal_date" value="{{{ Input::old('disposal_date') }}}">
        </div>
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