@extends('admin.layouts')

@section('title', 'Role Permissions')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">Role permissions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>name</th>
                            <th>guard</th>
                            <th>Assigned</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($permissions as $permission)
                            <tr>
                                <td> {{ $permission->id }} </td>
                                <td> {{ $permission->name }} </td>
                                <td> {{ $permission->guard_name }} </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <form method="POST">
                                            @csrf
                                            <input class="custom-control-input" type="checkbox"
                                                id="permission_{{ $permission->id }}" value="option1"

                                                @if ($permission->assign)
                                                    checked
                                                @endif

                                                >

                                            <label for="permission_{{ $permission->id }}" class="custom-control-label"
                                                onclick="assign({{ $role->id }} , {{ $permission->id }})">Assign</label>
                                        </form>
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
        function assign(role_id, permission_id) {
            let data = new FormData();
            data.append('role_id', role_id);
            data.append('permission_id', permission_id);

            axios.post('/admin/permissions/role', data)
                .then(function(response) {
                    toastr.success(response.data.message);
                    console.log(response.data);
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                    console.log(error.response.data.message);
                })
        }
    </script>
@endsection
