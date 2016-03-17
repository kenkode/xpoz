@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4> Event: {{Session::get('booking')['event']}}  &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Client: {{Client::getClientName(Session::get('booking')['client_id'])}}  &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Start Date: {{Session::get('booking')['start_date']}} |&nbsp;&nbsp;&nbsp;&nbsp; End Date: {{Session::get('booking')['end_date']}} </h4>

<hr>
</div>	
</div>


<br><div class="row">
    
  <form class="form-inline" method="post" action="{{URL::to('bookings/additems')}}">
      <div class="col-lg-12">

        <div class="form-group ">
            <label>Item</label>
            <select name="item" class="form-control" required >
            
                @foreach($items as $item)
                
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    
                @endforeach
            </select>
        </div>


        <div class="form-group ">
            
            <input type="submit"  class="btn btn-primary" value="Book Item">
        </div>


      </div> 


  </form>



</div>


<div class="row">
	<div class="col-lg-12">

    <hr>
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

    <table class="table table-condensed table-bordered" id="users">

    <thead>
        <th>Item</th>
       
        <th></th>
    </thead>

    <tbody>

   
        <?php $total = 0; ?>
        @foreach($bookingitems as $bookingitem)

            
        <tr>
            <td>{{Item::getItemName($bookingitem['item'])}}</td>
            
            <td>
                
                <a href="{{URL::to('bookingitems/remove/'.$bookingitem['item'])}}">X</a>
                

            </td>
        </tr>

        @endforeach

        

        
    </tbody>
        
    </table>
		

  </div>

</div>


<div class="row">
    <div class="col-lg-12">

    <hr>

    <a href="{{URL::to('bookingscommit')}}" class="btn btn-primary pull-right">Create</a>
    </div>
</div>

@stop