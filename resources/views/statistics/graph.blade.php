<div id="myChartContainer">
<div style="position: relative; height:55vh;">
    <canvas id="myChart" width="400" height="400" style="display: block; width: 400px; height: 400px;"></canvas>
</div>
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
            backgroundColor: '#dee9f7',
            borderColor: '#ff6359',
            borderWidth: 2,
            tension: 0.5,
            pointBorderColor: "#fd463b",
            pointBackgroundColor: "#fd463b",
            pointBorderWidth: 8,
            pointHoverRadius: 8,
            pointHoverBackgroundColor: "#000000",
            pointHoverBorderColor: "#000000",
            pointHoverBorderWidth: 4,
            pointRadius: 1,
            borderWidth: 4,
            pointHitRadius: 30
        }]
    };

    var config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true, 
      		maintainAspectRatio: false, 
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
