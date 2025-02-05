<?php

class VirtualCabinetmodel extends CI_Model {

    public $id;
    public $assignes;
    public $filetype;
    public $creator_id;
    public $actual_name;
    public $visible_name;
    public $create_dtime;
    public $update_dtime;
    public $assigne_grp;
    public $tblalias;

    function __construct() {
        parent::__construct();

        $this->tblalias = 'virtualCab';

        $this->id = 'id';
        $this->assignes = 'assignes';
        $this->filetype = 'filetype';
        $this->creator_id = 'creator_id';
        $this->actual_name = 'actual_name';
        $this->update_dtime = 'update_dtime';
        $this->visible_name = 'visible_name';
        $this->create_dtime = 'create_dtime';
        $this->assigne_grp = 'assigne_grp';
    }

    function insertRecord($param = array(), $insert = false) {
        if ($insert) {
            $this->db->insert($this->tblalias, $param);
            return $this->db->insert_id();
        }
    }

    function updateRecord($param = array()) {
        return $this->db->where('id', $param['id'])
                        ->update($this->tblalias, $param['data']);
    }

    function countAll() {
        $this->db->from($this->tblalias);
        return $this->db->count_all_results();
    }

    //List All Records
    function listAll($offset = FALSE, $limit = FALSE, $param = array()) {
//        e($param);
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        if ($this->aauth->isCustomer()):
            $this->db->where('is_applicant', 1);
        endif;
        if (isset($param['columns'])) {
            $this->db->select($param['columns']);
        }
        if (isset($param[$this->creator_id])) {
            $this->db->where($this->creator_id, $param[$this->creator_id]);
        }
        if (isset($param['searchKey'])) {
            $this->db->like($this->actual_name, $param['searchKey'], 'both');
        }
        if (isset($param[$this->assignes])) {
            $this->db->like($this->assignes, $param[$this->assignes], 'after')
                    ->or_like($this->assignes, ',' . $param[$this->assignes], 'before')
                    ->or_like($this->assignes, ',' . $param[$this->assignes] . ',', 'both');
        }
        if (isset($param['shared'])) {
            $this->db->join('aauth_users', $this->creator_id . '=aauth_users.id', 'LEFT');
        }
        if (isset($param['order-field'])) {
            $this->db->order_by($param['order-field'], ($param['order-by'] ? $param['order-by'] : ' desc '
            ));
        }
        if (isset($param['group'])) {
            $this->db->group_by($param['group']);
        }
        $rs = $this->db->get($this->tblalias);
        return $rs->result_array();
    }

    function fetchByID($uid) {
        $this->db->where('id', intval($uid));
        $rs = $this->db->get($this->tblalias);
        if ($rs && $rs->num_rows() == 1)
            return $rs->row_array();
        return FALSE;
    }

    function fetchFilesByID($uid) {
        $this->db->where('id', intval($uid));
        $rs = $this->db->get($this->tblalias);
        if ($rs && $rs->num_rows() == 1)
            return $rs->row_array();
        return FALSE;
    }

    function deleteByID($fid) {
        $this->db->where('id', $fid);
        $this->db->delete($this->tblalias);
    }

    function getAllGroupBy($fld = null) {
        if (!$fld)
            return false;
        $rs = $this->db->select('count(id) as total,' . $fld)
                        ->group_by($fld)->from($this->tblalias)->get();
        if ($rs)
            return $rs->result_array();
        return FALSE;
    }

}
