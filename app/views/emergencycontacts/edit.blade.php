@extends('layouts.main')
@section('content')
<br/>

<div class="row">
    <div class="col-lg-10">
  <h3>Update Contact</h3>

<hr>
</div>  
</div>


<div class="row">
    <div class="col-lg-10">

    
        
         @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

         <form method="POST" action="{{{ URL::to('EmergencyContacts/update/'.$contact->id) }}}" accept-charset="UTF-8">
   
    <fieldset>

  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact Personal Information</a></li>
    <li role="presentation"><a href="#address" aria-controls="address" role="tab" data-toggle="tab">Contact Home Address</a></li>
    <li role="presentation"><a href="#map" aria-controls="map" role="tab" data-toggle="tab">Map of the Location of Employee’s Residence</a></li>
    
  </ul>

  <div class="tab-content">

    <hr>
    <div role="tabpanel" class="tab-pane active" id="contact">
        <div class="col-lg-5">

        <input class="form-control" placeholder="" type="hidden" readonly name="employee_id" id="employee_id" value="{{ $contact->employee->id }}">

        <div class="form-group">
            <label for="username">Contact Name: <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{ $contact->name }}">
        </div>


        <div class="form-group">
            <label for="username">ID Number:</label>
            <input class="form-control" placeholder="" type="text" name="id_number" id="id_number" value="{{ $contact->id_number }}">
        </div>
        
        <div class="form-group">
            <label for="username">Relationship: </label>
            <input class="form-control" placeholder="" type="text" name="rship" id="rship" value="{{ $contact->relationship }}">
        </div>

        <div class="form-group">
            <label for="username">Telephone Number: </label>
           <input class="form-control" placeholder="" type="text" name="phone1" id="phone1" value="{{ $contact->phone1 }}">
        </div>

        <div class="form-group">
            <label for="username">Phone Number 2:</label>
           <input class="form-control" placeholder="" type="text" name="phone2" id="phone2" value="{{ $contact->phone2 }}">
        </div>
    </div>
      </div>

     
     <div role="tabpanel" class="tab-pane" id="address">


        
        <div class="col-lg-5">


             <div class="checkbox">
                        <label>
                            <input type="checkbox" value="{{ $contact->same_address_employee }}"<?= ($contact->same_address_employee==1)?'checked="checked"':''; ?> name="sel">
                            
                              Same Address as Employee
                        </label>
                    </div>
        
            <div class="form-group">
            <label for="username">Country :</label>
            <input class="form-control" placeholder="" type="text" name="country" id="country" value="{{ $contact->country }}">
            </div>

            <div class="form-group">
            <label for="username">Address 1 :</label>
            <input class="form-control" placeholder="" type="text" name="address1" id="address1" value="{{ $contact->address1 }}">
            </div>

            <div class="form-group">
            <label for="username">Address 2:</label>
            <input class="form-control" placeholder="" type="text" name="address2" id="address2" value="{{ $contact->address2 }}">
            </div>
         
            <div class="form-group">
            <label for="username">City:</label>
            <input class="form-control" placeholder="" type="text" name="city" id="city" value="{{ $contact->city }}">
            </div>

            <div class="form-group">
            <label for="username">State :</label>
            <input class="form-control" placeholder="" type="text" name="state" id="state" value="{{ $contact->state }}">
            </div>

            <div class="form-group">
            <label for="username">Zip/Postal code :</label>
            <input class="form-control" placeholder="" type="text" name="zip" id="zip" value="{{ $contact->zip }}">
            </div>

            <div class="form-group">
            <label for="username">County:</label>
            <input class="form-control" placeholder="" type="text" name="county" id="county" value="{{ $contact->county }}">
            </div>

            <div class="form-group">
            <label for="username">Home Phone:</label>
            <input class="form-control" placeholder="" type="text" name="home_phone" id="home_phone" value="{{ $contact->home_phone }}">
            </div>
 
            <div class="form-group">
            <label for="username">Primary Office Phone:</label>
            <input class="form-control" placeholder="" type="text" name="office_phone" id="office_phone" value="{{ $contact->office_phone }}">
            </div>

            <div class="form-group">
            <label for="username">Cellular Phone:</label>
            <input class="form-control" placeholder="" type="text" name="cellular_phone" id="cellular_phone" value="{{ $contact->cellular_phone }}">
            </div>
           </div>

        </div>
     
     <div role="tabpanel" class="tab-pane" id="map">


        
        <div class="col-lg-5">


            <div class="form-group">
            <label for="username">Street Name: </label>
            <input class="form-control" placeholder="" type="text" name="street" id="street" value="{{ $contact->street_name }}">
            </div>

            <div class="form-group">
            <label for="username">Main Road :</label>
            <input class="form-control" placeholder="" type="text" name="main_road" id="main_road" value="{{ $contact->main_road }}">
            </div>

            <div class="form-group">
            <label for="username">Outstanding Landmark which would help in location:</label>
            <input class="form-control" placeholder="" type="text" name="landmark" id="landmark" value="{{ $contact->landmark }}">
            </div>


      <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Contact</button>
        </div>
           
        </div>

        </div>


    </div>

    </fieldset>
</form>
        

  </div>

</div>





@stop