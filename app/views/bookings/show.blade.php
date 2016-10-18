<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>Booking</h3>

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
          
          <table class="table table-condensed table-bordered">
            <tr>
              <td>Event</td><td>{{$booking->event}}</td>
            </tr>
            <tr>
              <td>Start Date</td><td>{{$booking->start_date}}</td>
            </tr>
            <tr>
              <td>End Date</td><td>{{$booking->end_date}}</td>
            </tr>
            <tr>
              <td>Client</td><td>{{$booking->client->name}}</td>
            </tr>
             <tr>
              <td>Venue</td><td>{{$booking->venue}}</td>
            </tr>
             <tr>
              <td>Tech Lead</td><td>{{$booking->lead}}</td>
            </tr>
          </table>

      </div>
    </div>
   

    <div class="col-lg-7">
          
          <table class="table table-condensed table-bordered">
            <tr style="font-weight:bold">
              <td colspan="3">Booked Items</td>
            </tr>
            <tr style="font-weight:bold">
              <td>Item</td><td>Tag </td><td>SKU</td>
            </tr>
            @foreach(Booking::getItems($booking->id) as $item)
            <tr>
              <td>{{Item::getItemName($item->item_id)}}</td>
              <td>{{Item::getItemTag($item->item_id)}}</td>
              <td>{{Item::getItemSku($item->item_id)}}</td>
            </tr>
            @endforeach
          </table>

      </div>
 
    


</div>

@stop