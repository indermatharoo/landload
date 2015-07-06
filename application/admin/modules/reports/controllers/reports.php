<?php

class Reports extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('reportsmodel');
    }

    public function index() {
        $this->reportsmodel->getTargetPerformance();
    }

    public function franchisesTarget($targetid = 1) {
        if (!$this->aauth->isFranshisor()):
            return false;
        endif;
        if (count($_POST) > 1) {
            foreach ($_POST as $key => $value):
                if (!$value) {
                    continue;
                }
                $keys = explode('-', $key);
                $params['user_id'] = $keys[0];
                $params['event_type'] = $keys[1];
                $params['target_id'] = $keys[2];
                $params[$keys[3]] = $value;
                if ($keys[3] == 'no_of_customer') {
                    unset($params['no_of_event']);
                }
                $this->reportsmodel->updateOrCreateTraget($params);
            endforeach;
//            e($this->db->last_query());
        }
        $inner = $page = array();
        $inner['franchise'] = $this->reportsmodel->getAllFranchise();
        $inner['models'] = $this->reportsmodel->franchiseTargets();
        $inner['targetTypes'] = $this->usermodel->getTargetTypes();
        $inner['targetPerformance'] = $this->reportsmodel->getTargetPerformance();
        $inner['targetid'] = $targetid;
//        e($inner['targetPerformance']);
        $page['content'] = $this->load->view('franchisor/bulktargets', $inner, true);
        $this->load->view($this->dashboard, $page);
//        $this->load->view($this->default, $page);
    }

}
