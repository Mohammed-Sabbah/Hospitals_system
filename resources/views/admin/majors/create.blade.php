@extends('admin.layouts')

@section('title', 'New Major')

@section('content')

    <div class="col-12">


        <form method="POST" id="form-rest">

            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"
                        value="{{ old('name') }}">
                </div>

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
                        <input type="checkbox" class="custom-control-input" name="is_active" id="customSwitch1" checked>
                        <label class="custom-control-label" for="customSwitch1">activate</label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="storeItem('/admin/majors')" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function storeItem(url) {
            let data = new FormData();
            data.append('name', document.getElementById('name').value);
            data.append( 'is_active' , document.getElementById('customSwitch1').checked);

            if (document.getElementById('cover').files[0] != undefined) {
                data.append('cover', document.getElementById('cover').files[0]);
            }

            axios.post(url, data)
                .then(function(response) {
                    toastr.success(response.data.message);
                    console.log(response.data);
                    document.getElementById('form-rest').reset();
                    // window.location.href = '/admin/majors';
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                    console.log(error.response.data);
                })
        }
    </script>
@endsection
