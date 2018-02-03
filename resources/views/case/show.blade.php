@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-heading" style="height: 47px;">
            <a href="{{ route('supporting-files',[$case->id]) }}">
              <button class="panel panel-default"> upload file</button>
            </a>
        </div>
            <div class="panel panel-default">
                <div class="panel-heading">General Information</div>

                <div class="panel-body">
                    <table class="table table-bordered table-dark">
                      <thead>
                        <tr>
                          <th scope="col">#Token</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">email</th>
                          <th scope="col">phone</th>
                          <th scope="col">incide P</th>
                          <th scope="col">Time</th>
                          <th scope="col">District</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>{{ $case->full_name }}</td>
                          <td>{{ $case->email }}</td>
                          <td>{{ $case->phone }}</td>
                          <td>{{ $case->incident_place }}</td>
                          <td>{{ $case->incident_time }}</td>
                          <td>{{ $case->district }}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                 <div class="panel panel-default">
                <div class="panel panel-heading">Service</div>
                    <!--servie-->
                <div class="panel panel-body">
                    <table class="table table-bordered table-dark">
                      <thead>

                        <tr>
                          <th scope="col">Service Type</th>
                          <th scope="col">Description</th>
                          </tr>
                      </thead>
                      <tbody>
                        @if($case->serviceGiveToThisId())
                        <tr>
                          <td>{{ $case->service->service_name }}</td>
                          <td>{{ $case->service->description }}</td>
                        </tr>
                        @else
                        <p>Service is not added</p>
                        @endif
                      </tbody>
                    </table>
                </div>
                <!--end-->
            </div>

            <!--follow up-->
            <div class="panel panel-default">
                <div class="panel panel-heading">Follow Up</div>
                    <!--servie-->
                <div class="panel panel-body">
                    <table class="table table-bordered table-dark">
                      <thead>

                        <tr>
                          <th scope="col">Assigned To</th>
                          <th scope="col">Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($case->followUPExistsForCase())
                        <tr>
                          <td>{{ $case->followUP->user->name }}</td>
                     
                          <td>{{ $case->followUP->description }}</td>
                        </tr>
                        @else
                        <p>This case is not assigned yet!</p>
                        @endif
                      </tbody>
                    </table>
                </div>

                <!--end-->
            </div>

            <!--end-->
          <div class="panel panel-body">
            @if(!$case->serviceGiveToThisId())
              <a href="#" data-toggle="modal" data-target="#exampleModal">Add Service</a>&nbsp;
            @else
                <a href="#" data-toggle="modal" data-target="#exampleModalServiceEdit">Edit Service</a>&nbsp;
            @endif    
             @if($case->followUPExistsForCase())
              <a href="#" data-toggle="modal" data-target="#exampleModalEditFollowUp" class="pull-right">Edit FollowUp</a>
              @else
              <a href="#" data-toggle="modal" data-target="#exampleModalAddFollowUp">Add FollowUp</a>&nbsp;
            @endif 
            </div>

        </div>
    </div>
</div>

<div class="panel panel-default">
  <div class="panel panel-heading">Supporting Files</div>
  <div class="panel panel-body">
    @foreach($case->casefile as $file)
      <p>
        @foreach($file->fileDescription()->groupBy('case_descriptions.description')->get() as $desc)

              {{ $desc->description }}

        @endforeach

        <a href="">{{ $file->file_name }}
        <img src="{{Storage::url($file->file_path)}}">
        </a>
      </p>
    @endforeach
  </div>
</div>

<!--Add service model-->
@include('case.service.create')
<!--end-->
<!--Edit service model-->
@include('case.service.edit')
<!--edit service model end-->

<!--follow up Add model-->
@include('case.followup.create')
<!--follow up add  end-->

<!--Edit Follow up  model-->
@include('case.followup.edit')

<!--Edit Follow up end-->

@endsection



