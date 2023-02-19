@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Dana Perjalanan</div>
                <div class="card-body">
                <div class="row mb-3">
                    <label for="item" class="col-md-4 col-form-label text-md-end">User</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ $requests->user->name }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="item" class="col-md-4 col-form-label text-md-end">Bank</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ @$requests->user->bank->name }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="item" class="col-md-4 col-form-label text-md-end">No. Rekening</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ @$requests->user->account_number }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="item" class="col-md-4 col-form-label text-md-end">Item Request</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ $requests->item->name }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nominal" class="col-md-4 col-form-label text-md-end">Nominal</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ format_num($requests->nominal) }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="information" class="col-md-4 col-form-label text-md-end">Keterangan</label>

                    <div class="col-md-6">
                        <textarea name="" id="" class="form-control" readonly>{{ $requests->information }}</textarea>
                    </div>
                </div>
                <hr>
                <form method="POST" action="{{ route('requests_finance.update', $requests->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('request-finance.field')
                </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
