@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Import Guests') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                   
                                    <form method="POST" enctype="multipart/form-data" action="{{route('import_guests')}}">
                                    @csrf
                                    <div class='form-group'>
                                        <label for='file'>Choose CSV/XLSX</label>
                                        <input type='file' name='file' class='form-control'/>
                                    </div>
                                    <button type='submit' class="btn btn-primary">Submit</button>
</form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
