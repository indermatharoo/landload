<?php

class Customermodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//fetch by ID
    function fetchByID($cid) {
        $this->db->from('applicants');
        $this->db->where('applicant_id', $cid);
        $rs = $this->db->get();
        if ($rs->num_rows() == 1) {
            return $rs->row_array();
        }
        return false;
    }

    //Insert customer
    function insertRecord() {

        $data = array();
        $data['fname'] = $this->input->post('fname', TRUE);
        $data['lname'] = $this->input->post('lname', TRUE);
        $data['email'] = $this->input->post('email', TRUE);
        $data['phone'] = $this->input->post('phone', TRUE);
//        $data['password'] = $this->encrypt->encode($this->input->post('password', TRUE));
        $data['password'] = md5($this->input->post('password', TRUE));
        $data['address'] = $this->input->post('address', TRUE);
        $data['is_active'] = 1;
        $data['license'] = 0;
        $data['monthly_gross'] = 0;
        $data['asset'] = 0;
        $data['type'] = 'applicant';
//        e($data);
//        $data['auth_user_id'] = 0;
        
        //insert data into database
        $status = $this->db->insert('applicants', $data);

        if ($status = 1) {
            //Send Confirmation email
            $emailData = array();
            $emailData['DATE'] = date("jS F, Y");
//            $emailData['BODY'] = DWS_EMAIL_BODY;
            $emailData['NAME'] = $data['fname'] . ' ' . $data['lname'];
            $emailData['USERID'] = $data['email'];
            $emailData['PASSWORD'] = $this->input->post('password', TRUE);

//        EMAIL_BODY
            $emailBody = $this->parser->parse('customer/emails/account-created', $emailData, TRUE);
            
            $this->email->initialize($this->config->item('EMAIL_CONFIG'));
            $this->email->from(DWS_EMAIL_NOREPLY, DWS_EMAIL_FROM);
            $this->email->to($data['email']);
            //$this->email->to('test@darsh.com');
            $this->email->subject('Success Registeration Mail');
            $this->email->message($emailBody);
            $this->email->send();
            if ($this->email->send() == true) {
                return true;
            }
            return $status;
        }
    }

}

?>