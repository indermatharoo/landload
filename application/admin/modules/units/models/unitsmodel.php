<?php

class Unitsmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    static public $types = array(
        1 => 'Weekly',
        2 => 'Monthly'
    );

    function countAll($ids = array()) {
        if ($this->aauth->isCompany() || $this->aauth->isUser()):
            $this->db->where_in('company_id', $ids);
        endif;
        $this->db->select('units.id as unit_id,units.*');
        $results = $this->db->get('units')->result_array();
        return count($results);
    }

    function listAll($ids = array()) {
        if ($this->aauth->isCompany() || $this->aauth->isUser()):
         //   $this->db->where_in('company_id', $ids);
        endif;
        $this->db->select('units.id as unit_id,units.*');
        $results = $this->db->get('units')->result_array();
        return $results;
    }

    function getUnitType() {
        return $this->db->get('unit_type')->result_array();
    }

    function getUnitDetails($id) {
        $this->db->where('id', $id);
        $res = $this->db->get('units');
        if ($res->num_rows() > 0) {
            return $res->row_array();
        } else {
            redirect('units/index');
        }
    }
    function getPropertiesType() {
        $res = $this->db->get('properties_type');
        return $res->result_array();
    }
    function insertRecord() {
        $data = array();
        $data = rSF('units');
//        echo "<pre>";
//        print_r($data);
//        die();
        $data['is_active'] = $this->input->post('active');
        $data['description'] = $this->input->post('description');
        $data['datetime'] = date('Y-m-d H:i:s');
        $data['amount_type'] = $this->input->post('amount_type');
        $data['is_featured'] = $this->input->post('is_featured');
        $data['property_type'] = $this->input->post('ptype');
        $data['post_code'] = $this->input->post('post_code');
       // $data['country'] = $this->input->post('country');
       $data['country'] = 'IN';
       // $data['amount'] = $this->input->post('amount');

        $config_slug = array(
            'field' => 'uri',
//        'title' => 'title',
            'table' => 'units',
            'id' => 'id',
        );
        $this->load->library('slug', $config_slug);

        $data_uri = array(
            'title' => $this->input->post('unit_number')
        );
        $data['uri'] = $this->slug->create_uri($data_uri);

        if (!empty($_POST['features'])) {
            $data['features'] = implode($_POST['features'], '|');
        } else {
            $data['features'] = '';
        }
        $config['upload_path'] = $this->config->item('UNIT_IMAGE_PATH');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        $map_img = $_FILES['map_image']['name'];

        if ($map_img != '') {

            if ($_FILES['map_image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['map_image']['tmp_name'])) {
                if (!$this->upload->do_upload('map_image')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['map_image'] = $upload_data['file_name'];
                }
            }
        }

        if (count($_FILES) > 0) {

            //e($_FILES);

            if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                if (!$this->upload->do_upload('photo')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['unit_image'] = $upload_data['file_name'];
                }
            }
        }
        if ($this->aauth->isCompany()):
            $data['company_id'] = curUsrId();
        elseif ($this->aauth->isUser()):
            $data['company_id'] = curUsrPid();
        endif;
        $status = $this->db->insert('units', $data);
      // echo $this->db->last_query();

        if ($status) {
            $unit_id = $this->db->insert_id();
            if ($unit_id) {
                $attributes = (gParam('attributes') ? gParam('attributes') : array());
                foreach ($attributes as $key => $value):
                    $data = array();
                    $data['unit_id'] = $unit_id;
                    $data['attribute_id'] = $key;
                    $data['value'] = $value;
                    $this->db->insert('units_attributes_value', $data);
                endforeach;
            }
        }
        $unit_id = $this->db->insert_id();
        $this->upload->initialize(array(
            "upload_path" => $this->config->item('UNIT_IMAGE_PATH'),
            'allowed_types' => 'gif|jpg|png'
        ));
        if ($this->upload->do_multi_upload("galleryImages")) {
            //Print data for all uploaded files.

            foreach ($this->upload->get_multi_upload_data() as $images) {
                $this->db->insert('unit_image', array('image' => $images['file_name'], 'unit_id' => $unit_id));
            }
        }
    }

    function getImageName($id) {
        $this->db->where('image_id', $id);
        return $this->db->get('unit_image')->row_array();
    }

    function updateRecord($id) {

        if (isset($_POST['deleteImage'])) {
            foreach ($_POST['deleteImage'] as $delImg) {
                $imgar = $this->getImageName($delImg);
                @unlink($this->config->item('UNIT_IMAGE_PATH') . $imgar['image']);
                $this->db->where('image_id', $delImg);
                $this->db->delete('unit_image');
            }
        }
        $data = array();


        $config['upload_path'] = $this->config->item('UNIT_IMAGE_PATH');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        $config_slug = array(
            'field' => 'uri',
//            'title' => 'title',
            'table' => 'units',
            'id' => 'id',
        );
        $this->load->library('slug', $config_slug);

        $data_slug = array(
            'title' => $this->input->post('unit_number'),
        );
        $data['uri'] = $this->slug->create_uri($data_slug, $id);

        $map_img = $_FILES['map_image']['name'];

        if ($map_img != '') {
            $mainimage = $this->getUnitDetails($id);
            @unlink($this->config->item('UNIT_IMAGE_PATH') . $mainimage['map_image']);

            if ($_FILES['map_image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['map_image']['tmp_name'])) {
                if (!$this->upload->do_upload('map_image')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['map_image'] = $upload_data['file_name'];
                }
            }
        }

        if (!empty($_FILES['photo']['name'])) {

            $mainimage = $this->getUnitDetails($id);
            @unlink($this->config->item('UNIT_IMAGE_PATH') . $mainimage['unit_image']);

            if (count($_FILES) > 0) {
                if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                    if (!$this->upload->do_upload('photo')) {
                        show_error($this->upload->display_errors('<p class="err">', '</p>'));
                        return FALSE;
                    } else {
                        $upload_data = $this->upload->data();
                        $data['unit_image'] = $upload_data['file_name'];
                    }
                }
            }
        }
        $data['unit_number'] = $this->input->post('unit_number');
        $data['property_type'] = $this->input->post('ptype');
        $data['owner'] = $this->input->post('owner');
        $data['owner'] = $this->input->post('owner');
        $data['street'] = $this->input->post('street');
        $data['city'] = $this->input->post('city');
        $data['country'] = $this->input->post('country');
        $data['status'] = $this->input->post('status');
        $data['amount'] = $this->input->post('amount');
        $data['amount_type'] = $this->input->post('amount_type');
        $data['unit_type'] = $this->input->post('unit_type');
        $data['is_active'] = $this->input->post('active');
        $data['description'] = $this->input->post('description');
        $data['is_featured'] = $this->input->post('is_featured');
        $data['post_code'] = $this->input->post('post_code');

        if (!empty($_POST['features'])) {
            $data['features'] = implode($_POST['features'], '|');
        }
        $this->db->where('id', $id);
        $status = $this->db->update('units', $data);
        if ($status) {
            $unit_id = $id;
            if ($unit_id) {
                $this->db->where('unit_id', $unit_id);
                $this->db->delete('units_attributes_value');
                $attributes = (gParam('attributes') ? gParam('attributes') : array());
                foreach ($attributes as $key => $value):
                    $data = array();
                    $data['unit_id'] = $unit_id;
                    $data['attribute_id'] = $key;
                    $data['value'] = $value;
                    $this->db->insert('units_attributes_value', $data);
                endforeach;
            }
        }
        $this->load->library('upload', $config);
        $this->upload->initialize(array(
            "upload_path" => $this->config->item('UNIT_IMAGE_PATH'),
            'allowed_types' => 'gif|jpg|png'
        ));
        if ($this->upload->do_multi_upload("galleryImages")) {
            //Print data for all uploaded files.

            foreach ($this->upload->get_multi_upload_data() as $images) {
                $this->db->insert('unit_image', array('image' => $images['file_name'], 'unit_id' => $id));
            }
        }
    }

    function DeleteRecord($id) {
        $mainimage = $this->getUnitDetails($id);
        @unlink($this->config->item('UNIT_IMAGE_PATH') . $mainimage['unit_image']);
        $this->db->where('id', $id);
        $this->db->delete('units');

        $imgar = $this->getUnitImages($id);
        print_r($imgar);
        foreach ($imgar['result'] as $img) {
            @unlink($this->config->item('UNIT_IMAGE_PATH') . $img['image']);
        }



        $this->db->where('unit_id', $id);
        $this->db->delete('unit_image');
    }

    function getUnitImages($id) {
        $this->db->where('unit_id', $id);
        $res = $this->db->get('dpd_unit_image');
        return array('num_rows' => $res->num_rows(), 'result' => $res->result_array());
    }
    function getCountrydata()
    {
        $this->db->select('iso,nicename');
        $res = $this->db->get('country');
        return $res->result_array();
    }
    function getUnitsByPropertyId($id) {
   
        $res = $this->db->get('units');
        return $res->result_array();
    }

}
