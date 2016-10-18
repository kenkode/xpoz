@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Booking</h3>

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

		 <form method="POST" action="{{{ URL::to('bookings/add') }}}" accept-charset="UTF-8">
   
    <fieldset>
        
         <div class="form-group">
            <label for="username">Event:</label>
            <input type="text" name="event"  class="form-control" >
        </div>

        <div class="form-group">
                        <label for="username">Start Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker21"  readonly="readonly" placeholder="" type="text" name="start_date" id="start_date" >
                        </div>
          </div>


           <div class="form-group">
                        <label for="username">End Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker21"  readonly="readonly" placeholder="" type="text" name="end_date" id="end_date" >
                        </div>
          </div>


          <div class="form-group">
            <label for="username">Client <span style="color:red">*</span> :</label>
            <select name="client_id" class="form-control">
                @foreach($clients as $client)
                @if($client->type == 'Customer')
                    <option value="{{$client->id}}">{{$client->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>

         <div class="form-group">
            <label for="username">Venue:</label>
            <input class="form-control" placeholder="" type="text" name="venue" id="venue" value="{{{ Input::old('venue') }}}" >
        </div>

        <div class="form-group">
            <label for="username">Tech Lead <span style="color:red">*</span> :</label>
            <select name="lead" class="form-control">
                @foreach($employees as $employee)
               
                    <option value="{{$employee->first_name.' '.$employee->last_name}}">{{$employee->first_name.' '.$employee->last_name}}</option>
                    
                @endforeach
            </select>
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop