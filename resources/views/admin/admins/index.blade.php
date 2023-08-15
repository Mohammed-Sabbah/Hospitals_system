@extends('admin.layouts')

@section('title', 'Admins')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">admins</h3>
                <a href="{{ route('admins.create') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i></a>
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
                            <th>Email</th>
                            <th>created at</th>
                            <th>updated at</th>
                            <th>actions</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($data as $admin)
                            <tr>
                                <td> {{ $admin->id }} </td>
                                <td> {{ $admin->name }} </td>
                                <td> {{ $admin->email }} </td>
                                <td> {{ $admin->created_at }} </td>
                                <td> {{ $admin->updated_at }} </td>
                                <td>

                                    <div class="btn-group">
                                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-info"><i
                                                class="fas fa-edit" style="width: 14px"></i></a>
                                        <button onclick="deleteItem('/admin/admins/' , this ,{{ $admin->id }})"
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
