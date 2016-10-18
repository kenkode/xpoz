@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>Update Store</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('locations/update/'.$location->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Store name <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{$location->name}}">
        </div>


        <div class="form-group">
            <label for="username">Description <span style="color:red">*</span> :</label>
            <textarea name="description" class="form-control">{{$location->description}}</textarea>
        </div>

        

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop