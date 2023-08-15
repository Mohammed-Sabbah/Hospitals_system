@extends('admin.layouts')

@section('title', 'Edit Admin')

@section('content')

    <div class="col-12">

        @if ($errors->any())

            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Errors!</h5>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </div>

        @endif


        <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group" data-select2-id="28">
                    <label>Select Role</label>
                    <select class="select2 select2-hidden-accessible" name="roles[]" multiple=""
                        data-placeholder="Select a State" style="width: 100%;" data-select2-id="6" tabindex="-1"
                        aria-hidden="true">

                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"

                                @if ($admin->hasRole($role))
                                    selected
                                @endif
                                >{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Enter Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                        placeholder="Enter Name" value="{{ $admin->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputPassword1"
                        placeholder="Email" value="{{ $admin->email}}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script>
        //Initialize Select2 Elements
        $('.select2').select2({
            majors: true,
            tokenSeparators: [',', ' '],
            theme: 'bootstrap4'
        })
    </script>
@endsection
