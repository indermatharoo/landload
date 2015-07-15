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
            var linechartdata = '<?php echo json_encode($lineChartdata); ?>';
            console.log(linechartdata);
            linechartdata = JSON.parse(linechartdata);
            google.setOnLoadCallback(drawLineChart);
            function drawLineChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Year');
                console.log(linechartdata.count_data);
                if (linechartdata.count_data.users) {
                    data.addColumn('number', 'Companies');
                }
                if (linechartdata.count_data.property) {
                    data.addColumn('number', 'Properties');
                }
                if (linechartdata.count_data.applicant) {
                    data.addColumn('number', 'Applicants');
                }
                if (linechartdata.minmax.mindate == 0 && linechartdata.minmax.maxdate == 0) {
                    return false
                }
                else if (linechartdata.minmax.mindate == 0) {
                    linechartdata.minmax.mindate = linechartdata.minmax.maxdate;
                } else {
                    linechartdata.minmax.maxdate = linechartdata.minmax.mindate;
                }
                /*
                 * creating data
                 */
                var addrow = [];
                for (var i = linechartdata.minmax.mindate; i <= linechartdata.minmax.maxdate; i++) {
                    var temp = [], selected = true;
                    temp.push(linechartdata.minmax.mindate);
                    if (linechartdata.count_data.users) {
                        selected = true;
                        linechartdata.count_data.users.forEach(function (elm) {
                            if (elm.year == i) {
                                selected = true;
                                temp.push(parseInt(elm.count));
                            }
                        });
                    }
                    if (!selected) {
                        temp.push(0);
                    }
                    if (linechartdata.count_data.property) {
                        selected = false;
                        linechartdata.count_data.property.forEach(function (elm) {
                            if (elm.year == i) {
                                selected = true;
                                temp.push(parseInt(elm.count));
                            }
                        });

                    }
                    if (!selected) {
                        temp.push(0);
                    }
                    if (linechartdata.count_data.applicant) {
                        selected = false;
                        linechartdata.count_data.applicant.forEach(function (elm) {
                            if (elm.year == i) {
                                selected = true;
                                temp.push(parseInt(elm.count));
                            }
                        });
                    }
                    addrow.push(temp);
                }
                if (addrow.length == 1) {
                    addrow.push(temp);
                    console.log(temp);
                }
                data.addRows(addrow);
                var options = {
                    chart: {
                        title: 'Statistics',
//                        subtitle: 'in millions of dollars (USD)'
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
