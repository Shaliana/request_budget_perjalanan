@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    
                    <div class="col">
                        <div class="col-2">
                            <select name="year" id="year" class="form-control">
                                @foreach($years as $val)
                                <option value="{{$val->year}}" @if(date('Y') == $val->year) selected @endif>{{$val->year}}</option>
                                @endforeach
                            </select>
                        </div>
                        <canvas id="myChart" height="100px"></canvas>
                    </div>
                    <div class="col">
                        <canvas id="myChart2" height="100px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    window.onload = function() {
        request_month_year();
        request_item();
    }

    $("select[name=year]").on("change", function() {
        var year = $(this).val()
        request_month_year(year);
    })

    function request_month_year(year){
        var value;
        var dt = new Date();
        if(year == null){
            value = dt.getFullYear();
        }else{
            value = year;
        }
        // console.log(value);

        $.ajax({
            type: 'GET',
            url: "{{ route('requests_month') }}",
            data: {
                year: value
            },
            datatype: 'json',
            success: function(result) {
                // console.log(result.label);
                var labels =  result.label;
                var values =  result.value;
                var new_chart = document.getElementById('myChart');

                let chartStatus = Chart.getChart("myChart");
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }

                const data = {
                    labels: labels,
                    datasets: [{
                        maxBarThickness: 50,
                        label: 'Request Dana Perjalanan Perbulan',
                        data: values,
                    }]
                };
            
                const myChart = new Chart(
                    new_chart,
                    {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    }
                );
            }
        });

        
    }

    function request_item(){
        $.ajax({
            type: 'GET',
            url: "{{ route('requests_item') }}",
            datatype: 'json',
            success: function(result) {
                console.log(result.label);
                var labels =  result.label;
                var values =  result.value;
                var new_chart = document.getElementById('myChart2');

                let chartStatus = Chart.getChart("myChart2");
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }

                const data = {
                    labels: labels,
                    datasets: [{
                        maxBarThickness: 50,
                        label: 'Request Dana Perjalanan Per Item',
                        data: values,
                    }]
                };
            
                const myChart = new Chart(
                    new_chart,
                    {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    }
                );
            }
        });

        
    }
    
</script>
@endsection