<div id="myChartContainer">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var labels = @json($labels);
    var membersData = @json($data);
    var pluginText =  @json($pluginText); 
    var xAxisText =  @json($xAxisText); 
    var yAxisText =  @json($yAxisText); 
    var labelText =  @json($labelText);
  
    var data = {
        labels: labels,
        datasets: [{
            label: labelText,
            data: membersData,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            tension: 0.5 
        }]
    };

    var config = {
        type: 'line',
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

