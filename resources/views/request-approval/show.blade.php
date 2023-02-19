@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Detail</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="item" class="col-md-4 col-form-label text-md-end">User</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $requests->user->name }}" readonly>
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

                    <div class="row mb-3">
                        <label for="status" class="col-md-4 col-form-label text-md-end">Status</label>

                        <div class="col-md-6 d-flex align-items-center">
                            @if($requests->status == 1)
                            <span class="badge bg-success">Disetujui</span>
                            @elseif($requests->status == 2)
                            <span class="badge bg-danger">Ditolak</span>
                            @elseif($requests->status == 3)
                            <span class="badge bg-success">Sudah Ditransfer</span>
                            @else
                            <span class="badge bg-warning">Belum Proses</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('requests_approval.index') }}" class="btn btn-secondary float-end">
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
