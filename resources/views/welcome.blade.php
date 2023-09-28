@php
$chartData = [
    'centyl_75' => json_encode([79,90.5,98.5, 107.2, 114.1, 121, 127, 133, 139, 145, 150, 156.9, 165, 172, 176.5, 180.5, 182.2, 182.9 ]),
    'centyl_50' => json_encode([77,88,96.8, 104.2, 110.6, 117.4, 123.5, 129.5, 135.5, 140.9, 146.2, 152, 159, 166, 171.5, 176, 178.5, 178.9 ]),
    'centyl_25' => json_encode([75.1,86.5,94.2, 101.2, 108, 114.2, 120.4, 126, 131, 137, 142, 147, 153.2, 159.7, 167, 172, 174.5, 174.9 ]),
            
];

@endphp


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="max-h-screen overflow-x-auto">
            <canvas style="width: 340px; height:480px" class="w-full p-4 mb-4 overflow-x-auto font-light !dark:text-white" id="userChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            var ctx = document.getElementById('userChart');
            var chartData = @json($chartData);
            
            const DATA_COUNT = 19;
            const labels = [];
                for (let i = 1; i < DATA_COUNT; ++i) {
                labels.push(i.toString());
            }

            function drawDashedLine(pattern) {
                ctx.beginPath();
                ctx.setLineDash(pattern);
                ctx.moveTo(0, y);
                ctx.lineTo(300, y);
                ctx.stroke();
                y += 20;
            }

            var userChart = new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: '75',
                            data: JSON.parse(chartData.centyl_75),
                            borderColor: '#666666',
                            borderWidth: 2,

                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,                            
                            borderJoinStyle: 'round',
                            capBezierPoints: false,
                            pointStyle: false,
                            borderDash: [3, 3],
                        },
                        {
                            label: '50',
                            data: JSON.parse(chartData.centyl_50),
                            borderColor: '#666666',
                            borderWidth: 3,
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,                            
                            borderJoinStyle: 'round',
                            capBezierPoints: false,
                            pointStyle: false,
                        },                        
                        {
                            label: '25',
                            data: JSON.parse(chartData.centyl_25),
                            borderColor: '#666666',
                            borderWidth: 2,

                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,                            
                            borderJoinStyle: 'round',
                            capBezierPoints: false,
                            pointStyle: false,
                            borderDash: [3, 3],
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            border: {
                                display: true,
                            }

                        },
                        y: {
                            beginAtZero: false,
                            ticks: {
                                stepSize: 5,
                            },
                        }
                    }
                }
            });

        </script>

    </body>
</html>
