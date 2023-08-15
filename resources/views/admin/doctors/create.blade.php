@extends('admin.layouts')

@section('title', 'New Doctor')

@section('content')

    <div class="col-12">


        <form method="POST" id="form-rest">

            @csrf




            <div class="card-body">

                <div class="form-group" data-select2-id="68">
                    <label>Select Hospital</label>
                    <select class="form-control select2bs4 select2-hidden-accessible" name="hospital_id" id="hospital_id"
                        style="width: 100%;" data-select2-id="16" tabindex="-1" aria-hidden="true">
                        @foreach ($hospitals as $hospital)
                            <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"
                        value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Enter Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email"
                        value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="phone">Enter Phone</label>
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Phone"
                        value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label>Descrption</label>
                    <textarea class="form-control" name="descrption" id="descrption" rows="3" placeholder="Enter descrption ...">{{ old('descrption') }}</textarea>
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
                {{-- <div class="form-group">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" name="is_active" id="is_active" checked>
              <label class="custom-control-label" for="is_active">activate</label>
            </div>
          </div> --}}
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="storeItem('/admin/doctors')" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function storeItem(url) {
            let data = new FormData();
            data.append('hospital_id', document.getElementById('hospital_id').value);
            data.append('name', document.getElementById('name').value);
            data.append('email', document.getElementById('email').value);
            data.append('phone', document.getElementById('phone').value);
            data.append('descrption', document.getElementById('descrption').value);

            if (document.getElementById('cover').files[0] != undefined) {
                data.append('cover', document.getElementById('cover').files[0]);
            }

            // data.append('is_active' , document.getElementById('is_active').checked);

            axios.post(url, data)
                .then(function(response) {
                    toastr.success(response.data.message);
                    document.getElementById('form-rest').reset();
                    console.log(response.data);
                    window.location.href = '/admin/doctors';
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                    console.log(error.response.data);
                })
        }
    </script>

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            majors: true,
            theme: 'bootstrap4'
        })
    </script>
@endsection
