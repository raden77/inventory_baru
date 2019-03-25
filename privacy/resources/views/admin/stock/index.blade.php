@extends('adminlte::page')

@section('title', 'Stock')

@section('content_header')
    <h1>Stock</h1>
@stop

@section('content')
<body>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading"><b>Charts</b></div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600">OK</canvas>
                </div>
            </div>
        </div>
    </div>
    
</body>
@stop

@push('css')

@endpush
@push('js')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var url = "{{url('admin/stock/chart')}}";
        var Years = new Array();
        var Labels = new Array();
        var Prices = new Array();
        $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
                Years.push(data.stockYear);
                Labels.push(data.stockName);
                Prices.push(data.stockPrice);
            });
            var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels:Years,
                      datasets: [{
                          label: 'Infosys Price',
                          data: Prices,
                          backgroundColor:'rgb(176,224,230)',
                          hoverBorderColor:'rgb(255,0,0)',
                          borderWidth: 1
                      }]
                  },
                  options: {
                   
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Yearly Stock Price'
                    },
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });
          });
        });
    </script>
@endpush