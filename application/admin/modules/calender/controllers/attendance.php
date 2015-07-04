<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendance extends Admin_Controller {

    function __construct() {
        parent::__construct();
        isLogged();
        $this->load->model('user/usermodel');
    }

    function index($eid = FALSE) {
        $this->load->model('Attendancemodel');
        $inner['attendanc'] = $this->Attendancemodel->getAll($eid);
        $page = array();
        $page['content'] = $this->load->view('calender/attendance/attendance-index', $inner, TRUE);
        $this->load->view($this->event, $page);
    }

    function ticket() {
        $this->load->model('Attendancemodel');
        $status = $this->Attendancemodel->saveAttendance();
        echo json_encode($status);
    }

}

?>