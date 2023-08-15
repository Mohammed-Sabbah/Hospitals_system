@extends('admin.layouts')

@section('title' , 'Hospitals')

@section('content')

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title mt-2">Hospitals</h3>
        <a href="{{ route('hospital.create') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i></a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                <h6>{{session()->get('message')}}</h6>
            </div>
        @endif


        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>name</th>
              <th>location</th>
              <th>Activation</th>
              <th>Image</th>
              <th>info</th>
              <th>created at</th>
              <th>updated at</th>
              <th>actions</th>

            </tr>
          </thead>
          <tbody>


            @foreach ($data as $hospital )
            <tr>
                <td> {{ $hospital->id }} </td>
                <td> {{ $hospital->name }} </td>
                <td> {{ $hospital->location }} </td>
                <td> <span class="badge {{$hospital->is_active ? 'bg-success' : 'bg-danger'}}">
                    {{ $hospital->active_status}}</span> </td>
                <td> <img src="{{ Storage::url('hospitals/'.$hospital->cover) }}" alt="hospital image" width="53" height="53"> </td>
                <td> {{ $hospital->info }} </td>
                <td> {{ $hospital->created_at }} </td>
                <td> {{ $hospital->updated_at }} </td>
                <td>
                    <form action="{{route('hospital.destroy' , $hospital->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <div class="btn-group">
                            <a href="{{route('hospital.edit' , $hospital->id )}}" class="btn btn-info"><i class="fas fa-edit" style="width: 14px"></i></a>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach


          </tbody>
        </table>
      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->
  </div>

@endsection
