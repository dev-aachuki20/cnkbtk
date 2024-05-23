<div id="myChartContainer">
    <div class="avg"> <b>{{__('cruds.global.total')}} {{__('cruds.global.count')}} :</b>
        @if ($total == 0)
        0
        @else
        {{$total}}
        @endif
    </div>
    <div class="avg"> <b>{{__('cruds.global.average')}} :</b>
        @if ($average == 0)
        0.00
        @else
        {{$average}}
        @endif
    </div>
    <div style="position: relative; height:55vh;">
        <canvas id="myChart" width="400" height="400" style="display: block; width: 400px; height: 400px;"></canvas>
    </div>
</div>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var labels = @json($labels);
    var membersData = @json($datasets);
    var pluginText = @json($pluginText);
    var xAxisText = @json($xAxisText);
    var yAxisText = @json($yAxisText);
    var labelText = @json($labelText);
    var data = {
        labels: labels,
        datasets: membersData,
    }
    var config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        labelColor: function(context) {
                            // var dataset = context.chart.data.datasets[context.datasetIndex];
                            var dataset = context.dataset || {};
                            var backgroundColor = dataset.backgroundColor || '';
                            var borderColor = dataset.borderColor || '';
                            return {
                                borderColor: borderColor,
                                backgroundColor: backgroundColor,
                                borderWidth: 1,
                                borderDash: [0, 0],
                                borderRadius: 0,
                            };
                        },
                        labelTextColor: function(context) {
                            return '#fff';
                        },
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat().format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                },
                title: {
                    display: true,
                    text: pluginText
                }
            },
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                x: {
                    min: 0,
                    display: true,
                    title: {
                        display: true,
                    }
                },
                y: {
                    min: 0,
                    display: true,
                    title: {
                        display: true,
                        text: yAxisText
                    }
                }
            },
        }

    };

    var myChart = new Chart(ctx, config);
</script>