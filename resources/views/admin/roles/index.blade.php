@extends('admin.layouts')

@section('title', 'Roles')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">roles</h3>
                <a href="{{ route('roles.create') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        <h6>{{ session()->get('message') }}</h6>
                    </div>
                @endif


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>name</th>
                            <th>guard</th>
                            <th>Role Permissions</th>
                            <th>created at</th>
                            <th>updated at</th>
                            <th>actions</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($data as $role)
                            <tr>
                                <td> {{ $role->id }} </td>
                                <td> {{ $role->name }} </td>
                                <td> {{ $role->guard_name }} </td>
                                <td> <a  class="btn btn-warning pr-4 pl-4" href="{{route('role.show' , $role->id)}}">permissions ({{$role->permissions ? count($role->permissions) :'0'}})</a> </td>
                                <td> {{ $role->created_at }} </td>
                                <td> {{ $role->updated_at }} </td>
                                <td>

                                    <div class="btn-group">
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info"><i
                                                class="fas fa-edit" style="width: 14px"></i></a>
                                        <button onclick="deleteItem('/admin/roles/' , this ,{{ $role->id }})"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
        function deleteItem(url, ref, id) {
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

                    axios.delete(url + id)
                        .then(function(response) {
                            showMessage(response.data);
                            ref.closest('tr').remove();
                        }).catch(function(error) {
                            showMessage(error.response.data);
                        })
                }
            })
        }

        function showMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.message,
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>
@endsection
