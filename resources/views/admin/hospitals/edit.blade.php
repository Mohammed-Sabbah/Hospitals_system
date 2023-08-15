@extends('admin.layouts')

@section('title', 'Edit Hospital')

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


        <form action="{{ route('hospital.update', $hospital->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group" data-select2-id="28">
                    <label>Select Majors</label>
                    <select class="select2 select2-hidden-accessible" name="majors[]" multiple=""
                        data-placeholder="Select a State" style="width: 100%;" data-select2-id="6" tabindex="-1"
                        aria-hidden="true">
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}"
                                @foreach ($hospital->majors as $theMajor)
                                    @if ($theMajor->pivot->major_id == $major->id)
                                        selected
                                        @break
                                    @endif
                                @endforeach>
                                {{ $major->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Enter Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                        placeholder="Enter Name" value="{{ $hospital->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Location</label>
                    <input type="text" class="form-control" name="location" id="exampleInputPassword1"
                        placeholder="Location" value="{{ $hospital->location }}">
                </div>

                <div class="form-group">
                    <label>Info</label>
                    <textarea class="form-control" name="info" rows="3" placeholder="Enter ...">{{ $hospital->info }}</textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Choose image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="cover" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="is_active" id="customSwitch1"
                            @if ($hospital->is_active) checked @endif>
                        <label class="custom-control-label" for="customSwitch1">activate</label>
                    </div>
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
