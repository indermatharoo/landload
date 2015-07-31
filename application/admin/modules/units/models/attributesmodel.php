<?php

class Attributesmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function findAll() {
        $results = $this->db->get('units_attributes')->result_array();
        return $results;
    }

    function save() {
        
        $data = rSF('units_attributes');
        
        
        $id = gParam('id');
        if ($id) {
           
            if(isset($_POST['deldrop']))
            {
                $ids = array_filter($_POST['deldrop']);
                foreach($ids as $delIds)
                {
                    if(trim($delIds)!="")
                    {
                        $this->db->where('id',$delIds);
                        $this->db->delete('units_attributes_dropdown');
                    }
                }
            }
            if(isset($_POST['drop']))
            {
                foreach(array_filter($_POST['drop']) as $dropdwn)
                {
                    if(trim($dropdwn)!="")
                    {
                        $this->db->insert('units_attributes_dropdown',array('dropdown_id'=>$id,'value'=>$dropdwn,'sort'=>0));
                    }
                }
            }
             //e($_POST);
            $this->db->where('id', $id);
            $this->db->update('units_attributes', $data);
            $this->session->set_flashdata('SUCCESS', 'attribute_updated');
        } else {
            $this->db->insert('units_attributes', $data);
            $lastDrodown = $this->db->insert_id();
            if($data['type']=="dropdown")
            {
                foreach(array_filter($_POST['drop']) as $dropdwn)
                {
                    if(trim($dropdwn)!="")
                    {
                        $this->db->insert('units_attributes_dropdown',array('dropdown_id'=>$lastDrodown,'value'=>$dropdwn,'sort'=>0));
                    }
                }
            }
            $this->session->set_flashdata('SUCCESS', 'attribute_added');
        }
    }

    function getAttributes($key) {
        $this->db->where('unit_type', $key);
//        $this->db->order('sort','asc');
        $result = $this->db->from('units_attributes')->get()->result_array();
        return $result;
    }

    function getAttributeValue($unit_id, $type) {
        $this->db->select('t1.*,t2.value');
        $this->db->from('units_attributes t1');
        $this->db->join('units_attributes_value t2', 't1.id=t2.attribute_id and t2.unit_id=' . $unit_id, 'left');
        if ($type)
            $this->db->where('unit_type', $type);
        $results = $this->db->get()->result_array();
        return $results;
    }
    function getDropdownExists($id)
    {
        $this->db->where('dropdown_id',$id);
        $res = $this->db->get('units_attributes_dropdown');
        
        return array('num_rows'=>$res->num_rows(),'result'=>$res->result_array());
    }
}
