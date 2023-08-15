@extends('admin.layouts')

@section('title', 'Edit Major')

@section('content')

    <div class="col-12">


        <form method="POST" id="form-rest">

            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"
                        value="{{ $major->name }}">

                    <div class="form-group">
                        <label for="cover">Choose image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="cover" id="cover">
                                <label class="custom-file-label" for="cover">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="is_active" id="is_active"
                                @if ($major->is_active) checked @endif>
                            <label class="custom-control-label" for="is_active">activate</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick='updateItem({{ $major->id }})' class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script>
        function updateItem(id) {
            let data = new FormData();
            data.append('_method', 'PUT');
            data.append('name', document.getElementById('name').value);
            data.append('is_active', document.getElementById('is_active').checked);
            if (document.getElementById('cover').files[0] != undefined) {
                data.append('cover', document.getElementById('cover').files[0]);
            }

            axios.post("/admin/majors/" + id, data)
                .then(function(response) {
                    window.location.href = "/admin/majors";
                    toastr.success(response.data.message);
                    console.log(response.data);
                }).catch(function(error) {

                    toastr.error(error.response.data.message);
                    console.log(error.response.data);

                })

        }
    </script>
@endsection
