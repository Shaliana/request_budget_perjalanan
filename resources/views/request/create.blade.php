@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Dana Perjalanan</div>
                <form method="POST" action="{{ route('requests.store') }}">
                    @csrf
                    @include('request.field')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
