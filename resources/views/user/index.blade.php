@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>User Komda CRUD</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('user-komda.create') }}"> Create User Komda</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th width="20px" class="text-center">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th width="280px"class="text-center">Action</th>
        </tr>
        <?php $no = 1 ?>
        @foreach ($users as $user)
        <tr>
            <td class="text-center">{{ $no ++ }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-center">
                {{-- <form action="{{ route('users.destroy',$user->id) }}" method="user">

                    <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>

                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                </form> --}}
            </td>
        </tr>
        @endforeach
    </table>

    {!! $users->links() !!}

@endsection
