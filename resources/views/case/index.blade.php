@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="panel panel-heading">All Registered Cases({{ $cases->count() }})
<form action="/cases" method="GET">
    <span>From:<input type="date" name="from" value="{{ old('from') }}">
    </span>&nbsp;To:<span><input type="date" name="to" value="{{ old('to') }}"></span>
    <span>District:

<select name="district">
    <option value="">choose district</option>

  @foreach(\App\Models\District::all() as $district)
  <option value="{{ $district->id }}">{{ $district->name }}</option>
  @endforeach
  </select>
 </span>
    <span>&nbsp;Gender:<select name="gender" style="height: 29px;"><option value="">-Select-</option>
    <option value="female">Female</option><option value="male">Male</option></select>
      &nbsp;<button type="submit" class="btn btn-success btn-sm">Search</button></span>
</form>
</div>
@if(!empty(Request::get('from'))||!empty(Request::get('to'))||!empty(Request::get('district')) && $cases->count() )
<div class="panel panel-heading"><b>{{ Session::get('countTotalRecords') }}</b>&nbsp;records found</div>
<div class="panel panel-heading">
      <a href="{{ route('download','xls') }}">
        <button class="btn btn-default btn-sm ">export xls</button>
      </a>
      <a href="{{ route('download','xlsx') }}">
        <button class="btn btn-default btn-sm ">export xlsx</button>
      </a>
      <a href="{{ route('download','csv') }}">
        <button class="btn btn-default btn-sm ">export CSV</button>
      </a>
      <a href="{{ route('download','pdf') }}">
        <button class="btn btn-default btn-sm ">export pdf</button>
      </a>
      <a href="{{ url('cases/search/download') }}">Download PDF</a>
            <a href="{{ url('cases/search/view') }}">view PDF</a>
</div>
@endif

<div  class="panel panel-body">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Token</th>
        <th>Full name</th>
        <th>Email</th>
        <th>Address</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>

      @if($cases->count())

        @foreach($cases as $case)
        <tr>
          <td>{{ $case->token }}</td>
        {{--   <td><img src="{{ Storage::url($case->image) }}" width="100"></td> --}}
          <td>{{ $case->full_name }}</td>
          <td>{{ $case->email }}</td>
          <td>{{ $case->district->name }}</td>
          <td><a href="{{ route('cases.show',[$case->id]) }}">Browse</a></td>
        </tr>
        @endforeach
      
      @else
        <td><b>No record found.</b></td>
      @endif
    </tbody>
  </table>


     {{--  {{ $cases->links() }} --}}
     
     {!! $cases->appends(Request::only(['from'=>'from', 'to'=>'to','district'=>'district']))->render() !!}

</div>


    </div>
  </div>
</div>
@endsection


@section('script')
 
@endsection