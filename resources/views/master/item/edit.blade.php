@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Item</div>
                <form method="POST" action="{{ route('items.update', $items->id) }}">
                    @csrf
                    @method('PUT')
                    @include('master.item.field', [
                    'isEdit' => true
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
