<?php
$CurrentCI = & get_instance();
?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="survey"><h3 style="margin: 0; color: #fff"><i class="fa fa-home"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; color: #fff; text-align: center">Survey Report</h3>
        </div>
    </div>
</header>
<div class='surveyReport' id='surveyReport'>    
    <div class="col-sm-12 padding-0 mar-top10">
        <div class="col-sm-4 surveyRep">
            Total Assigned <h1 style="margin: 0;" class="counter"><?php echo count($surveyDetail['assigneArray']); ?></h1>
        </div>
        <div class="col-sm-4 surveyRep">
            Completed <h1 style="margin: 0;" class="counter"><?php echo count($surveyDetail['assigneAnsCount']); ?></h1>
        </div>
        <div class="col-sm-4 surveyRep">
            Completion Ratio %<h1 style="margin: 0;"><span class="counter"><?php echo round((count($surveyDetail['assigneAnsCount']) / count($surveyDetail['assigneArray'])) * 100,2) ?></span><span>%</span></h1>
        </div>
    </div>
    <div class="col-sm-12 padding-0 mar-top10">
        <div class="bs-example">
            <div class="" id="">
                <?php
                //ep($survey_anwser);
                $grapArray = array();
                foreach ($survey_question as $key => $kval) {
                    //ep($kval);
                    //echo $kval['question_type']; echo $kval['question_text'];
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" 
                                   data-parent="#accordion" 
                                   href="#collapse<?php echo $key; ?>"><?= $kval['question_text']; ?></a>
                            </h4>
                        </div>
                        <!--                        panel-collapse collapse    style="max-height:200px;overflow-y:scroll; " -->
                        <div id="collapse<?php echo $key; ?>" class=" <?php echo ($key == 0 ? 'in' : ''); ?>">
                            <div class="panel-body">
                                <div id="products" class="row list-group">
                                    <div class="item col-lg-12">
                                        <div class="thumbnail">
                                            <div class="caption">
                                                <?php
                                                $NUM = $kval['id'];
                                                $filteredItems = array_filter($survey_anwser, function($elem) use($NUM) {
                                                    if ($NUM == $elem['question_id']) {
                                                        return $elem;
                                                    }
                                                });
                                                if (in_array($kval['question_type'], array('dropdown', 'radio', 'checkbox'))) {
                                                    $grapArray[$kval['id']]['questionText'] = $kval['question_text'];
                                                    $grapArray[$kval['id']]['questionID'] = $kval['id'];
                                                    $grapArray[$kval['id']]['name'] = '';
                                                    $grapArray[$kval['id']]['data'] = array();
                                                    echo $CurrentCI->getQusAnsTblView(
                                                            $kval, unserialize($kval['multiopt']), $filteredItems, $grapArray[$kval['id']]
                                                    );
                                                    //ep($grapArray);
                                                } else {
                                                    foreach ($filteredItems as $item => $itemVal) {
                                                        ?>
                                                                                                                                                                                <!--<h4 class="group inner list-group-item-heading"><?= $itemVal['name']; ?></h4>-->
                                                        <p class="group inner list-group-item-text">
                                                            <?= $itemVal['answer_text']; ?>
                                                        </p>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>    
</div>
<style>
    .question_content tbody tr:nth-child(even){
        background-color: lightgoldenrodyellow;
    }
    .question_content tbody tr:nth-child(odd){
        background-color: lightgrey;
    }
    .glyphicon { margin-right:5px; }
    .thumbnail
    {
        margin-bottom: 20px;
        padding: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
    }

    .item.list-group-item
    {
        float: none;
        width: 100%;
        background-color: #fff;
        margin-bottom: 10px;
    }
    .item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
    {
        background: #428bca;
    }

    .item.list-group-item .list-group-image
    {
        margin-right: 10px;
    }
    .item.list-group-item .thumbnail
    {
        margin-bottom: 0px;
    }
    .item.list-group-item .caption
    {
        padding: 9px 9px 0px 9px;
    }
    .item.list-group-item:nth-of-type(odd)
    {
        background: #eeeeee;
    }

    .item.list-group-item:before, .item.list-group-item:after
    {
        display: table;
        content: " ";
    }

    .item.list-group-item img
    {
        float: left;
    }
    .item.list-group-item:after
    {
        clear: both;
    }
    .list-group-item-text
    {
        margin: 0 0 11px;
    }

</style>
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
                            radius: 2 / 3,
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