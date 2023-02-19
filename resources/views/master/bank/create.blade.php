@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Bank</div>
                <form method="POST" action="{{ route('bank.store') }}">
                    @csrf
                    @include('master.bank.field')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
