

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
@extends('layouts.sidebar')

@section('content')
<div class="container" id="edittccontainer">
  <div class="col-md-3">
     @include('includes.tdsidebar')
  </div>
  <div class="col-md-9">
        @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}<button type="button" class="close" data-dismiss="alert">×</button></em></div>
        @endif
    <table>
      <form action="/viewtcupdate" method="post" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id" value="{{$training_centres[0]->id}}">
      <input type="hidden" name="centreid" value="{{$training_centres[0]->centre_id}}">
      <tr>
          <td colspan="4">
            <center><label for="usr">&nbsp</label></center>  
            <center><label for="usr">&nbsp</label></center>  
            <center><h1 for="usr" style="color: #b30000">Update Training Centre</h1></center>  
              
          </td>
             
        </tr> 
      <tr>
          <td colspan="3">
              <label for="usr">Training centre name </label>
              <input type="text" class="form-control" id="usr" name="centre_name" required value="{{$training_centres[0]->centre_name}}">
          </td>
          <td><p class="star1">&nbsp*</p></td>    
        </tr> 
        <tr>
          <td>     
              <label for="sel1">Owner name </label>
              <input type="text" class="form-control" id="sel1" name="name" required value="{{$training_centres[0]->name}}">
          </td><td><p class="star">&nbsp*&nbsp&nbsp</p></td>
          <td >
              <label for="usr">Upload Picture</label>
              <input type="file" class="form-control" id="usr">
          </td><td>&nbsp</td>
        </tr>
        <tr>
          <td>
              <label for="usr">Street</label>
              <input type="text" class="form-control" id="usr" name="street" placeholder="Bulding No,Street,PO,TK" required value="{{$training_centres[0]->street}}">
          </td><td><p class="star">*</p></td>
          <td>   
              <label for="usr">District</label>
              <select class="form-control" id="sel1" name="district" required>
              <option value="" disabled selected>{{$training_centres[0]->district}}</option>
              @foreach($districts as $itr)
              <option>{{ $itr->district_name }}</option>
              @endforeach
              </select>
          </td><td><p class="star1">*</p></td>
        </tr>
         <tr>
          <td>    
              <label for="usr">State</label>
              <select class="form-control" id="sel1" name="state" required>
              <option value="" disabled selected>{{$training_centres[0]->state}}</option>
              @foreach($states as $itr)
              <option>{{ $itr->state_names }}</option>
              @endforeach
              </select><td><p class="star">*</p></td>
         </td>
         <td>      
              <label for="usr">PIN</label>
              <input type="number" class="form-control" id="usr" name="pin" required value="{{$training_centres[0]->pin_code}}">
         </td><td><p class="star1">*</p></td>
       </tr>
       <tr>
         <td>
              <label for="usr">Email ID</label>
              <input type="email" class="form-control" id="usr" name="email" required value="{{$training_centres[0]->email}}">
         </td><td><p class="star">*</p></td>
         <td>  
              <label for="usr">Moblie number</label>
              <input type="number" class="form-control" id="usr"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"maxlength = "10" name="mobile" required value="{{$training_centres[0]->mobile_number}}">
         </td><td><p class="star1">*</p></td>
        </tr>
        <tr>
          <td>
              <label for="usr">Landline Number</label>
              <input type="text" class="form-control" id="usr" name="landline"  value="{{$training_centres[0]->landline}}">
          </td><td>&nbsp</td>
          <td >   
              <label for="usr">Website ID</label>
              <input type="text" class="form-control" id="usr" name="websiteid" value="{{$training_centres[0]->website_id}}">
          </td><td>&nbsp</td>
        </tr>

         <tr>
          <td>         
              <label for="usr">PAN Card</label>
              <input type="text" class="form-control" id="usr" name="pancard" required value="{{$training_centres[0]->pan_card}}">
          </td><td><p class="star">*</p></td>
          <td >    
              <label for="usr">PAN Card image upload..</label>
              <input type="file" class="form-control" id="usr">
          </td><td>&nbsp</td>
        </tr>
        <tr>
          <td>   
              <label for="usr">GST</label>
              <input type="text" class="form-control" id="usr" name="gst" required value="{{$training_centres[0]->gst}}">
          </td><td><p class="star">*</p></td>
          <td>   
              <label for="usr">GST image upload..</label>
              <input type="file" class="form-control" id="usr">
          </td><td>&nbsp</td>
        </tr>
        <tr>
          <td>           
              <label for="usr">Training centre started on</label>
              <input type="date" class="form-control" id="usr" name="trainingstart" required value="{{$training_centres[0]->training_start}}">
          </td><td><p class="star">*</p></td>
          <td>      
              <label for="usr">Aadhar Card</label>
              <input type="text" class="form-control" id="usr" name="adhar" required value="{{$training_centres[0]->adhar_card}}">
          </td><td><p class="star1">*</p></td>     
        </tr>
        <tr>
          <td>
              <label for="usr">Aadhar card image upload</label>
              <input type="file" class="form-control" id="usr">
          </td><td>&nbsp</td>
          <td>     
              <label for="usr">Type of centre</label>
              <select class="form-control" id="sel1" name="centre" required>
              <option value="" disabled selected>{{$training_centres[0]->centre_type}}</option>
              @foreach($types_of_centres as $itr)
              <option>{{ $itr->types }}</option>
              @endforeach
              </select>
          </td><td><p class="star1">*</p></td>
        </tr>
        <tr>
          <td>        
              <label for="usr">Training subject</label>
              <select class="form-control" id="sel1" name="training">
              <option value="" disabled selected>{{$training_centres[0]->training}}</option>
              @foreach($training_centre_subjects as $itr)
              <option>{{ $itr->subjects }}</option>
              @endforeach  
              </select>               
          </td><td><p class="star">*</p></td>
         <td>     
              <label for="usr">&nbsp</label>
              <input align="right" type="submit" class="btn btn-primary btn-block" id="usr" value="Update">
          </td><td>&nbsp</td>
        </tr>  
        <tr>
          <td colspan="4">
            <center><label for="usr">&nbsp</label></center>  
            <center><label for="usr">&nbsp</label></center>  
            <center><label for="usr">&nbsp</label></center>    
          </td>
             
        </tr>  

      </form>
    </table>
  </div>
