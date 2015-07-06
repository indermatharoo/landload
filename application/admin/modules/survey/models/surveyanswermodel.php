<?php

/**
 *  survey_answer
 * 
    `id`
    `user_id`
    `answer`
    `start_id`
    `survey_id`
    `question_id`
    `answer_text`
    `answer_field`
    `creation_date`
 */
class SurveyAnswermodel extends CI_Model {
	
    public $id;
    public $user_id;
    public $answer;
    public $start_id;
    public $survey_id;
    public $question_id;
    public $answer_text;
    public $answer_field;
    public $creation_date;

    function __construct() {
        parent::__construct();
        $this->id = 'id';
        $this->user_id = 'user_id';
        $this->answer = 'answer_id';
        $this->start_id = 'start_id';
        $this->survey_id = 'survey_id';;
        $this->question_id = 'question_id';
        $this->answer_text = 'answer_text';
        $this->answer_field = 'answer_field';
        $this->creation_date = 'creation_date';
    }

   function insertRecord($param = array()){
       $this->db->insert('survey_answer', $param);
   }
   
    function deleteRecord($data = array()){
        if(!$data) return false;        
        foreach($data as $key => $kval ){
            $this->db->where($key, $kval );   
        }        
        $this->db->delete('survey_answer');
    }
    
    function getSurveyCompleter($surId = null){
        if(!$surId) return 0;
        $rest = $this->db->select('survey_answer.*,'.$this->aauth->config_vars['users'].'.name')
                        ->from('survey_answer')
                        ->join( $this->aauth->config_vars['users'],
                                'survey_answer.user_id='.$this->aauth->config_vars['users'].'.id', 'LEFT')
                        ->where('survey_id', $surId)
                        ->get();
        if($rest->num_rows()){
            return $rest->result_array();
        }
        return array();
        
    }
    
    function getSurveyCompleterCount($surId = null){
        if(!$surId) return 0;
        $rest = $this->db->select(' distinct(user_id) ')
                        ->from('survey_answer')
                        ->where('survey_id', $surId)
                        ->get();
        if($rest->num_rows()){
            return $rest->result_array();
        }
        return array();
        
    }    
}