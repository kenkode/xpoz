@extends('layouts.erp')
@section('content')

<style type="text/css" media="screen">
  .quicklink{
    text-align: center;
  }

  .quicklink div{
      font-weight: 400;
  }

  .quicklink a{
      width: 100%;
      padding: 15px 5px;
      color: #FFF;
      transition: all linear 0.25s;
  }

  .quicklink a:hover{
      color: #FFF;
      transform: translateY(-5px);
      box-shadow: 0px 1px 2px rgba(0,0,0,0.3);
      filter: brightness(90%);
  }

</style>

<br><br><br>
<div class="row">
      <div class="col-md-2 col-md-offset-1 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('items/create')}}" style="background: #3498DB">
          <i class="fa fa-barcode fa-2x"></i>
          <div>New Item</div>
          
        </a>
      </div>

      <div class="col-md-2 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('clients/create')}}" style="background: #2ECC71">
          <i class="fa fa-user fa-2x"></i>
          <div>New Client</div>
          
        </a>
      </div>


      <div class="col-md-2 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{URL::to('checks/create')}}" style="background: #9B59B6">
          <i class="fa fa-random fa-2x"></i>
          <div>New Checkout</div>
          
        </a>
      </div>

      <div class="col-md-2 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('bookings/create')}}" style="background: #F39C12">
          <i class="fa fa-th fa-2x"></i>
          <div>New Booking</div>
          
        </a>
      </div>
      
      

      <div class="col-md-2 quicklink">
        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('maintenances/create')}}" style="background: #34495E">
          <i class="fa fa-th-large fa-2x"></i>
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