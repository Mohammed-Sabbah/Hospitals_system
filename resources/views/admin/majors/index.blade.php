@extends('admin.layouts')

@section('title' , 'Majors')

@section('content')

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title mt-2">Majors</h3>
        <a href="{{ route('majors.create') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i></a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>name</th>
              <th>Activation</th>
              <th>Image</th>
              <th>created at</th>
              <th>updated at</th>
              <th>actions</th>

            </tr>
          </thead>
          <tbody>


            @foreach ($data as $major )
            <tr>
                <td> {{ $major->id }} </td>
                <td> {{ $major->name }} </td>
                <td> {{ $major->is_active ? 'active' : 'not active' }} </td>
                <td> <img src="{{ Storage::url('majors/'.$major->cover) }}" alt="major image" width="53" height="53"> </td>
                <td> {{ $major->created_at }} </td>
                <td> {{ $major->updated_at }} </td>
                <td>

                    <div class="btn-group">
                        <a href="{{route('majors.edit' , $major->id )}}" class="btn btn-info"><i class="fas fa-edit" style="width: 14px"></i></a>
                        <button onclick="deleteItem('/admin/majors/' , this ,{{$major->id}})" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </div>

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

@section('js')
<script>
    function deleteItem(url , ref , id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {

            axios.delete(url+id)
            .then(function(response){
                showMessage(response.data);
                ref.closest('tr').remove();
            }).catch(function(error){
                showMessage(error.response.data);
            })
        }
        })
    }

    function showMessage(data){
        Swal.fire({
                icon: data.icon,
                title: data.message,
                showConfirmButton: false,
                timer: 1500
                })
    }
</script>
@endsection
