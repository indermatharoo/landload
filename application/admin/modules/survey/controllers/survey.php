<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Survey extends Admin_Controller {

    function __construct() {
        parent::__construct();
        isLogged();
        $this->load->model('user/usermodel');
        $this->load->model('SurveyFormmodel');
        $this->load->model('SurveySurveymodel');
        $this->load->model('SurveyAnswermodel');
        $this->load->model('SurveyQuestionmodel');
        $this->load->model('SurveyCategorymodel');
    }

    function addCategory() {
        $this->load->helper('text');
        $this->load->library('form_validation');

        //Form Validation
        $this->form_validation->set_rules('is_active', 'Active', 'trim');
        $this->form_validation->set_rules('assign_group', 'Assign Group', 'trim');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('category_description', 'Category Description', 'trim|required');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['categorylist'] = $this->SurveyCategorymodel->listAll();
            $inner['assigns'] = $this->aauth->list_groups();
            echo $this->load->view('survey-category', $inner, TRUE);
        } else {
            $this->SurveyCategorymodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'Category added');
            echo json_encode(array('msg' => 'Successfully Added', 'success' => 1));
        }
        exit;
    }

    function addSurvey($internal = false, $surveyid = false) {
        $this->load->helper('text');
        $this->load->helper('date');
        $this->load->library('form_validation');
        //Form Validation            
        $this->form_validation->set_rules('is_active', 'Active', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        //$this->form_validation->set_rules('assigne_id', 'assigne_id', 'trim');
        $this->form_validation->set_rules('assigne_grp', 'Assigne Group', 'trim');
        $this->form_validation->set_rules('final_page_text', 'Final page text', 'trim');
        $this->form_validation->set_rules('survey_range', 'Start Date', 'trim|required');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            if (!$this->input->post('survey_posted', true)) {
                $inner = array();
                $inner['survey_id'] = $surveyid;
                $inner['availableElement'] = $this->SurveyFormmodel->getAvaialableElementList(true);
                $inner['availableQuestionValues'] = $this->SurveyQuestionmodel->getSurveyQuestion($surveyid);
                $inner['availableQuestionElement'] = $this->SurveyFormmodel->getExistingQuestionTemp($inner['availableQuestionValues']);
                array_unshift($inner['availableElement'], "Select Question Type");

                $inner['surveyDetail'] = null;
                $inner['place_start_date_str'] = date("d/m/Y");
                $inner['place_expired_date_str'] = date("d/m/Y", time() + 30 * 60 * 24 * 60);
                $inner['assigns'] = $this->aauth->list_groups();
                $inner['start_date'] = str_replace(' ', '/', date("Y m d"));
                $inner['expired_date'] = str_replace(' ', '/', date('Y m d', time() + 30 * 60 * 24 * 60));
                if (!$surveyid) {
                    $surveyid = gParam('surveyid');
                }
                if ($surveyid) {
                    $inner['surveyDetail'] = $this->SurveySurveymodel->detailById($surveyid);
                    $inner['surveyAssignedTo'] = $this->getGrpOpt($inner['surveyDetail']['assigne_grp']
                            , array('internal' => true,
                        'assignTo' => $inner['surveyDetail']['assigne_id']
                    ));
                    $startDateArr = explode(' ', $inner['surveyDetail']['start_date']);
                    $expiredDateArr = explode(' ', $inner['surveyDetail']['expired_date']);
                    $inner['place_start_date'] = explode('-', $startDateArr['0']);
                    $inner['place_start_date_str'] = $inner['place_start_date'][2]
                            . '/' . $inner['place_start_date'][1]
                            . '/' . $inner['place_start_date'][0];
                    $inner['place_expired_date'] = explode('-', $expiredDateArr['0']);
                    $inner['place_expired_date_str'] = $inner['place_expired_date'][2]
                            . '/' . $inner['place_expired_date'][1]
                            . '/' . $inner['place_expired_date'][0];
                }

                return $this->load->view('add-edit-survey', $inner, TRUE);
            } else {
                echo json_encode(array('msg' => strip_tags(validation_errors()), 'success' => 0));
            }
        } else {
            if ($this->input->post('editsurvey', true)) {
                $this->session->set_flashdata('SUCCESS', 'Survey updated');
                $msg = 'Successfully Updated';
            } else {
                $this->session->set_flashdata('SUCCESS', 'Survey added');
                $msg = 'Successfully Added';
            }
            $survey_id = $this->SurveySurveymodel->insertUpdateRecord();
            if ($survey_id) {
                $_POST['survey_id'] = $survey_id;
                $retdata = array('msg' => $msg, 'success' => 1);
                if (!$this->addEditSurvey($survey_id)) {
                    $retdata = array('msg' => 'Error during saving', 'success' => 0);
                }
                echo json_encode($retdata);
            } else {

                echo "Error coming during save";
                exit;
            }
        }
        if (!$internal) {
            exit;
        }
    }

    function index($sid = null) {
        if ($this->aauth->isUser() || $this->aauth->isCustomer()) {
//            $this->surveyCustomer();
        }
        $inner = array();
        $this->load->helper('text');
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $assignToMe = $this->SurveySurveymodel->getAssignedSurvey();
        $inner['tab1'] = 'active';
        $inner['tab2'] = '';
        $inner['tab3'] = '';
        if ($sid) {
            $inner['tab1'] = '';
            $inner['tab2'] = 'active';
            $inner['tab3'] = '';
            $surveyDet = $this->SurveySurveymodel->detailById($sid);
            if (!$surveyDet) {
                redirect('survey/');
            }
        }
        $inner['survryes'] = null;
        $inner['survryes'] = $this->getAllSurveyListHtml();
        $inner['assignToMe'] = $assignToMe;

        $inner['ttlRunning'] = $this->SurveySurveymodel->countRunning();
        $inner['ttlSurvey'] = $this->SurveySurveymodel->countAll();
        $inner['expiredSurvey'] = $this->SurveySurveymodel->getExpiredCount();

        $inner['grapArray'] = array(
            array(
                'name' => 'surveyReportGraph',
                'data' => array(
                    'Running' => $inner['ttlRunning'],
                    'Completed' => $inner['expiredSurvey'],
                //'Complete' => $inner['expiredSurvey']/$inner['ttlSurvey']*100,
                )
            )
        );
        //render view
        $inner['addSureyForm'] = $this->addSurvey(true, $sid);
        $inner['assigns'] = $this->aauth->list_groups();
        $inner['survey_id'] = $sid;
        $page = array();
        $page['content'] = $this->load->view('survey-index', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function delSurvey($sid = null) {
        if (!$sid)
            redirect('/survey');
        $surveyDet = $this->SurveySurveymodel->detailById($sid);
        $data = array('survey_id' => $surveyDet['id']);
        $this->SurveyAnswermodel->deleteRecord($data);
        $this->SurveyQuestionmodel->deleteUpdate($data);
        $data = array('id' => $surveyDet['id']);
        $this->SurveySurveymodel->deleteRecord($data);
        redirect('/survey');
    }

    function getSurveyListHtml($surveyCategId = null) {
        $surveyHtml = null;
        if (!$surveyCategId) {
            $surveyCategId = gParam('categid');
        }
        if ($surveyCategId) {
            $surveyResource = $this->SurveySurveymodel->detailByCategId($surveyCategId);
            if ($surveyResource) {
                foreach ($surveyResource as $key => $value):
                    $surveyHtml .= '<li>'
                            . '<div class="row" style="margin:2px 0;text-align:center;vertical-asign:middle">'
                            . '<span style="float:left">' . $value['name'] . '</span>'
                            . '<span style="margin:0 2px;float:right" data-id="' . $value['id'] . '" '
                            . ' class="btn deactsurvey" >Deactivate</span>'
                            . '<span data-id="' . $value['id'] . '"'
                            . ' class="btn editsurvey" style="margin:0 2px;float:right">Edit</span>'
                            . '<span style="margin:0 2px;float:right" onclick=window.location.assign("' . createUrl('survey/addEditSurvey/' . $value['id']) . '")'
//                            . '<span style="margin:0 2px;float:right" onclick=window.location.assign("' . createUrl('survey/addEditSurvey?surveyid=' . $value['id']) . '")'
                            . ' class="btn editQusSurvey">Add Edit Questions</span>'
                            . '<span style="margin:0 2px;float:right" data-id="' . $value['id'] . '" '
                            . ' class="btn showsurvey" >Preview</span>'
                            . '</div> </li>';
                endforeach;
            }
        }else {
            $surveyHtml = '<li> <div class="row" style="margin:2px 0;text-align:center;vertical-asign:middle">Survey not available </div></li>';
        }
        $ajaxCheck = gParam('isajax');
        if ($ajaxCheck) {
            echo $surveyHtml;
            exit;
        }
        return $surveyHtml;
    }

    function getAllSurveyListHtml() {
        $surveyHtml = '<li> <div class="row" style="margin:2px 0;text-align:center;vertical-asign:middle">Not any server added by you . . . </div></li>';
        $where = array('creator_id' => $this->session->userdata['id']);
        $extra = array('where' => $where);
        $surveyResource = $this->SurveySurveymodel->detailBySurveys($extra);
//        ep($surveyResource);
        if ($surveyResource) {
            $surveyHtml = '<tr style="background: #e1e1e1">
                                <th width="40%">Survey Name</th>
                                <th width="35%">Assigned Group</th>
                                <th>Action</th>
                            </tr>';
//            $surveyHtml = NULL;
            foreach ($surveyResource as $key => $value):
                $surveyHtml .= '<tr>'
                        . '<td>' . $value['name'] . '<br>' . $value['description'] . '</td>
                                <td>' . (is_null($value['assigned_group']) ? '<strong>Not assigned</strong>' : $value['assigned_group']) . '</td>
                                <td>
                                    <i class="fa fa-eye fa-2x green pointe showsurvey" data-id="' . $value['id'] . '" title = "Preview"></i>
                                    <i onclick=window.location.assign("' . createUrl('survey/getReport/' . $value['id']) . '") class="fa fa-th-list fa-2x blue pointe showReport" data-id="' . $value['id'] . '" title = "Report"></i>
                                    <i onclick=window.location.assign("' . createUrl('survey/index/' . $value['id']) . '") 
                                    class="fa fa-edit fa-2x grey pointe editQusSurvey" data-id="' . $value['id'] . '" title = "Edit"></i>
                                    <i onclick=window.location.assign("' . createUrl('survey/delSurvey/' . $value['id']) . '") 
                                    class="fa  fa-trash-o fa-2x red pointe deleteSurvey" data-id="' . $value['id'] . '" title = "Delete"></i>
                                </td>                                                                
                            </tr>';
                /**
                 * "' . createUrl('survey/addEditSurvey?surveyid=' . $value['id']) . '"
                 * "' . createUrl('survey/addEditSurvey/' . $value['id']) . '"
                 */
            endforeach;
        }
        return $surveyHtml;
    }

    function addEditSurvey($sur_id = 0) {
        $page = array();
        $inner = array();
        if ($this->input->post('add-field', true)) {
            if ($this->input->post('edit-field', true)) {
                $this->SurveyQuestionmodel->updateQuestion();
            } else {
                $this->SurveyQuestionmodel->insertQuestion();
            }
            return true;
            redirect('survey/');
        }
        $this->load->helper('text');
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $sId = gParam('surveyid');
        if (!$sId) {
            $sId = $sur_id;
        }
        $survey_id = $sId;
        $inner['survey_id'] = $survey_id;
        if ($survey_id) {
            //    $inner['survey'] = $this->SurveySurveymodel->detailById($survey_id);
            //    $inner['survey'] = $inner['survey'][0];
        }
        $inner['availableElement'] = $this->SurveyFormmodel->getAvaialableElementList(true);
        $inner['availableQuestionValues'] = $this->SurveyQuestionmodel->getSurveyQuestion($survey_id);
        $inner['availableQuestionElement'] = $this->SurveyFormmodel->getExistingQuestionTemp($inner['availableQuestionValues']);
        array_unshift($inner['availableElement'], "Select Element");

        $page['addEdit-ques'] = $this->load->view('add-edit-survey-question', $inner, TRUE);
        return $page;
        $this->load->view($this->default, $page);
    }

    function getDynamicElement() {
        $requestedVar = gParam('element');
        if (!$requestedVar) {
            return FALSE;
        }
        echo json_encode(array('success' => 1, 'html' => $this->SurveyFormmodel->getElement($requestedVar)));
        exit;
    }

    function showSurvey() {
        $page = array();
        $inner = array();
        $surveyId = gParam('surveyId', false, true);
        if (!$surveyId) {
            header(createUrl('survey/'));
        }
        $ispreview = gParam('preview', false, true);
        $inner['ispreview'] = true;
        if (!$ispreview) {
            $inner['ispreview'] = false;
        }
        $inner['survey'] = $this->SurveySurveymodel->detailById($surveyId);
        $surveysQuestion = $this->SurveyQuestionmodel->getSurveyQuestion($surveyId);
        $inner['questionHtml'] = $this->SurveyFormmodel->getHtmlFormOfQuestion($surveysQuestion);

        $page['content'] = $this->load->view('survey-preview', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function saveSurveyAns() {
        $saveSurvey = gParam('saveSurvey');
        if ($saveSurvey) {
            $surveyId = gParam('survey_id');
            foreach ($_POST as $anskey => $ansVal) {
                if (is_array($ansVal)) {
                    $data = array();
                    $data[$this->SurveyAnswermodel->survey_id] = $surveyId;
                    $data[$this->SurveyAnswermodel->user_id] = $this->session->userdata['id'];
                    $data[$this->SurveyAnswermodel->question_id] = $ansVal['id'];
                    $data[$this->SurveyAnswermodel->answer_text] = $ansVal['fld'];
                    $data[$this->SurveyAnswermodel->creation_date] = date('Y-m-d H:i:s');
                    $this->SurveyAnswermodel->insertRecord($data);
                }
            }
        }
        redirect(createUrl('survey'));
    }

    function getGrpOpt($grp = null, $internal = false) {
        $grp;
        if (!$grp) {
            $grp = gParam('grp');
        }
        if (!$grp && !$internal)
            return json_encode(array('succcess' => 0, 'msg' => 'Nothing Find'));
        else if (!$grp && $internal)
            return '';
        $result = $this->usermodel->listAllAsGrp(False, false, 'id, name', array('where' => 'group_id = ' . $grp));
        $datamsg = null;
        $selectRes = array();
        if ($result) {
            foreach ($result as $key => $kval) {
                $selectRes[$kval['id']] = $kval['name'];
            }
        }
        $selectedArr = array();
        if (isset($internal['assignTo'])) {
            $selectedArr = explode(',', $internal['assignTo']);
        }
        $js = 'id="assigne_id" multiple';
        $retHtml = '<div>' . form_dropdown('assigne_id[]', $selectRes, $selectedArr, $js) . '</div>';
        $retHtml .= '<script>
                    $(document).ready(
                            function () {
                                            $("#assigne_id").multiselect({ 
                                            includeSelectAllOption: true,
                                            enableFiltering:true
                                    });
                            }
                        );
                </script>
            ';
        if ($internal) {
            return $retHtml;
        }
        $datamsg = array('success' => 1, 'msg' => $retHtml);
        echo json_encode($datamsg);
        exit;
    }

    function surveyCustomer() {
        $page = array();
        $inner = array();

        $inner['assignToMe'] = $this->SurveySurveymodel->getAssignedSurvey();
        $page['content'] = $this->load->view('survey-user-client', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function getReport($surveyId = null) {
        if (!$surveyId)
            redirect('survey');
        $page = array();
        $inner = array();
        $inner['surveyDetail'] = $this->SurveySurveymodel->detailById($surveyId);
        $inner['surveyDetail']['assigneArray'] = explode(',', $inner['surveyDetail']['assigne_id']);
        //$inner['surveyDetail']['assigneAnsArr'] = $this->SurveyAnswermodel->getSurveyCompleter($surveyId);
        $inner['surveyDetail']['assigneAnsCount'] = $this->SurveyAnswermodel->getSurveyCompleterCount($surveyId);
        //ep($inner['surveyDetail']['assigneAnsCount']);
        $inner['surveyDetail']['assigneAnsUserIds'] = '';
        $inner['survey_question'] = $this->SurveyQuestionmodel->getSurveyQuestion($surveyId);
        $inner['survey_anwser'] = $this->SurveyAnswermodel->getSurveyCompleter($surveyId);
        //ep($inner['survey_anwser']);
        $page['content'] = $this->load->view('survey-report', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function getQusAnsTblView($ques = null, $quesMultiple = null, $quesAnsArr = array(), &$graph = array()) {
        //ep($graph);
        $contName = 'ques_container_' . $ques['id'];
        $tmpHtml = '<div id="sectionMainDiv_1" style="min-height:100px;" display="show">
                        <div class="newReportsTable roundBottomCorners boxShadow _newReportsTable">
                            <table cellspacing="0" cellpadding="0" class="reportSubHeader SurveyReport _reportSubHeader" width="100%">
                                <tbody><tr><td width="90%">' . $ques['question_text'] . '</td></tr>
                                </tbody></table>
                                <table width="100%" 
                                cellspacing="0" 
                                cellpadding="0" 
                                align="center" 
                                style="border-bottom: 1px solid #CCCCCC;padding-bottom:1px;">
                            <tbody><tr>
                                       
                                        <td width="100%" valign="middle">
                                            <div id="' . $contName . '" style="min-height: 400px; 
                                                max-width: 100%; margin: 0 auto"></div>                                            
                                        </td>
                                    </tr>
                            </tbody></table>';
        $graph['name'] = $contName;
        $rowHtml = null;
        foreach ($quesMultiple as $QusKey => $QusKeyVal) {
            $graph['data'][trim($QusKeyVal)] = 0;
            $rowHtml .= '<tr id="ans_row_' . $ques['id'] . '_' . $QusKey . '" class="sl4 _sl4 bold">
                                            <td style="border-right:0px;white-space:nowrap;">(' . ($QusKey + 1) . '): </td>
                                            <td>' . $QusKeyVal . '</td>
                                            <td style="text-align:right;padding-right:15px;">'
                    . $this->getQuestionAnsCount($QusKey, $ques, $quesAnsArr, $graph['data'][trim($QusKeyVal)]
                    ) . '</td>
                                            <td style="text-align:right;padding-right: 15px;">
                                            </td>
                                            <td style="border-right:0px;">                                          
                                            </td>
                                        </tr>';
        }
        $tmpHtml .= '<table class="question_content" width="100%" class="sl3" style="padding:0px; margin:0px;border:0px;" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr class="bold ">
                                            <td style="border-right:0px;width:10px;"> </td>
                                            <td style="width:30%;">Answer</td>
                                            <td style="text-align:right;padding:5px 15px 5px 0;width:100px;">Count</td>
                                            <td style="text-align:right;padding:5px 15px 5px 0;width:100px;">Percent</td>
                                            <td style="border-right:0px;">
                                                <table border="0" width="100%" class="newReportBarTable" cellspacing="0" cellpadding="0">
                                                    <tbody><tr>
                                                        <td style="width:20%">20%</td>
                                                        <td style="width:20%">40%</td>
                                                        <td style="width:20%">60%</td>
                                                        <td style="width:20%">80%</td>
                                                        <td style="width:20%">100% </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>' . $rowHtml . '
                                        </tbody></table>
                            </div>
                        </div>';
        return $tmpHtml;
    }

    function getQuestionAnsCount($qusKey, $ques, $AnsArr, &$graphKey) {
        //echo "<pre>";
        //print_r(func_get_args());
        $qusElem = array('questionKey' => $qusKey, 'questionIndex' => $ques['id']);
        $filteredItems = array_filter($AnsArr, function($elem) use($qusElem) {
            if ($qusElem['questionKey'] == trim($elem['answer_text']) && $elem['question_id'] == $qusElem['questionIndex']
            ) {
                return $elem;
            }
        });
        $graphKey = count($filteredItems);
        return count($filteredItems);
    }

}
