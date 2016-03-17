@extends('layouts.main')
@section('content')
<br/>
<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
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


<a class="btn btn-info btn-sm "  href="{{ URL::to('EmergencyContacts/edit/'.$contact->id)}}">update details</a>
<a class="btn btn-danger btn-sm "  href="{{URL::to('EmergencyContacts/delete/'.$contact->id)}}" onclick="return (confirm('Are you sure you want to delete this employee`s emergency contact?'))">Delete</a>
<a class="btn btn-success btn-sm "  href="{{ URL::to('employees/view/'.$contact->employee->id)}}">Go Back</a>

<hr>
</div>	
</div>


<div class="row">

<div class="col-lg-4">

<table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Contact Personal Information</span></strong></td></tr>
      @if($contact->employee->middle_name != null || $contact->employee->middle_name != ' ')
      <tr><td><strong>Employee: </strong></td><td> {{$contact->employee->last_name.' '.$contact->employee->first_name.' '.$contact->employee->middle_name}}</td></tr>
      @else
      <tr><td><strong>Employee: </strong></td><td> {{$contact->employee->last_name.' '.$contact->employee->first_name}}</td></tr>
      @endif
      
      <tr><td><strong>Name: </strong></td><td>{{$contact->name}}</td></tr>
      <tr><td><strong>Relationship: </strong></td><td>{{$contact->relationship}}</td></tr>
      <tr><td><strong>ID Number: </strong></td><td>{{$contact->id_number}}</td></tr>
      <tr><td><strong>Phone number 1: </strong></td><td>{{$contact->phone1}}</td></tr>
      <tr><td><strong>Phone number 1: </strong></td><td>{{$contact->phone2}}</td></tr>
</table>
</div>

<div class="col-lg-4">

<table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Contact Home Address</span></strong></td></tr>
      @if($contact->same_address_employee == 1)
      <tr><td><strong>Address: </strong></td><td> {{$contact->employee->postal_address}}</td></tr>
      <tr><td><strong>Zip: </strong></td><td>{{$contact->employee->postal_zip}}</td></tr>
      @else
      <tr><td><strong>Address1: </strong></td><td>{{$contact->address1}}</td></tr>
      <tr><td><strong>Address2: </strong></td><td>{{$contact->address2}}</td></tr>
      <tr><td><strong>Zip: </strong></td><td>{{$contact->zip}}</td></tr>
      @endif
      
      <tr><td><strong>Country: </strong></td><td>{{$contact->country}}</td></tr>
      <tr><td><strong>City: </strong></td><td>{{$contact->city}}</td></tr>
      <tr><td><strong>State: </strong></td><td>{{$contact->state}}</td></tr>
      <tr><td><strong>County: </strong></td><td>{{$contact->county}}</td></tr>
      <tr><td><strong>Primary Office Phone: </strong></td><td>{{$contact->office_phone}}</td></tr>
      <tr><td><strong>Home Phone: </strong></td><td>{{$contact->home_phone}}</td></tr>
      <tr><td><strong>Cellular Phone: </strong></td><td>{{$contact->cellular_phone}}</td></tr>
</table>
</div>
<div class="col-lg-4">

<table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Map of the Location of Employee’s Residence </span></strong></td></tr>
      
      <tr><td><strong>Street name: </strong></td><td>{{$contact->street_name}}</td></tr>
      <tr><td><strong>Main Road: </strong></td><td>{{$contact->main_road}}</td></tr>
      <tr><td><strong>Landmark: </strong></td><td>{{$contact->landmark}}</td></tr>
</table>
</div>

</div>



@stop