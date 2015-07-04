
<?php
$CurrentCI = & get_instance();
?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="survey"><h3 style="margin: 0; color: #fff"><i class="fa fa-home"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">The Creation station Survey</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <h3 onclick="openAddSurvey();" style="cursor: pointer; margin: 0"><i class="fa fa-plus-square" title="Add New Survey"></i></h3>
        </div>
    </div>
</header>
<ul class="nav nav-tabs">
    <li class="<?= $tab1 ?>"><a href="#tab_1" data-toggle="tab">Dashboard</a></li>
    <?php if (!$this->aauth->isCustomer()): ?>
        <li class="<?= $tab2 ?>"><a href="#tab_2" data-toggle="tab">Add</a></li>
    <?php endif; ?>
    <li class="<?= $tab3 ?>"><a href="#tab_3" data-toggle="tab">Assigned</a></li>        
</ul>
<div class="tab-content">
    <div class="tab-pane <?= $tab1 ?>" id="tab_1">
        <div class="">                
            <div class="col-sm-12 padding-0">
                <div class="col-sm-4 surveyRep">
                    Total Survey <h1 style="margin: 0;" class="counter"><?php echo $ttlSurvey; ?></h1>
                </div>
                <div class="col-sm-4 surveyRep">
                    Completed <h1 style="margin: 0;" class="counter"><?php echo $expiredSurvey; ?></h1>
                </div>
                <div class="col-sm-4 surveyRep">
                    Completion Ratio %<h1 style="margin: 0;" >
                        <span class="counter"><?php echo round(($expiredSurvey / (intval($ttlSurvey) == 0 ? '1' : intval($ttlSurvey))) * 100, 2); ?></span><span>%</span></h1>
                </div>
            </div>
            <div class="col-sm-12 padding-20" >
                <div id="surveyReportGraph" style="min-height: 400px; max-width: 100%; margin: 0 auto">

                </div>
            </div>
            <section class="col-md-12 padding-0">
                <table id="survey-listing" class="col-md-12 table" style="list-style-type: none;">
                    <?php
                    if ($survryes) {
                        echo $survryes;
                    }
                    ?>
                </table>
            </section>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="tab-pane <?= $tab2 ?>" id="tab_2" style="padding-top: 10px">
        <div class="col-md-12 padding-0">
            <a href="<?= createUrl('survey') ?>" class="btn btn-primary pull-right btn-fix-width" >Reset</a>                
        </div>
        <div class="col-sm-12 padding-0">
            <?php echo $addSureyForm; ?> 
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="tab-pane <?= $tab3 ?>" id="tab_3">
        <?php
        $assignMeHtml = null;
        foreach ($assignToMe as $key => $keyVal) {
            $assignMeHtml .= '<div class="col-md-12" style="margin-bottom: 10px;"> 
                                    <div class="col-md-3">' . $keyVal['name'] . '</div>
                                    <div class="col-md-6">' . $keyVal['description'] . '</div>
                                    <div class="col-md-3">
                                        <button type="button" data-id="' . $keyVal['id'] . '" class="btn btn-info partSurvey">Part Survey</button>
                                    </div>
                                </div>';
        }
        echo $assignMeHtml;
        ?>
        <div class="clearfix"></div>
    </div>        
</div>
<?php $this->load->view('header/survey_index'); ?>
<script src="js/flotchart/jquery.flot.min.js" type="text/javascript"></script>
<script src="js/flotchart/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="js/flotchart/jquery.flot.pie.min.js" type="text/javascript"></script>
<script src="js/flotchart/jquery.flot.categories.min.js" type="text/javascript"></script>
<script type="text/javascript">
                $(function () {
<?php
foreach ($grapArray as $key => $keyVal) {
    ?>
                        $.plot("#<?= $keyVal['name'] ?>",
    <?= getJSarrayFromPHPArray($keyVal['data'], 'LabelDataColor'); ?>
                        , {
                            series: {
                                pie: {
                                    show: true,
                                    radius: 1,
                                    innerRadius: 0.5,
                                    label: {
                                        show: true,
                                        radius: 3 / 4,
                                        formatter: labelFormatter,
                                        threshold: 0.1
                                    }

                                }
                            },
                            legend: {
                                show: false
                            }
                        });
    <?php
}
?>
                });
                /*
                 * Custom Label formatter
                 * ----------------------
                 */
                function labelFormatter(label, series) {
                    return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                            + label
                            + "<br/>"
                            + Math.round(series.percent) + "%</div>";
                }
                //    counterup
                jQuery(document).ready(function ($) {
                    $('.counter').counterUp({
                        delay: 10,
                        time: 1000
                    });
                });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js" type="text/javascript"></script>