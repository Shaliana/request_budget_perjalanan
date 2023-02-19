@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Dana Perjalanan</div>
                
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
                        <a href="{{ route('requests.create') }}" class="btn btn-primary btn-sm">Create</a>
                    </div>
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="15%">Item Request</th>
                        <th width="15%">Nominal</th>
                        <th width="15%">Status</th>
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
            const url = '{{ route('requests.index') }}';

            $("#dataTable").DataTable({
                processing: true,
                searching: true,
                ajax: {
                    url: url
                },
                columns: [
                    {data: 'item_id',  render: function (data, type, full){
                        return full.item ? full.item.name : '';
                      }
                    },
                    {data: 'nominal', render: function (data, type, full){
                        let IdrFormat = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                        });
                        return IdrFormat.format(data);
                      }
                    },
                    {data: 'status', render: function (data, type, full){
                        let badge;
                        let text;
                        if (data == 1) {
                          badge = 'bg-success';
                          text = 'Disetujui';
                        }else if (data == 2) {
                          badge = 'bg-danger';
                          text = 'Ditolak';
                        }else if (data == 3) {
                          badge = 'bg-success';
                          text = 'Sudah Ditransfer';
                        }else {
                          badge = 'bg-warning';
                          text = 'Belum diproses';
                        }
                        return '<span class="badge '+badge+' ">'+text+'</span>'
                      }
                    },
                    {
                        data: 'id', render: function (data, type, full, meta) {
                            let action = '<div class="row g-2">';

                            action += `<div class="col-md-auto"><a href="{{ route('requests.show', 'DATA_ID') }}" class="btn btn-sm btn-info">Show</a></div>`;
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