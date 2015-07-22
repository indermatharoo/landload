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
             
            </div>

        </div>
        <div id="franchisesregions"> </div>
    </div>
    <div id="right-column" class="col-lg-5 pad-top20">
        <div class="col-lg-12 menu padding-0">
            <?php $this->load->view(THEME . 'layout/inc-menu'); ?>
        </div>

        <div class="col-lg-12 menu padding-0">
            <div id="piechart_3d" style="width: 525px; height:300px;"></div>
        </div>
    </div>
    <div class="col-lg-12 menu padding-0">
        <div id="linechart_material" style="">                   
        </div>        
    </div>
    <div class="clearfix"></div>
</div>

