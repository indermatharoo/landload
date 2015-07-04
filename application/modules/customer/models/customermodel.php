<?php

class Customermodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//fetch by ID
    function fetchByID($cid) {
        $this->db->from('customer');
        $this->db->join('aauth_users', 'aauth_users.id=customer.auth_user_id');
        $this->db->where('aauth_users.id', $cid);
        $rs = $this->db->get();
        if ($rs->num_rows() == 1) {
            return $rs->row_array();
        }
        return false;
    }


    //Insert customer
    function insertRecord() {

        $data = array();
        $data['first_name'] = $this->input->post('first_name', TRUE);
        $data['email'] = $this->input->post('email', TRUE);
        $data['telephone'] = $this->input->post('telephone', TRUE);
        $data['zipcode'] = $this->input->post('zipcode', TRUE);

//        $data['address1'] = $this->input->post('address1', TRUE);
//        $data['address2'] = $this->input->post('address2', TRUE);
//        $data['city'] = $this->input->post('city', TRUE);
//        $data['state'] = $this->input->post('state', TRUE);
//        $data['passwd'] = $this->encrypt->encode($this->input->post('passwd', TRUE));
        //$data['act_code'] = md5(random_string('unique'));
        $data['registration_time'] = time();
        $data['last_login'] = 0;
        $data['cactive'] = 0;

        //insert data into database
        $this->db->insert('customer', $data);


//        $customer_id = $this->db->insert_id();
        //echo $customer_id; exit();
        //Send Confirmation email
        $emailData = array();
        $emailData['DATE'] = date("jS F, Y");
        $emailData['BODY'] = DWS_EMAIL_BODY;
        $emailData['NAME'] = $data['first_name'];
        $emailData['PASSWORD'] = $this->input->post('passwd', TRUE);

//        EMAIL_BODY
        $emailBody = $this->parser->parse('customer/emails/account-created', $emailData, TRUE);
//        print_r($emailBody); exit;
//print_r($this->config->item('EMAIL_CONFIG')); exit();
        $this->email->initialize($this->config->item('EMAIL_CONFIG'));
        $this->email->from(DWS_EMAIL_NOREPLY, DWS_EMAIL_FROM);
        $this->email->to($data['email']);
        //$this->email->to('test@darsh.com');
        $this->email->subject(DWS_EMAIL_SUBJECT);
        $this->email->message($emailBody);
        if ($this->email->send() == true) {
            return true;
        }
    }

}

?>