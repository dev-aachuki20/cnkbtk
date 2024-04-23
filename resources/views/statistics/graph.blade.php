<div id="myChartContainer">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var labels = @json($labels);
    var membersData = @json($data);
    console.log(membersData);
    var pluginText = @json($pluginText);
    var xAxisText = @json($xAxisText);
    var yAxisText = @json($yAxisText);
    var labelText = @json($labelText);

    var data = {
        labels: labels,
        datasets: [{
            label: labelText,
            data: membersData,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            tension: 0.5
        }]
    };

    var config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
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
                    display: true,
                    title: {
                        display: true,
                        text: xAxisText
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: yAxisText
                    }
                }
            }
        }
    };

    var myChart = new Chart(ctx, config);
</script>
