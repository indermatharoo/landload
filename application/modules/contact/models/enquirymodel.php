<?php

class Enquirymodel extends CI_Model {

    public $tbl;

    function __construct() {
        parent::__construct();
        $this->load->model('Emailsmodel');
        $this->tbl = 'enquiry';
    }

    function fetchByName($name) {
        $this->db->like('first_name', $name)
                ->or_like('last_name', $name);
        $rs = $this->db->get($this->tbl);

        if ($rs->num_rows())
            return $rs->result_array();
        return false;
    }

    function fetchByID($primary_id) {
        $this->db->from($this->tbl)
                ->where('id', $primary_id);
        $rs = $this->db->get();
        if ($rs->num_rows()) {
            return $rs->result_array();
        }
        return false;
    }

    function insertRecord() {
//                echo "<pre>";
//                print_r($_REQUEST);
//                die;
        $data = array();
        $numeric = array('receive_update_news', 'enq_reason');

        $data['first_name'] = $this->input->post('first_name', TRUE);
        $data['last_name'] = $this->input->post('last_name', TRUE);
        $data['email_addr'] = strtolower($this->input->post('email_addr', TRUE));
        $data['tel_number'] = $this->input->post('tel_number', TRUE);
        $data['post_code'] = $this->input->post('post_code', TRUE);
        $data['enq_reason'] = $this->input->post('enq_reason', TRUE);
        $data['receive_update_news'] = $this->input->post('receive_update_news', TRUE);
        $data['how_reach'] = $this->input->post('how_reach', TRUE);
        $data['enquiry'] = $this->input->post('enquiry', TRUE);

        /**
         * If any index is has false then empty string assign
         */
        foreach ($data as $key => $val) {
            echo $val;
            die;
            if (!$data[$key]) {
                $data[$key] = '';
            }
            if (in_array($key, $numeric) && empty($data[$key])) {
                $data[$key] = '0';
            }
        }
        $data['event_related'] = setDefault($_POST['event_id'], 0, 1);
        $data['event_id'] = setDefault($_POST['event_id'], 0);
        $data['event_creator_id'] = setDefault($_POST['event_user_id'], 0);

        $data['insert_time'] = date('Y-m-d', NOW());
        $data['next_follow_up'] = $data['insert_time'];
        $status = $this->db->insert($this->tbl, $data);
        if (!$status)
            return false;

        $enquiry_id = $this->db->insert_id();

        //fetch email details
//		$email_dtls = $this->Emailsmodel->fetchDetails('enquiry_registration');
//                
//		//Send Confirmation email
//		$emailData = array();
//		$emailData['DATE'] = date("jS F, Y");
//		$emailData['NAME'] = $data['first_name'].$data['last_name'];
//		$emailData['EMAILADDR'] = $data['email_addr'];		
//
//		$search = array();
//		$replace = array();
//
//		$search[] = '{DATE}';
//		$replace[] = $emailData['DATE'];
//
//		$search[] = '{NAME}';
//		$replace[] = $emailData['NAME'];
//
//		$search[] = '{EMAILADDR}';
//		$replace[] = $emailData['EMAILADDR'];
//                
//		$emailBody = str_ireplace($search, $replace, 
//                                        $email_dtls['email_content']);
//		//print_r($emailBody); exit();
//
//		$this->email->initialize($this->config->item('EMAIL_CONFIG'));
//		$this->email->from(DWS_EMAIL_NOREPLY, DWS_EMAIL_FROM);
//		$this->email->to($data['email_addr']);
//		$this->email->subject($email_dtls['email_subject']);
//		$this->email->message($emailBody);
//		$status = $this->email->send();

        $data['enquiry_id'] = $enquiry_id;
        return $data;
    }

    function insertFranchiseRecord() {
        $data = array();
        $numeric = array('receive_update_news', 'enq_reason');

        $data['first_name'] = $this->input->post('first_name', TRUE);
        $data['last_name'] = $this->input->post('last_name', TRUE);
        $data['email_addr'] = strtolower($this->input->post('email_addr', TRUE));
        $data['tel_number'] = $this->input->post('tel_number', TRUE);
        $data['post_code'] = $this->input->post('post_code', TRUE);
        $data['enq_reason'] = $this->input->post('enq_reason', TRUE);
        $data['receive_update_news'] = $this->input->post('receive_update_news', TRUE);
        $data['how_reach'] = $this->input->post('how_reach', TRUE);
        $data['enquiry'] = $this->input->post('enquiry', TRUE);
        $data['franchise'] = $this->input->post('franchiseeId', TRUE);

        /**
         * If any index is has false then empty string assign
         */
        foreach ($data as $key => $val) {
            if (!$data[$key]) {
                $data[$key] = '';
            }
            if (in_array($key, $numeric) && empty($data[$key])) {
                $data[$key] = '0';
            }
        }
        $data['event_related'] = setDefault($_POST['event_id'], 0, 1);
        $data['event_id'] = setDefault($_POST['event_id'], 0);
        $data['event_creator_id'] = setDefault($_POST['event_user_id'], 0);

        $data['insert_time'] = date('Y-m-d', NOW());
        $data['next_follow_up'] = $data['insert_time'];
        $data['souceSiteUser'] = 3;
        $status = $this->db->insert($this->tbl, $data);
        if (!$status)
            return false;

        $enquiry_id = $this->db->insert_id();

        $data['enquiry_id'] = $enquiry_id;
        return $data;
    }

    function getEnquiryTypeList() {
        $rstSet = $this->db->select('*')
                        ->from('enquiry_types')
                        ->order_by('sort_order')->get();
        if ($rstSet->num_rows()) {
            return $rstSet->result_array();
        }
        return array();
    }

    function getEvent($eid) {
        $this->db->select('eventbooking_events.*,eventbooking_event_type.event_type,aauth_users.name as uname')
                ->where('event_id', $eid)
                ->join('eventbooking_event_type', 'eventbooking_events.event_type_id = eventbooking_events.event_type_id')
                ->join('aauth_users', 'aauth_users.id = eventbooking_events.user_id');
        $result = $this->db->get('eventbooking_events');
        return $result->row_array();
    }

    function insertDownloadinfo() {
        $data = array();

        $data['name'] = $this->input->post('yourname', TRUE);
        $data['email'] = strtolower($this->input->post('youremail', TRUE));
        $data['number'] = $this->input->post('yournumber', TRUE);

        $this->db->insert('download_info', $data);
        return TRUE;
    }

    function insertInfoPack() {
        $data = array();

        $data['first_name'] = $this->input->post('first_name', TRUE);
        $data['last_name'] = $this->input->post('last_name', TRUE);
        $data['email'] = strtolower($this->input->post('email_addr', TRUE));
        $data['contact'] = $this->input->post('tel_number', TRUE);
        $data['address1'] = $this->input->post('address1', TRUE);
        $data['address2'] = $this->input->post('address2', TRUE);
        $data['city'] = $this->input->post('city', TRUE);
        $data['county'] = $this->input->post('county', TRUE);
        $data['post_code'] = $this->input->post('post_code', TRUE);
        $data['verifynumber'] = md5(rand());
        $data['verified'] = 0;
        $status = $this->db->insert('infopack', $data);
        $last_insert_id = $this->db->insert_id();
        if ($status) {
            
            return $last_insert_id;
            
           // $status = $this->email->send();
        } else {
            return false;
        }
    }

    function updateInfoPack($verifynumber) {
        $this->db->from('infopack')->where('verifynumber', $verifynumber);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            $data = array("verified" => 1);
            $this->db->where('verifynumber', $verifynumber);    
            $this->db->update('infopack', $data);
            
        }
        return false;
    }
    
    function getpackinfo($id=NULL){
        $this->db->select('*')
                ->where('id', $id);
        $result = $this->db->get('infopack');
        return $result->row_array();
    }

}

?>
