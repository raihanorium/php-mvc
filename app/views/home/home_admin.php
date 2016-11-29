<html>
<layoutsection name="title">Home</layoutsection>
<layoutsection name="body">
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">Top 5 Reseller</div>
                <div class="panel-body">
                    <canvas id="monthlySalesChart" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">2</div>
                <div class="panel-body">
                    2
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">3</div>
                <div class="panel-body">
                    3
                </div>
            </div>
        </div>
    </div>
</layoutsection>
<layoutsection name="script">
    <script type="text/javascript">
        $(document).ready(function () {
            var ctx = document.getElementById("monthlySalesChart");
            var monthlySalesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2],
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