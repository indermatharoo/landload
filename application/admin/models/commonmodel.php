<?php

class Commonmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get all the rows
    function getAll($table, $where = false, $where_in = array(), $id = 'id', $select = '*') {
        if ($where) {
            $this->db->where($where);
        }
        if (count($where_in)) {
            $this->db->where_in($id, $where_in);
        }
        $this->db->select($select);
        return $this->db->from($table)->get()->result_array();
    }

    function getByPk($id, $table, $where = 'id') {
        if (!$id)
            return false;
        $this->db->where($where, $id);
        $row = $this->db->get($table)->row_array();
        return $row;
    }

    function insertRecord($data, $table) {
        return $this->db->insert($table, $data);
    }

    function updateRecord($data, $id, $table, $where = 'id') {
        $this->db->where($where, $id);
        return $this->db->update($table, $data);
    }

    function delete($id, $table, $pkid = 'id') {
        $this->db->where($pkid, $id);
        $this->db->delete($table);
    }

    function count($table, $where_in = array()) {
        if ($where_in) {
            foreach ($where_in as $key => $value):
                if (!count($value)) {
                    continue;
                }
                $this->db->where_in($key, $value);
            endforeach;
        }
        return $this->db->count_all_results($table);
    }

    function test() {
        e(123);
    }

}
