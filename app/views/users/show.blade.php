<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

@extends('layouts.system')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>{{$user->username}}</h3>

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
  <br>

<table class="table table-bordered">

<tr>
  <td>Username</td><td>{{$user->username}}</td>
</tr>
<tr>
  <td>Email</td><td>{{$user->email}}</td>
</tr>
<tr>
  <td>Status</td>
  <td>@if($user->confirmed) Confirmed @else Not Confirmed @endif</td>
</tr>

<tr>
  <td>Created on</td><td>{{$user->created_at}}</td>
</tr>
<tr>
  <td>Roles</td>
  <td>
  <ul>
    @foreach($user->roles as $role)

    <li>{{$role->name}}</li>
    @endforeach
    </ul>
  </td>
</tr>
  
</table>

    

    


</div>
</div>


@stop