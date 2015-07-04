<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notificationpanel extends Admin_Controller {

    function __construct() {                
        parent::__construct();        
        if (!$this->aauth->isAdmin()) {
            redirect('user/dashboard');
        }        
        
        $this->load->helper('text');
        $this->load->library('pagination');        
        $this->load->library('form_validation');        
        $this->load->model('Notificationmodel');
        $this->load->model('user/usermodel');
    }

    //function index
    function index($offset = 0) {        
        $inner = array();        
        //Fetch Notification
        $inner['notification'] = $this->Notificationmodel->listAll();
        $inner['group'][2] 
                                = $this->getArray(
                                            $this->usermodel->listAllAsGrp(False, false, 'id, name', array('where' => 'group_id = 2')),
                                            'id',
                                            'name'
                                        );
        $inner['group'][3] 
                                = $this->getArray(
                                            $this->usermodel->listAllAsGrp(False, false, 'id, name', array('where' => 'group_id = 3')),
                                            'id',
                                            'name'
                                        );
        $inner['group'][5] 
                                = $this->getArray(
                                            $this->usermodel->listAllAsGrp(False, false, 'id, name', array('where' => 'group_id = 5')),
                                            'id',
                                            'name'
                                        );
        $inner['group'][6]
                                = $this->getArray(
                                            $this->usermodel->listAllAsGrp(False, false, 'id, name', array('where' => 'group_id = 6')),
                                            'id',
                                            'name'
                                        );        
        $inner['group']['allgrp'] = $this->aauth->list_group_key_pair_form();
        $page = array();
        $page['content'] = $this->load->view('notification-listing', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    //function add
    function add() {
        $this->Notificationmodel->updateBatch();        
        redirect('notificationpanel');
    }

    //function edit
    function edit($nid) {
        
    }

    //function delete
    function delete($nid) {
        
    }

    function getGrpOpt($elementId = null, $grp = null, $internal = false) {
        $grp;
        if (!$grp) {
            $grp = gParam('grp');
        }        
        if (!$grp && !$internal) {
            $selectRes = array();
            echo json_encode(array('success' => 0, 'msg' => 'Please choose group'));
            exit;
        }
        else if (!$grp && $internal){
            return '';            
        }
        
        $rule_grp_row = array();
        if($grp == 'allgrp'){
           $result = $this->aauth->list_groups(true);
           $rule_row = $this->Notificationmodel->getRow($elementId);
           $rule_grp_row = explode(',', $rule_row['for_group']);
        }else
            $result = $this->usermodel->listAllAsGrp(False, false, 'id, name', array('where' => 'group_id = ' . $grp));
        
        $datamsg = null;
        $selectRes = array();
        if ($result) {
            foreach ($result as $key => $kval) {
                if(count($rule_grp_row) && !in_array($kval['id'], $rule_grp_row)){
                    continue;
                }
                $selectRes[$kval['id']] = $kval['name'];
            }
        }

        $selectedArr = array();
        if (isset($internal['assignTo'])) {
            $selectedArr = explode(',', $internal['assignTo']);
        }
        $js = 'id="assigne-'.$elementId.'" multiple class="assigne form-control" data-id="'.$elementId.'"';
        $retHtml = form_dropdown('assigne['.$elementId.'][]', $selectRes, $selectedArr, $js);
        $retHtml .= '<script>
                        $(document).ready(
                            function () {
                                            $(".assigne").multiselect({ 
                                            includeSelectAllOption: true,
                                            enableFiltering:true
                                    });
                            }
                        );
                    </script>';
        if ($internal) {
            return $retHtml;
        }
        $datamsg = array('success' => 1, 'msg' => $retHtml);
        echo json_encode($datamsg);
        exit;
    }
    
    function getArray($array = array(), $index = null, $value = null){
        
        if(is_array($array)){            
            $localArr = array();
            foreach($array as $key => $val){
                $localArr[$val[$index]] = $val[$value];
            }
            return $localArr;
        }
        return $array;
    }
}