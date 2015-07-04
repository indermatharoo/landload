<?php

class Notificationmodel extends CI_Model {

    private $tbl;
    private $id;
    private $active;
    private $display_class_name;
    private $class;
    private $display_action_name;
    private $action;
    private $msg;
    private $grp;
    private $assigne;
    private $display_order;

    function __construct() {
        parent::__construct();
        $this->tbl = 'notification_rules';
        $this->id = 'id';
        $this->display_class_name = 'display_class_name';
        $this->class = 'class';
        $this->display_action_name = 'display_action_name';
        $this->action = 'action';
        $this->msg = 'msg';
        $this->grp = 'grp';
        $this->assigne = 'assigne';
        $this->display_order = 'display_order';
        $this->active = 'active';
    }

    //list all
    function getRow($unique_id) {
        $rs = $this->db->where($this->id, $unique_id)->get($this->tbl);
        if ($rs->num_rows())
            return $rs->row_array();
        return array();
    }    
    
    //list all
    function listAll($offset = FALSE, $limit = FALSE) {
        $rs = $this->db->order_by($this->display_order)->get($this->tbl);
        if ($rs->num_rows())
            return $rs->result_array();
        return array();
    }

    function updateBatch($data = array()) {
        if(!isset($_POST[$this->grp])){
            return ;
        }
        $data = array();        
        foreach ($_POST as $k => $val_pair) {
            if ($k == 'grp') {
                foreach ($val_pair as $id => $id_val) {
                    $assignes = '';
                    if (isset($_POST[$this->assigne][$id])) {
                        if (is_array($_POST[$this->assigne][$id])) {
                            $assignes = implode(',', $_POST[$this->assigne][$id]);
                        }                        
                        $data[] = array(
                            $this->id => $id,
                            $this->grp => $_POST[$this->grp][$id],
                            $this->active => isset($_POST[$this->active][$id])?$_POST[$this->active][$id]:0,
                            $this->assigne => setDefault($assignes, ''),
                            $this->msg => setDefault($_POST[$this->msg][$id], ''),
                        );
                    }
                }
            } else
                continue;
        }
        $this->db->update_batch($this->tbl, $data, $this->id);        
    }

    //insert record
    function insertRecord() {
        return;
    }

    //update record
    function updateRecord($news) {
//        die("Update pending");
        return;
    }

    //Function Delete Record
    function deleteRecord($news) {        
        return false;
    }

}
