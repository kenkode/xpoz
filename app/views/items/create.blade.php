@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Item</h3>

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

		 <form method="POST" action="{{{ URL::to('items') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Item Name <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
        </div>

         <div class="form-group">
            <label for="username">Description:</label>
            <textarea rows="5" class="form-control" name="description" id="description" >{{ Input::old('email_office') }}</textarea>
        </div>

    
            <input class="form-control" placeholder="" type="hidden" name="pprice" id="pprice" value="0">
        

        <div class="form-group">
            <label for="username">Price Rate <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="sprice" id="sprice" value="{{{ Input::old('sprice') }}}">
        </div>


        <div class="form-group">
            <label for="username">Duration<span style="color:red">*</span> :</label>
            <select name="duration" class="form-control">
                <option value="hour">Per Hour</option>
                <option value="day">Per Day</option>
            </select>
        </div>

          <div class="form-group">
            <label for="username">Category <span style="color:red">*</span> :</label>
            <select name="category" class="form-control" required>

                @foreach($itemcategories as $category)
                <option value="{{$category->name}}">{{$category->name}}</option>
                @endforeach
                
            </select>
            
        </div>


        <div class="form-group">
            <label for="username">Store Keeping Unit:</label>
            <input class="form-control" placeholder="" type="text" name="sku" id="sku" value="{{{ Input::old('sku') }}}">
        </div>

        <div class="form-group">
            <label for="username">Tag Id:</label>
            <input class="form-control" placeholder="" type="text" name="tag" id="tag" value="{{{ Input::old('tag') }}}">
        </div>
        
         <div class="form-group">
            <label for="username">Store <span style="color:red">*</span> :</label>
            <select name="location_id" class="form-control" required>

                @foreach($locations as $location)
                <option value="{{$location->id}}">{{$location->name}}</option>
                @endforeach
                
            </select>
            
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Item</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop