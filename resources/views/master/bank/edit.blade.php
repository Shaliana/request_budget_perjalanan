@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Bank</div>
                <form method="POST" action="{{ route('bank.update', $banks->id) }}">
                    @csrf
                    @method('PUT')
                    @include('master.bank.field', [
                    'isEdit' => true
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
