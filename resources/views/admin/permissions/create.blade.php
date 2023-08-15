@extends('admin.layouts')

@section('title', 'New Permission')

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


        <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="card-body">

                <div class="form-group" data-select2-id="68">
                    <label>Select guard_name</label>
                    <select class="form-control select2bs4 select2-hidden-accessible" name="guard_name" id="hospital_id"
                        style="width: 100%;" data-select2-id="16" tabindex="-1" aria-hidden="true">

                        <option value="admin">Admin</option>
                        <option value="web">Web</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Enter Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                        placeholder="Enter Name" value="{{ old('name') }}">
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
    $('.select2bs4').select2({
        majors: true,
        theme: 'bootstrap4'
    })
</script>
@endsection

