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

    
      <div class="row">

          <div class="col-lg-5">  

              <table class="table table-bordered table-respoonsive">
                  <tr>
                    <td colspan="2">Checkout Details</td>
                  </tr>
                  <tr>
                    <td>Item</td><td>{{$check->item->name}}</td>
                  </tr>

                  <tr>
                    <td>Date Out</td><td>{{$check->date_out}}</td>
                  </tr>

                  <tr>
                    <td>Expected date back</td><td>{{$check->date_expected_back}}</td>
                  </tr>


                   <tr>
                    <td>Checked out by</td><td>{{$check->checked_out_by}}</td>
                  </tr>

                   <tr>
                    <td>Remarks</td><td>{{$check->remarks_out}}</td>
                  </tr>
                
                
              </table>
            
          </div>


          <div class="col-lg-5">  

              <table class="table table-bordered table-respoonsive">
                  <tr>
                    <td colspan="2">Checkin Details</td>
                  </tr>
                  
                  <tr>
                    <td>Date In</td><td>{{$check->date_in}}</td>
                  </tr>

                  <tr>
                    <td>Condition</td><td>{{$check->condition_back}}</td>
                  </tr>


                   <tr>
                    <td>Checked in by</td><td>{{$check->checked_in_by}}</td>
                  </tr>

                   <tr>
                    <td>Remarks</td><td>{{$check->remarks_in}}</td>
                  </tr>
                
                
              </table>
            
          </div>
        
      </div>

</div>

@stop