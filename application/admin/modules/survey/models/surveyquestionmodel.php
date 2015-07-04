<?php

/**
 * survey_question
 * 
        id
        survey_id
        question_type
        question_text
        creation_date
        update_date
        sort_order
        is_active
        numeric
        required 
        class 
        fieldid
 * 
 * 
 */

class SurveyQuestionmodel extends CI_Model {

    private $id;
    private $survey_id;
    private $is_active;
    private $sort_order;
    private $update_date;
    private $numeric;
    private $required ;
    private $class;
    private $fieldid;
    private $question_type;
    private $question_text;
    private $creation_date;   
    
    function __construct() {
        parent::__construct();
        $this->load->model('SurveyFormmodel');
        $this->id = 'id';
        $this->is_active = 'is_active';   
        $this->survey_id = 'survey_id';
        $this->sort_order = 'sort_order';
        $this->update_date = 'update_date';
        $this->question_type = 'question_type';
        $this->question_text = 'question_text';
        $this->creation_date = 'creation_date';
        $this->numeric = 'numeric';
        $this->required = 'required';
        $this->class = 'class';
        $this->fieldid = 'fieldid';
    }
    
    function getSurveyQuestion($surveyId = null){ 
        if(!$surveyId) return array();
        $this->db->where($this->survey_id, $surveyId);
        $rs = $this->db->get('survey_question');
        if ($rs->num_rows()) {
            return $rs->result_array();
        }
        return array();
    }
    
    function getSurveyAnswer($surveyId = null){ 
        if(!$surveyId) return array(); 
        $this->db->where($this->survey_id, $surveyId);
        $rs = $this->db->get('survey_answer');
        if ($rs->num_rows()) {
            return $rs->result_array();
        }
        return array();
    }
    
    function insertQuestion(){
        $data = array();
        $forSurvey = $_POST['survey_id'];
        foreach($_POST as $postkey => $postval){
            if(!is_numeric($postkey))  continue;
            if(is_array($postval)){                
                $questionArr = $this->getQuestionInsertArray($postval);
                $questionArr['survey_id'] = $forSurvey;                
                $questionArr[$this->update_date] = date('Y-m-d H:i:s');
                $questionArr[$this->creation_date] = date('Y-m-d H:i:s');
                $data[] = $questionArr;
            }
        }
        foreach($data as $inserArr){                
            $this->db->insert('survey_question', $inserArr);
        }
    }

    function recordUpdate($on = array(), $data = array()){
        if(!count($on)) return false;        
        $this->db->where($on['fld'], $on['fldval'])->update('survey_question', $data);        
    }
    function deleteUpdate($data = array()){
        if(!$data) return false;        
        foreach($data as $key => $kval ){
            $this->db->where($key, $kval );   
        }        
        $this->db->delete('survey_question');
    }    
    function updateQuestion(){
        $surveyId = gParam('survey_id');
        if(!$surveyId) {
            $surveyId = $_POST['survey_id'];
        }
        if(!$surveyId) return false;
        
        $data[$this->is_active] = '0';
        $on = array('fld' => $this->survey_id, 'fldval' => $surveyId);
        $this->recordUpdate($on, $data);
        
        $data = array();
        foreach($_POST as $postkey => $postval){            
            if(is_array($postval)){
                if(!is_numeric($postkey)) continue;
                if(isset($postval['dbid'])){
                    $questionArr = $this->getQuestionInsertArray($postval);
                    $questionArr['survey_id'] = $surveyId;
                    $questionArr[$this->is_active] = '1';
                    $questionArr[$this->update_date] = date('Y-m-d H:i:s');                    
                    $on = array('fld' => $this->id, 'fldval' => $postval['dbid']);
                    $this->recordUpdate($on, $questionArr);
                }else{
                    $questionArr = $this->getQuestionInsertArray($postval);
                    $questionArr['survey_id'] = $surveyId;
                    $questionArr[$this->is_active] = '1';
                    $questionArr[$this->update_date] = date('Y-m-d H:i:s');
                    $questionArr[$this->creation_date] = date('Y-m-d H:i:s');                    
                    $this->db->insert('survey_question', $questionArr);
                }
            }
        }
        $data = array(  'survey_id' => $surveyId,
                        $this->is_active => 0
                    );
        $this->deleteUpdate($data);        
    }
    
    function getQuestionInsertArray($questionField = array(), $decode = false){
        $question = array();
        if(!count($questionField)){
            return $question;
        }
        $variableList = $this->SurveyFormmodel->getElemVariableList($questionField['question_type']);
        foreach($variableList as $key){
            switch($key):
                case 'multiopt':
                    $question[$key] = isset($questionField[$key]) 
                            ? $decode 
                                ? unserialize($questionField[$key])
                                : serialize(explode(',',$questionField[$key]))
                            : '0';
                break;
                default :
                $question[$key] = isset($questionField[$key]) 
                            ? $questionField[$key] : '0';
                break;
            endswitch;
        }
        return $question;
    }        
}
?>