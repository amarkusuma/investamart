@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Komda CRUD</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('komda.create') }}"> Create komda</a>
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
            <th>Deskripsi</th>
            <th width="280px"class="text-center">Action</th>
        </tr>
        <?php $no = 1 ?>
        @foreach ($komda as $data)
        <tr>
            <td class="text-center">{{ $no ++ }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->deskripsi }}</td>
            <td class="text-center">
                <form action="{{ route('komda.destroy',$data->id) }}" method="komda">

                    {{-- <a class="btn btn-info btn-sm" href="{{ route('komda.show',$data->id) }}">Show</a> --}}

                    <a class="btn btn-primary btn-sm" href="{{ route('komda.edit',$data->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $komda->links() !!}

@endsection
