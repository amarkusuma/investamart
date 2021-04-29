@extends('template')

@section('content')
<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Create Anggota Komda</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-secondary" href="{{ route('anggota-komda') }}"> Back</a>
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

<form action="{{ route('anggota-komda.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-6">
            <div class="row">
                {{-- <div  class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"><strong>User:</strong></label>
                        <select class="form-control" id="exampleFormControlSelect1" name="user_id" required>
                            <option selected value="">Select User</option>
                            @foreach ($user as $data)
                             <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
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
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
