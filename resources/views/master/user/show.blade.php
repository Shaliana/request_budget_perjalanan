@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $users->name }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $users->email }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $users->role->role_name }}" readonly>
                        </div>
                    </div>

                    @if(strtolower($users->role->role_name) == "user")
                    <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-end">Bank</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ @$users->bank->name }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-end">No. Rekening</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $users->account_number }}" readonly>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary float-end">
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
