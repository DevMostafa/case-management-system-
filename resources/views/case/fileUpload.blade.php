@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload supporting files for case #{{ $id }}<a href="/cases/{{  $id }}" class="pull-right">
                       Go Back
                    </a></div>

                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('case.file.store',[$id]) }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
                        <input type="file" name="caseFile[]" class="">
                        <input type="file" name="caseFile[]" class="">
                        <input type="file" name="caseFile[]" class="">
                        <br>
                        <textarea name="description" class="form-control"></textarea>
                        <br><button type="submit" class="btn btn-success ">Upload Supporting File</button>
                    
                    </form>
                    

 @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection













