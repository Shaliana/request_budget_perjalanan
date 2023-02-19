@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Item</div>
                <form method="POST" action="{{ route('items.store') }}">
                    @csrf
                    @include('master.item.field')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
