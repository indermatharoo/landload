<script type="text/javascript"
        src="https://www.google.com/jsapi?autoload={
        'modules':[{
        'name':'visualization',
        'version':'1',
        'packages':['corechart']
        }]
}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Income'],
                ['Apr-Jun', forEClass('G1')],
                ['Jul-Sep', forEClass('G2')],
                ['Oct-Dec', forEClass('G3')],
                ['Jan-Mar', forEClass('G4')],
            ]);
            var options = {
                title: 'Franchise Performance',
                curveType: 'function',
                legend: {position: 'bottom'}
            };
            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
        }
    });
</script>
<div id="curve_chart" style="width: 100%; height: 500px;"></div>
