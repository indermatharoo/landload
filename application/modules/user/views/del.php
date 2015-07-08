<div class="span6">
    <div class="widget">
        <div class="widget-header"> <i class="icon-signal"></i>
            <h3> Area Chart Example</h3>
        </div>
        <div class="widget-content">
            <canvas id="area-chart" class="chart-holder" height="250" width="538"> </canvas>
        </div>
    </div>
</div>
<script src="js/chart.min.js" type="text/javascript"></script> 
<script>
    var lineChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    }
    var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);
</script><!-- /Calendar -->
