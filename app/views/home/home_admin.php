<html>
<layoutsection name="title">Home</layoutsection>
<layoutsection name="body">
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">Today's Sales</div>
                <div class="panel-body">
                    <canvas id="todaysSalesChart" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">This Month's Sales</div>
                <div class="panel-body">
                    <canvas id="monthsSalesChart" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
        </div>
    </div>
</layoutsection>
<layoutsection name="script">
    <script type="text/javascript">
        $(document).ready(function () {
            var todaysSalesChartCtx = document.getElementById("todaysSalesChart");
            var todaysSalesChart = new Chart(todaysSalesChartCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($model['todaysSalesLabels']); ?>,
                    datasets: [{
                        label: 'BDT',
                        data: <?php echo json_encode($model['todaysSalesTotal']); ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var monthsSalesChartCtx = document.getElementById("monthsSalesChart");
            var monthsSalesChart = new Chart(monthsSalesChartCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($model['monthsSalesLabels']); ?>,
                    datasets: [{
                        label: 'BDT',
                        data: <?php echo json_encode($model['monthsSalesTotal']); ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
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
    </script>
</layoutsection>
</html>