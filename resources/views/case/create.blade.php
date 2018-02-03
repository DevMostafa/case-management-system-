@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ route('cases.store') }}" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">

        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">Register Case</div>
                <div class="panel-body">
                    

                  
  <div class="form-row">

    <div class="form-group col-md-6 {{ $errors->has('full_name') ? ' has-error' : '' }}">
      <label for="inputEmail4">Fullname</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Fullname" name="full_name">

        @if ($errors->has('full_name'))
            <span class="help-block">
                <strong>{{ $errors->first('full_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="text" name="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Phone</label>
      <input type="text" name="phone" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group col-md-6 ">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Incident place</label>
    <input type="text" name="incident_place" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">District</label>
      <select name="district_id" id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option value="1">Jhapa</option>
        <option value="2">Ktm</option>
        <option value="3">Pokhara</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Time</label>
      <input name="incident_time" type="text" class="form-control" id="" value="3pm">
     <input type="hidden" name="token" >

    </div>
  </div>

  <button type="submit" class="btn btn-primary pull-right">Submit</button>

         </div>
            </div>
        </div>

        <div class="col-md-3" >
            <div class="panel panel-default" style="min-height: 150px;">
                <div class="panel-heading">Image</div>

                <div class="panel-body">
                    <input type="file" name="image" class="form-control">
                    <hr/>
                    <small><center>Only <b>png,jpeg,jpg</b>&nbsp;are allowed</center></small>
                </div>
            </div>
        </div>
  

    </div>

    </form>

</div>
@endsection


