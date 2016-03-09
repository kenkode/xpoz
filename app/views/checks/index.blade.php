<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>Check in / Check out</h3>

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
          <a class="btn btn-info btn-sm" href="{{ URL::to('checks/create')}}">new Checkout</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Item</th>
        <th>Checkout Date</th>
        <th>Date Expected back</th>
        <th>Checked out by</th>
        <th>Remarks</th>
        <th>Status</th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($checks as $check)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $check->item->name }}</td>
          <td>{{ $check->date_out }}</td>
          <td>{{$check->date_expected_back}}</td>
           <td>{{$check->checked_out_by}}</td>
            <td>{{$check->remarks_out}}</td>
            <td>
              @if($check->date_in == null)
              Out
              @else
              In Store
              @endif
            </td>
          
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                      @if($check->date_in == null)
                     <li><a href="{{URL::to('checks/checkin/'.$check->id)}}">Checkin</a></li>

                     <li class="divider"></li>
                     @endif
                   <li><a href="{{URL::to('checks/show/'.$check->id)}}">View</a></li>

                    <li><a href="{{URL::to('checks/edit/'.$check->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('checks/delete/'.$check->id)}}" onclick="return (confirm('Are you sure you want to delete this entry?'))">Delete</a></li>
                    
                  </ul>
              </div>

                    </td>



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
  </div>


  </div>

</div>

@stop