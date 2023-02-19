@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Item Request</div>
                
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
                        <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm">Create</a>
                    </div>
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="15%">Item Name</th>
                        <th width="15%"></th> 
                    </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
            const url = '{{ route('items.index') }}';

            $("#dataTable").DataTable({
                processing: true,
                searching: true,
                ajax: {
                    url: url
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {
                        data: 'id', render: function (data, type, full, meta) {
                            let action = '<div class="row g-2">';

                            action += `<div class="col-md-auto"><a href="{{ route('items.show', 'DATA_ID') }}" class="btn btn-sm btn-info">Show</a></div>`;
                            action += `<div class="col-md-auto"><a href="{{ route('items.edit', 'DATA_ID') }}" class="btn btn-sm btn-warning">Edit</a></div>`;
                            action += `<form id="target" action="{{ route('items.destroy', 'DATA_ID') }}" method="post" class="form-inline col-md-auto">@method('DELETE') @csrf<button class="btn btn-sm btn-danger delete-confirm" type="submit">Delete</button></form>`;
                            action += '</div>';

                            action = action.replace(/DATA_ID/g, data)

                            return action;
                        }
                    },
                ],
            });


    });
</script>
@endsection