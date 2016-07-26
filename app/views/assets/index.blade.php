@extends('layouts.erp')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Assets</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">
   

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('assets/create')}}">new asset</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success btn-sm" href="{{ URL::to('asset/import')}}">import asset</a>
        </div>
        <div class="panel-body">


    <table id="users" style="font-size:12px;" class="table table-condensed table-bordered table-responsive table-hover">

    <thead>
      <th>#</th>
      <th>Name</th>
      <th>Date Purchased</th>
      <th>Quantity</th>
      <th>Cost</th>
      <th>Serial Number</th>
      <th>Expected Life Years</th>
      <th>Depreciation Policy</th>
      <th></th>


    </thead>

    <tbody>
<?php $i = 1; ?>
    @foreach($assets as $asset)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$asset->name}}</td>
         <td>{{$asset->purchase_date}}</td>
         <td>{{$asset->quantity}}</td>
         <td>{{number_format($asset->cost,2)}}</td>
         
         <td>{{$asset->serial_number}}</td>
         <td>{{$asset->life_years}}</td>
          <td>{{$asset->dep_policy}}</td>
          <td>

           <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                  <li><a href="{{URL::to('assets/show/'.$asset->id)}}">View</a></li>
                    <li><a href="{{URL::to('assets/edit/'.$asset->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('assets/delete/'.$asset->id)}}">Delete</a></li>
                     
                    
                  </ul>
              </div>

            
          </td>
      </tr>
    @endforeach
    </tbody>
     

    </table>
  </div>


  </div>

</div>

@stop