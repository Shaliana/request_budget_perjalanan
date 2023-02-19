@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    @include('master.user.field')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
