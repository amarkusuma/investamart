@extends('template')

@section('content')
<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Create User Komda</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-secondary" href="{{ route('pengurus-komda') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('pengurus-komda.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-6">
            <div class="row">
                <div  class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"><strong>User:</strong></label>
                        <select class="form-control" id="exampleFormControlSelect1" name="user_id" required>
                            <option selected value="">Select User</option>
                            @foreach ($user as $data)
                             <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div  class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"><strong>Komda:</strong></label>
                        <select class="form-control" id="exampleFormControlSelect1" name="komda_id" required>
                            <option selected value="">Select Komda</option>
                            @foreach ($komda as $data)
                             <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jabatan:</strong>
                        <input type="text" name="jabatan" class="form-control" placeholder="jabatan">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
