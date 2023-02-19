@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Dana Perjalanan</div>
                
                <div class="card-body">
                    <ul class="nav nav-tabs" id="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-new" data-toggle="pill" href="#new" role="tab"
                                aria-controls="new" aria-selected="true">Belum Proses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-approve" data-toggle="pill" href="#approve" role="tab"
                                aria-controls="approve" aria-selected="false">Sudah Ditransfer</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="tab-new">
                            <br>
                            <table id="tbl_new" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                    <th width="15%">User</th>
                                    <th width="15%">Item Request</th>
                                    <th width="15%">Nominal</th>
                                    <th width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="approve" role="tabpanel" aria-labelledby="tab-approve">
                            <br>
                            <table id="tbl_approve" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                    <th width="15%">User</th>
                                    <th width="15%">Item Request</th>
                                    <th width="15%">Nominal</th>
                                    <th width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
        $(document).ready(function () {
          var activeTab = "new";
          // console.log(activeTab);
          showTable(activeTab);

          $('#tabs').on("click", "li", function (event) {
              var activeTab = $(this).find('a').attr('id').split('-')[1];
              // alert(activeTab);
              showTable(activeTab);
          });

        });

        function showTable(activeTab) {
            var url = "{{ route('requests_finance.json', 'DATA_ID') }}";
            url = url.replace(/DATA_ID/g, activeTab);
            console.log(url);
            var table = $("#tbl_" + activeTab).DataTable({
                scrollX: true,
                processing: true,
                ajax: {
                  "type": "GET",
                  "dataType": 'json',
                  url: url,
                  data: {
                    "_token": "{{ csrf_token() }}",
                  }
                },
                destroy: true,
                columns: [
                    {data: 'user_id',  render: function (data, type, full){
                        return full.user ? full.user.name : '';
                      }
                    },
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
                    {
                        data: 'id', render: function (data, type, full, meta) {
                            let action = '<div class="row g-2">';

                            action += `<div class="col-md-auto"><a href="{{ route('requests_finance.show', 'DATA_ID') }}" class="btn btn-sm btn-info">Show</a></div>`;
                            if (activeTab == "new") {
                                action += `<div class="col-md-auto"><a href="{{ route('requests_finance.edit', 'DATA_ID') }}" class="btn btn-sm btn-warning">Review</a></div>`;
                            }
                            action += '</div>';

                            action = action.replace(/DATA_ID/g, data)

                            return action;
                        }
                    },
                ]
            });
        }
</script>
@endsection