</div>

@stop










<!-- center name
<input type="text" name="" value="{{$training_centres[0]->centre_name}}"><br>
owner name
<input type="text" name="" value="{{$training_centres[0]->name}}"><br>
upload picture
<input type="file" name="" value="{{$training_centres[0]->upload_pic}}"><br>
street
<input type="text" name="" value="{{$training_centres[0]->street}}"><br>



district
<select>
@foreach($districts as $itr)
<option>{{ $itr->district_name }}</option>
@endforeach
</select><br>
state
<select>
@foreach($states as $itr)
<option>{{ $itr->state_names }}</option>
@endforeach
</select><br>




pin code
<input type="text" name="" value="{{$training_centres[0]->pin_code}}"><br>
email
<input type="email" name="" value="{{$training_centres[0]->email}}"><br>
mobile number
<input type="number" name="" value="{{$training_centres[0]->mobile_number}}"><br>
landline
<input type="number" name="" value="{{$training_centres[0]->landline}}"><br>
website id
<input type="text" name="" value="{{$training_centres[0]->website_id}}"><br>
pan card
<input type="text" name="" value="{{$training_centres[0]->pan_card}}"><br>
pan card image
<input type="file" name="" value="{{$training_centres[0]->pan_card_image}}"><br>
gst
<input type="text" name="" value="{{$training_centres[0]->gst}}"><br>
gst image
<input type="file" name="" value="{{$training_centres[0]->gst_image}}"><br>
training centre start on
<input type="date" name="" value="{{$training_centres[0]->training_start}}"><br>
adhar card
<input type="text" name="" value="{{$training_centres[0]->adhar_card}}"><br>
athsr card image
<input type="file" name="" value="{{$training_centres[0]->adhar_card_image}}"><br>



center type 
<select>
@foreach($types_of_centres as $itr)
<option>{{ $itr->types }}</option>
@endforeach
</select><br>
training subject  
<select>
@foreach($training_centre_subjects as $itr)
<option>{{ $itr->subjects }}</option>
@endforeach  
</select>


status
<input type="text" name="" value="{{$training_centres[0]->centre_status}}"><br>

 -->