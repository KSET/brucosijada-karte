@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Prijava') }}</div>

                <div class="card-body">
                <button onclick="location.href='{{ url('auth/google') }}'" type="button" class="btn btn-info">
                      <strong><i class="fas fa-sign-in-alt"></i>&nbsp;Google Prijava</strong>
                </button> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
