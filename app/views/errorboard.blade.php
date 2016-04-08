@extends('layouts.error')
@section('content')





<br><br>


                    <div class="row">
                      <div class="col-lg-10">

                      @if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif
    
</div>
                      
                    </div>
                  



<div class="row">
  
  <div class="col-lg-12">
    <hr>

  </div>
</div>



  


  


@stop
