<?php

class frontend extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function sideEventsLinks() {
        ini_set('display_errors', 'On');
        $table_name = 'front_events';
        $inner = $page = array();
        $inner['labels'] = array(
            'Content',
            'Color',
            'Pic',
            'Link',
            'Action'
        );
        $inner['models'] = $this->commonmodel->getAll('front_events');
        $page['content'] = $this->load->view('sideEventsLinks', $inner, true);
        $this->load->view($this->default, $page);
    }

    function addsidelinks($id = null) {
        $model = $this->commonmodel->getByPk($id, 'front_events');
        $inner = $page = array();
        if (gParam('color')) {
//            gAParams();
            $data = rSF('front_events');
            $data['user_id'] = curUsrId();
            if (isset($_FILES['image']['name'])) {
                $data['pic'] = self::uploadImage();
            }
            if (!$id)
                $result = $this->commonmodel->insertRecord($data, 'front_events');
            else
                $result = $this->commonmodel->updateRecord($data, $id, 'front_events');
            if ($result) {
                redirect(createUrl('frontend/sideEventsLinks'));
            }
        }
        $inner['model'] = $model;
        $page['content'] = $this->load->view('addsidelinks', $inner, true);
        $this->load->view($this->default, $page);
    }

    private function uploadImage() {
        $config['upload_path'] = $this->config->item('SIDELINKS');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
        if (count($_FILES) > 0) {
//            e($config);
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['image']['tmp_name'])) {
                if (!$this->upload->do_upload('image')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    return $upload_data['file_name'];
                }
            }
        }
        return false;
    }

    function delete($id = null) {
        if (!$id)
            return false;
        $this->commonmodel->delete($id, 'front_events');
        redirect(createUrl('frontend/sideEventsLinks'));
    }

}
