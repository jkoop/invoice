@extends('layouts.loggedIn')
@section('content')

<h2>Income last 13 weeks</h2>

<div class="card chart-container">
    <canvas id="chart"></canvas>
</div>

<script>
    const ctx = document.getElementById("chart").getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["sunday", "monday", "tuesday",
                "wednesday", "thursday", "friday", "saturday", "sunday", "monday", "tuesday",
                "wednesday", "thursday", "friday"
            ],
            datasets: [{
                label: 'Last week',
                backgroundColor: 'rgba(161, 198, 247, 1)',
                borderColor: 'rgb(47, 128, 237)',
                data: [.0003, .0004, .0002, .0005, .0008, .0009, .0002, .0003, .0004, .0002, .0005, .0008, .0009],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            }
        },
    });
</script>

@endsection
