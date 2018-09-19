@extends ('layouts.master')

@section ('content')
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Upload location data</h4>
        <hr>
        @include('layouts.errors')
        <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-body">
                    <input type="file" class="form-control-file" id="exampleInputFile1" name="csv_file" accept="text/csv, application/csv">
                </div>
            </div>
            <hr class="mb-4">
            <div class="text-center">
                <button class="btn btn-primary btn-lg" type="submit">Upload</button>
            </div>
        </form>
    </div>
    </div>
@endsection