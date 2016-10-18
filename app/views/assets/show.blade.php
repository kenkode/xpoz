@extends('layouts.erp')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Fixed Asset</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		<table class="table table-bordered table-responsive table-condensed table-condeensed">

               <tr>
                   <td>Asset Name</td><td>{{$asset->name}}</td>
               </tr>
               
                <tr>
                   <td>Date Purchased</td><td>{{$asset->purchase_date}}</td>
               </tr>

               <tr>
                   <td>Quantity</td><td>{{$asset->quantity}}</td>
               </tr>

                <tr>
                   <td>Purchase Cost</td><td>{{number_format($asset->cost,2)}}</td>
               </tr>

               <tr>
                   <td>Total Amount</td><td>{{number_format($asset->cost * $asset->quantity,2)}}</td>
               </tr>

               <tr>
                   <td>Asset Type</td><td>{{$asset->asset_type}}</td>
               </tr>

               <tr>
                   <td>Supplier</td><td>{{$asset->supplier}}</td>
               </tr>

                <tr>
                   <td>Serial Number</td><td>{{$asset->serial_number}}</td>
               </tr>

                <tr>
                   <td>Expected Life Years </td><td>{{$asset->life_years}}</td>
               </tr>

                <tr>
                   <td>Depreciation Policy</td><td>{{$asset->depreciation_policy}}</td>
               </tr>

                <tr>
                   <td>Accumulated Depreciation</td><td>{{$asset->accumulated_dep_amount}}</td>
               </tr>
                
            
        </table>
		

  </div>

</div>
























@stop