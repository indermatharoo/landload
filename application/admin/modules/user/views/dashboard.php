<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<div class="row content-bg">
    <div class="dashboard_message content-bg" style="min-width:200px;left: 207.5px; position: absolute; top: 152px; z-index: 9999; opacity: 1; display: none; padding: 10px;">
        <div class="cls" style="text-align: right; cursor: pointer">X</div>
        <div class="content" style="padding: 0; text-align: center; text-transform: capitalize"></div>
    </div>
    <div id="left-column" class="col-lg-7 pad-left30 pad-top20">
        <?php
        //  $this->load->view('dashboard/filters');
        ?>
        <script>
            $(document).ready(function () {
                var show = '<?php echo IsFirstTimeLogin(); ?>';
                if (show == 'N')
                    return false;
                $.get('<?php echo createUrl('user/IsFirstTimeLogin') ?>', function (response) {
                    $('.popups').html(response);
                    $('.popups').bPopup({
                        closeClass: 'close1'
                    });
                });
            });
            $(document).ready(function () {
                $('.panel-title').click(function () {
                    var img = $(this).find('img');
                    var url = (img.attr('src') == '../imgs/down-triangle.png') ? '../imgs/right-triangle.png' : '../imgs/down-triangle.png';
                    img.attr('src', url);
                });
            });

        </script>
        <div class="popups">

        </div>
        <div class="table_cont">
            <div class="top-table">

            </div>
            <div class="bott-table">

            </div>
        </div>

        <div id="franchise_performance" style=" border: 1px solid #aaa; border-radius: 5px;">
            <div class="panel-group" id="accordion" style="margin: 0;">
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding: 0;">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><h3 style="margin: 0; text-align: center; background: #d37602 none repeat scroll 0 0; color: #fff; padding: 5px;">Recent Properties<img src="../imgs/right-triangle.png" style="float: right;"></h3></a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body"> <?php $this->load->view("dashboard/dashboardListing"); ?></div>
                    </div>
                </div>
                <?php if ($this->aauth->isAdmin()): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding: 0;">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><h3 style="margin: 0; text-align: center; background: #d37602 none repeat scroll 0 0; color: #fff; padding: 5px;">Recent Company<img src="../imgs/down-triangle.png" style="float: right;"></h3></a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body"><?php $this->load->view("dashboard/recentCompany"); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding: 0;">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><h3 style="margin: 0; text-align: center; background: #d37602 none repeat scroll 0 0; color: #fff; padding: 5px;">Recent Applicants<img src="../imgs/down-triangle.png" style="float: right;"></h3></a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body"><?php $this->load->view("dashboard/recentUsers"); ?></div>
                    </div>
                </div>
            </div>

        </div>
        <div id="franchisesregions"> </div>
    </div>
    <div id="right-column" class="col-lg-5 pad-top20">
        <div class="col-lg-12 menu padding-0">
            <?php $this->load->view(THEME . 'layout/inc-menu'); ?>
        </div>
        <script type="text/javascript">
            var total = <?php echo json_encode($total); ?>;
            console.log(total);
            google.load("visualization", "1", {packages: ["corechart", "line"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Stats', ''],
                    ['Total Properties', total.applicants],
                    ['Total Companies', total.companies],
                    ['Total Applicants', total.properties]
                ]);

                var options = {
                    title: 'Statistics',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
        </script>        
        <div class="col-lg-12 menu padding-0">
            <div id="piechart_3d" style="width: 525px; height:300px;"></div>
        </div>
    </div>
    <div class="col-lg-12 menu padding-0">
        <script type="text/javascript">
//            google.setOnLoadCallback(drawLineChart);
            function drawLineChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('number', 'Year');
                data.addColumn('number', 'Properties');
                data.addColumn('number', 'Companies');
                data.addColumn('number', 'Applicants');
                data.addRows([
                    [1, 99.8, 99.8, 99.8],
                    [2, 77.9, 77.5, 77.4],
                    [3, 66.4, 66, 66.7],
                    [4, 11.7, 18.8, 10.5],
                    [5, 11.9, 17.6, 10.4],
                    [6, 8.8, 13.6, 7.7],
                    [7, 7.6, 12.3, 9.6],
                    [8, 12.3, 29.2, 10.6],
                    [9, 16.9, 42.9, 14.8],
                    [10, 12.8, 30.9, 11.6],
                    [11, 5.3, 7.9, 4.7],
                    [12, 6.6, 8.4, 5.2],
                    [13, 4.8, 6.3, 3.6],
                    [14, 4.2, 6.2, 3.4]
                ]);
                var options = {
                    chart: {
                        title: 'Box Office Earnings in First Two Weeks of Opening',
                        subtitle: 'in millions of dollars (USD)'
                    },
                    height: 400
                };
                var chart = new google.charts.Line(document.getElementById('linechart_material'));
                chart.draw(data, options);
            }

        </script>
        <div id="linechart_material" style="">                   
        </div>        
    </div>
     <div class="clearfix"></div>

</div>
<?php $this->load->view('headers/dashboard'); ?>
