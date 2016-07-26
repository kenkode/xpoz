@extends('layouts.erp')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Fixed Asset</h3>

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


       

		 <form method="POST" action="{{{ URL::to('assets/update/'.$asset->id) }}}" accept-charset="UTF-8">
   
    <fieldset>

         

        <div class="form-group">
            <label for="username">Asset Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{$asset->name}}">
        </div>

        <div class="form-group">
            <label for="username">Date Purchased</label>
            <div class="right-inner-addon ">
            <i class="glyphicon glyphicon-calendar"></i>
            <input readonly class="form-control datepicker21" placeholder="" type="text" name="purchase_date" id="name" value="{{$asset->purchase_date}}">
        </div>
        </div>

        <div class="form-group">
            <label for="username">Quantity</label>
            <input class="form-control" placeholder="" type="text" name="quantity" id="quantity" value="{{$asset->quantity}}">
        </div>

        <div class="form-group">
            <label for="username">Purchase Cost</label>
            <input class="form-control" placeholder="" type="text" name="cost" id="name" value="{{$asset->cost}}">
        </div>

        <div class="form-group">
            <label for="username">Asset Type</label>
            <input class="form-control" placeholder="" type="text" name="type" id="type" value="{{$asset->asset_type}}">
        </div>

        <div class="form-group">
            <label for="username">Expected Life Years</label>
            <input class="form-control" placeholder="" type="text" name="life_years" id="name" value="{{$asset->life_years}}">
        </div>

        <div class="form-group">
            <label for="username">Serial Number</label>
            <input class="form-control" placeholder="" type="text" name="serial_number" id="name" value="{{$asset->serial_number}}">
        </div>

        <div class="form-group">
            <label for="username">Receipt Number</label>
            <input class="form-control" placeholder="" type="text" name="receipt_number" id="name" value="{{$asset->receipt_number}}">
        </div>

        <div class="form-group">
            <label for="username">Accumulated Depreciation Amount</label>
            <input class="form-control" placeholder="" type="text" name="accumulated_dep_amount" id="name" value="{{$asset->accumulated_dep_amount}}">
        </div>

        <div class="form-group">
            <label for="username">Disposal Date</label>
            <div class="right-inner-addon ">
            <i class="glyphicon glyphicon-calendar"></i>
            <input readonly class="form-control datepicker21" placeholder="" type="text" name="disposal_date" id="name" value="{{$asset->disposal_date}}">
        </div>
        </div>

        <div class="form-group">
            <label for="username">Disposal Method</label>
            <input class="form-control" placeholder="" type="text" name="disposal_method" id="name" value="{{$asset->disposal_method}}">
        </div>

        <div class="form-group">
            <label for="username">Disposal Amount </label>
            <input class="form-control" placeholder="" type="text" name="disposal_amount" id="name" value="{{$asset->disposal_amount}}">
        </div>

        <div class="form-group">
            <label for="username">Depreciation Policy</label>
            <select class="form-control" name="dep_policy">
                <option value="reducing balance"<?= ($asset->dep_policy=='reducing balance')?'selected="selected"':''; ?>>Reducing Balance</option>
                <option value="straight line"<?= ($asset->dep_policy=='straight line')?'selected="selected"':''; ?>>Straight Line</option>
                
                
            </select>
            
        </div>




       

        







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Asset</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop