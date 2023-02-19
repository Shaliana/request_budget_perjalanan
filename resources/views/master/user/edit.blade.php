@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>
                <form method="POST" action="{{ route('users.update', $users->id) }}">
                    @csrf
                    @method('PUT')
                    @include('master.user.field', [
                    'isEdit' => true
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
