<div class="nav-tabs-custom ">
    <h3>Survey</h3>
    <ul class="nav nav-tabs">
        <li><a href="#tab_1 active" data-toggle="tab">Assigned</a></li>
    </ul>
    <div class="tab-content">       
        <div class="tab-pane" id="tab_1">
            <?php
            $assignMeHtml = null;
            foreach ($assignToMe as $key => $keyVal) {
                $assignMeHtml .= '<div class="row col-md-12"> 
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
</div>
<?php $this->load->view('header/survey_index'); ?>
