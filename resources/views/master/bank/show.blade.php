@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bank Detail</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Bank Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $banks->name }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('bank.index') }}" class="btn btn-secondary float-end">
                                Back
                            </a>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
