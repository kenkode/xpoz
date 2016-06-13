@extends('layouts.erp')
@section('content')
<br><br/>
<div class="row">
                      

    <div class="col-lg-12">

      <h4>Inventory Reports</h4>

    </div>                 


                       

                      
                    </div>



<hr>
<div class="row">
              						
<div class="col-lg-2"></div>
	<div class="col-lg-5">

@if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif
		
    <form method="POST" action="{{{ URL::to('invreports') }}}" accept-charset="UTF-8">

           <div class="form-group">
            <label for="username">Report <span style="color:red">*</span> :</label>
            <select name="report_type" class="form-control" required id="report_type">
               <option value="checkout">Checkout report</option>
               <option value="checkin">Checkin report</option>
               <option value="booking">Bookings report</option>
               <option value="maintenance">Maintenance report</option>
               <option value="item_list">Item List report</option>
               <option value="store_list">Store report</option>
            </select>
        </div>



         <div class="form-group" id="item" class="item">
            <label for="username">Item <span style="color:red">*</span> :</label>
            <select name="report_type" class="form-control">
               <option value="all">All</option>
               @foreach($items as $item)
               <option value="{{$item->id}}">{{$item->name}}</option>
               @endforeach
              
            </select>
        </div>



         <div class="form-group" id="store" class="store">
            <label for="username">Store <span style="color:red">*</span> :</label>
            <select name="report_type" class="form-control">
               <option value="all">All</option>
               @foreach($stores as $store)
               <option value="{{$store->id}}">{{$store->name}}</option>
               @endforeach
              
            </select>
        </div>


         <div class="form-group" id="start_date">
                        <label for="username">Start Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker21"  readonly="readonly" placeholder="" type="text" name="start_date"  >
                        </div>
          </div>


           <div class="form-group" id="end_date">
                        <label for="username">End Date</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker21"  readonly="readonly" placeholder="" type="text" name="end_date"  >
                        </div>
          </div>


         

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">View Report</button>
        </div>


    </form>
		
    
	</div>


</div>


<script type="text/javascript">


  $(document).ready(function(){

    $('#store').hide();
    $('#item').hide();
    $('#start_date').hide();
    $('#end_date').hide();


    $('#report_type').change(function(){


       

        if($("#report_type").val() == 'item_list'){

           $('#item').show();
           $('#start_date').show();
           $('#end_date').show();
        }


        if($("#report_type").val() == 'store_list'){

           $('#store').show();
           $('#start_date').show();
           $('#end_date').show();
        }


    });


  });

</script>

@stop