@extends('layouts.erp')
@section('content')
<br><br/>
<div class="row">
                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('items/create')}}">
                          <i class="fa fa-barcode fa-2x"></i>
                          <div>New Item</div>
                          
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('clients/create')}}">
                          <i class="fa fa-user fa-2x"></i>
                          <div>New Client</div>
                          
                        </a>
                      </div>


                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{URL::to('checks/create')}}">
                          <i class="glyphicon glyphicon-random fa-2x"></i>
                          <div>New Checkout</div>
                          
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('bookings/create')}}">
                          <i class="glyphicon glyphicon-th fa-2x"></i>
                          <div>New Booking</div>
                          
                        </a>
                      </div>
                      
                      

                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('maintenances/create')}}">
                          <i class="glyphicon glyphicon-th-large fa-2x"></i>
                          <div>New Maintenance</div>
                          
                        </a>
                      </div>


                     


                       

                      
                    </div>


<br><br>
<hr>
<div class="row">
              						
<div class="col-lg-4"></div>
	<div class="col-lg-4">

		

		<br><br>
		<img src="{{ asset('public/uploads/logos/'.Organization::getLogo()) }}" alt="LOGO" width="80%"/>
    
	</div>


</div>

@stop