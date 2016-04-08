<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>{{$item->name}}</h3>

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

        <table class="table table-bordered">

          <tr>
            <td>Item</td><td>{{$item->name}}</td>
          </tr>
          <tr>
            <td>Category</td><td>{{$item->category}}</td>
          </tr>
          <tr>
            <td>Description</td><td>{{$item->description}}</td>
          </tr>
          <tr>
            <td>Purchase Price</td><td>{{asMoney($item->purchase_price)}}</td>
          </tr>
          <tr>
            <td>Rate</td><td>{{asMoney($item->selling_price)}}</td>
          </tr>
          <tr>
            <td>Duration</td><td>per {{$item->duration}}</td>
          </tr>
          <tr>
            <td>SKU</td><td>{{$item->sku}}</td>
          </tr>
          <tr>
            <td>Tag ID</td><td>{{$item->tag_id}}</td>
          </tr>
        
        </table>
      
      </div>
      
    </div>

    


</div>

@stop