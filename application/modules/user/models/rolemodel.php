<?php

class Rolemodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //Count All Records
    function countAll() {
        $this->db->from('role');
        return $this->db->count_all_results();
    }

    //List All Records
    function listAll($offset = FALSE, $limit = FALSE) {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);

        $rs = $this->db->get('role');
        return $rs->result_array();
    }

    function fetchByID($uid) {
        $this->db->where('role_id', intval($uid));
        $rs = $this->db->get('role');
        if ($rs && $rs->num_rows() == 1)
            return $rs->row_array();

        return FALSE;
    }

    //Get Current Permission
    function getPermissions($uid) {
        $this->db->select('*');
        $this->db->from('permission');
        $this->db->join('role', 'role.role_id = permission.role_id');
        $this->db->where('permission.role_id', intval($uid));
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();

        return FALSE;
    }

    //List Protected Resources
    function listProtectedResources() {
        $rs = $this->db->get('protected_resource');
        return $rs->result_array();
    }

    function addRole() {
        $data = array();
        $data['role'] = $this->input->post('role', true);
        $this->db->insert('role', $data);
    }

    function updateRole($role) {
        $data = array();
        $data['role'] = $this->input->post('role', true);
        $this->db->where('role_id', $role['role_id']);
        $this->db->update('role', $data);

        if ($role['role_id'] == 1)
            return;

        //Delete the previous permission of user
        $this->db->where('role_id', $role['role_id']);
        $this->db->delete('permission');

        //Add user permission
        if ($this->input->post('protected_resource_id', true)) {
            foreach ($this->input->post('protected_resource_id', true) as $item) {
                $resource = array();
                $resource['role_id'] = $role['role_id'];
                $resource['protected_resource_id'] = $item;
                $this->db->insert('permission', $resource);
            }
        }
    }

    //Delete User
    function deleteRole($user) {
        $this->db->where('role_id', $user['role_id']);
        $this->db->delete('role');

        $this->db->where('role_id', $user['role_id']);
        $this->db->delete('user');

        $this->db->where('role_id', $user['role_id']);
        $this->db->delete('permission');
    }

}

?>