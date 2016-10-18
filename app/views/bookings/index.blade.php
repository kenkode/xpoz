<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>Bookings</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">
   
    @if (Session::has('flash_message'))

      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
     </div>
    @endif

    @if (Session::has('delete_message'))

      <div class="alert alert-danger">
      {{ Session::get('delete_message') }}
     </div>
    @endif
 <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('bookings/create')}}">new Booking</a>
        </div>
        <div class="panel-body">

<table class="table table-bordered table-condensed" id="users">

<thead>
  <th>Client</th>
  <th>Event</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th></th>

</thead>
<tbody>
  
  @foreach($bookings as $booking)
    @if($booking->is_cancelled != true)

    <tr>
      <td>{{$booking->client->name}}</td>
      <td>{{$booking->event}}</td>
      <td>{{$booking->start_date}}</td>
      <td>{{$booking->end_date}}</td>
      <td>
        
        <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                  <li><a href="{{URL::to('bookings/show/'.$booking->id)}}">View</a></li>
                    <li><a href="{{URL::to('bookings/edit/'.$booking->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('bookings/delete/'.$booking->id)}}" onclick="return (confirm('Are you sure you want to cancel this booking?'))">Cancel</a></li>
                    
                  </ul>
              </div>
      </td>
    </tr>
    @endif

  @endforeach
</tbody>
  
</table>

</div>
</div>
    


</div>

@stop