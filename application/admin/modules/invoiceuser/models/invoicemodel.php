<?php

class Invoicemodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function getFranshiseType($fid=NULL){
        if($fid==''){
            $this->db->select('count(*) as total,mon_fee_type');
            $this->db->from('user_extra_detail');
            $this->db->group_by('mon_fee_type'); 
            $query = $this->db->get();
            if ( $query->num_rows() > 0 )
            {
                $row = $query->result_array();
                return $row;
            }
            return false;
        }
        else
        {
            $this->db->select('user_extra_detail.*, aauth_users.email');
            $this->db->from('user_extra_detail');
            $this->db->join('aauth_users','user_extra_detail.id=aauth_users.id');
            $this->db->where('user_extra_detail.id',$fid); 
            $query = $this->db->get();
            if ( $query->num_rows() > 0 )
            {
                $row = $query->row();
                return $row;
            }
            return false;
        }
        

    }
    
    function getType() {
        $result = $this->db->get('eventbooking_event_type');
        return $result->result_array();
    }

//    function getCategory() {
//        $result = $this->db->get('eventbooking_categories');
//        return $result->result_array();
//    }

    function getPrice($eid) {
        $this->db->where('event_id', $eid);
        $result = $this->db->get('eventbooking_prices');
       
        return $result->result_array();
    }

    function countAll() {
        return $this->db->count_all_results('user_extra_detail');
//        $this->db->get('user_extra_detail');
//        return $this->db->count_all_results();
    }
    
    function getWeeklyInvoice(){
        $sql_query = $this->db->query("SELECT invoice_id,id,invoice_code,concat(week(created_on),year(created_on)) as test, week(created_on) as week, year(created_on) as year, SUM(total_amount) as final_price, SUM(IF(is_paid = '1', total_amount, 0)) AS 'paid_amount',SUM(IF(is_paid = '0', total_amount, 0)) AS 'unpaid_amount' FROM dpd_invoice_new  WHERE 1 and invoice_type='W'  GROUP BY test");
        return $sql_query->result_array();
    }
    
    function getMonthlyInvoice(){
        $sql_query = $this->db->query("SELECT  invoice_id,id,invoice_code,concat(month(created_on),year(created_on)) as test, month(created_on) as month, year(created_on) as year, SUM(total_amount) as final_price, SUM(IF(is_paid = '1', total_amount, 0)) AS 'paid_amount',SUM(IF(is_paid = '0', total_amount, 0)) AS 'unpaid_amount' FROM dpd_invoice_new  WHERE 1 and invoice_type='M'  GROUP BY test");
        return $sql_query->result_array();
    }
    
    function getQuarterlyInvoice(){
        $sql_query = $this->db->query("SELECT  invoice_id,id,invoice_code,concat(quarter(created_on),year(created_on)) as test, quarter(created_on) as quarter, year(created_on) as year, SUM(total_amount) as final_price, SUM(IF(is_paid = '1', total_amount, 0)) AS 'paid_amount',SUM(IF(is_paid = '0', total_amount, 0)) AS 'unpaid_amount' FROM dpd_invoice_new  WHERE 1 and invoice_type='Q'  GROUP BY test");
        return $sql_query->result_array();
    }
    
    function getHalfYearlyInvoice(){
        //$sql_query = $this->db->query("SELECT  concat(month(created_on),year(created_on)) as test,SUM(total_amount) as final_price, SUM(IF(is_paid = '1', total_amount, 0)) AS 'paid_amount',SUM(IF(is_paid = '0', total_amount, 0)) AS 'unpaid_amount' FROM dpd_invoice_new  WHERE 1 and invoice_type='M'  GROUP BY test");
        $sql_query = $this->db->query("select invoice_id,id,invoice_code,if(quarter(created_on) = 2 OR quarter(created_on) = 1  ,'hf1','hf2') as type ,created_on,SUM(total_amount) as final_price, SUM(IF(is_paid = '1', total_amount, 0)) AS 'paid_amount',SUM(IF(is_paid = '0', total_amount, 0)) AS 'unpaid_amount' from dpd_invoice_new WHERE  invoice_type='HY' group by type");
        return $sql_query->result_array();
    }
    
    function getMonthlyDetailInvoice($fid=NULL){
        
        $array = array('invoice_type' => 'M', 'id' => $fid);
        
        $this->db->select("*")
                    ->from("invoice_new")
                    ->where($array);
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        return false;
        
        
        
    }
    
    function getWeeklyDetailInvoice($fid=NULL){
        $array = array('invoice_type' => 'M', 'id' => $fid);
        $this->db->select("*")
                    ->from("invoice_new")
                    ->where($array);
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        return false;
        
        
        
    }
    
    function getQuarterlyDetailInvoice($fid=NULL){
        $this->db->select("*")
                    ->from("invoice_new")
                    ->where("invoice_type",'Q');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        return false;
        
        
        
    }
    
    function getHalfYearlyDetailInvoice($fid=NULL){
        $this->db->select("*")
                    ->from("invoice_new")
                    ->where("invoice_type",'HY');
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 )
        {
        
            return $query->result_array();
        }
        return false;
        
        
        
    }
    
    function getInvoiceDetail($invoiceid){
        $this->db->select('*')
                ->from('invoice_new')
                ->join('user_extra_detail','user_extra_detail.id=invoice_new.id')
                ->where('invoice_new.invoice_id',$invoiceid);
        $query = $this->db->get();
      // e($this->db->last_query());
        if($query->num_rows()>0){
            return $query->row_array();
        }
    }
    
    
    function getAllfranchisee() {

        $this->db->select('*');
        $this->db->from('user_extra_detail');
        $this->db->join('aauth_users', 'user_extra_detail.id = aauth_users.id');
       
        $query = $this->db->get();

        if ($query->num_rows) {
            return $query->result_array();
        }
        
        return FALSE;
        
    }
    

    function getEvents($offset = FALSE, $limit = FALSE, $ids = array()) {
        $this->db->order_by('event_id', 'ASC');
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
        if (count($ids)) {
            $this->db->where_in('user_id', $ids);
        }
        $result = $this->db->get('eventbooking_events');
        return $result->result_array();
    }

    function getEvent($eid) {
        $this->db->select('eventbooking_events.*,eventbooking_event_type.event_type');
        $this->db->where('event_id', $eid);
        $this->db->join('eventbooking_event_type', 'eventbooking_events.event_type_id = eventbooking_events.event_type_id');
        $result = $this->db->get('eventbooking_events');
        return $result->row_array();
    }

    /*
     * return json on event completion saving
     */

    function eventComplete($array = array()) {
        $return['status'] = false;
        $event_id = arrIndex($array, 'event_id');
        if ($event_id) {
            $this->db->where('event_id', $event_id);
            $result = $this->db->get('event_complete')->result_array();
            if (!count($result))
                $result = $this->db->insert('event_complete', $array);
            else {
                $this->db->where('event_id', $event_id);
                $result = $this->db->update('event_complete', $array);
            }
            if ($result) {
                $this->session->set_flashdata('SUCCESS', 'event_completed_saved');
                $return['status'] = true;
            } else {
                $this->session->set_flashdata('ERROR', 'event_completed_notsaved');
            }
        }
        echo json_encode($return);
    }

    /*
     * return of compeleted event
     */

    function getComEvent($eid) {
        if (!$eid)
            return FALSE;
        $this->db->where('event_id', $eid);
        $result = $this->db->get('event_complete')->row();
        $result = (array) $result;
        return $result;
    }

    function getVenues() {
        $this->db->select('venue_id,venue_name');
        $result = $this->db->get('eventbooking_venues');
        return $result->result_array();
    }

    function insertRecord() {
        $data = array();
        $date = explode(' -', $this->input->post('eventdate', true));
        $data['user_id'] = $this->aauth->get_user()->id;
        $data['event_type_id'] = $this->input->post('event_type_id', true);
        $data['event_title'] = $this->input->post('event_title', true);
        $data['venue_id'] = $this->input->post('venue', true);
        $data['description'] = $this->input->post('description', true);
        $data['event_start_ts'] = str_replace('/', '-', $date[0] . ':00');
        $data['event_end_ts'] = str_replace('/', '-', $date[1] . ':00');

        $config['upload_path'] = $this->config->item('UPLOAD_PATH_EVENTS');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
        if (count($_FILES) > 0) {
            //Check for valid image upload
            if ($_FILES['event_img']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['event_img']['tmp_name'])) {
                if (!$this->upload->do_upload('event_img')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['event_img'] = $upload_data['file_name'];
                }
            }
        }

        $this->db->insert('eventbooking_events', $data);

        $event_id = $this->db->insert_id();

        $price = array();
        foreach ($_POST as $key => $row) {
            if (is_array($row)) {
                $index = 0;
                foreach ($row as $rowkey => $rowval) {
                    $price[$index][$key] = $rowval;
                    $index += 1;
                }
            }
        }

        $price_data = array();
        foreach ($price as $row) {
            $price_data['event_id'] = $event_id;
            $price_data['title'] = $row['title'];
            $price_data['price'] = $row['price'];
            $price_data['available'] = $row['available'];
            $this->db->insert('eventbooking_prices', $price_data);
        }
    }

    function updateRecord($event) {

        $data = array();
        //event booking
        $date = explode(' -', $this->input->post('eventdate', true));
        $data['event_type_id'] = $this->input->post('event_type_id', true);
        $data['event_title'] = $this->input->post('event_title', true);
        $data['venue_id'] = $this->input->post('venue_id', true);
        $data['description'] = $this->input->post('description', true);
        $data['event_start_ts'] = str_replace('/', '-', $date[0] . ':00');
        $data['event_end_ts'] = str_replace('/', '-', $date[1] . ':00');

        $config['upload_path'] = $this->config->item('UPLOAD_PATH_EVENTS');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        if (count($_FILES) > 0) {
            //Check for valid image upload
            if ($_FILES['event_img']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['event_img']['tmp_name'])) {
                if (!$this->upload->do_upload('event_img')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['event_img'] = $upload_data['file_name'];
                }
            }
        }

        //event confirmation email template
//        $data['o_email_confirmation_subject'] = $this->input->post('email_confirmation_subject', true);
//        $data['o_email_confirmation'] = $this->input->post('email_confirmation', true);
//        $data['o_email_payment_subject'] = $this->input->post('email_payment_subject', true);
//        $data['o_email_payment'] = $this->input->post('email_payment', true);

        //event term
//        $data['terms'] = $this->input->post('terms', true);

        //event ticket
        $data['ticket_info'] = $this->input->post('ticket_info', true);

        $config['upload_path'] = $this->config->item('UPLOAD_PATH_TICKETS');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        if (count($_FILES) > 0) {
            //Check for valid image upload
            if ($_FILES['ticket_img']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['ticket_img']['tmp_name'])) {
                if (!$this->upload->do_upload('ticket_img')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['ticket_img'] = $upload_data['file_name'];
                }
            }
        }

        $this->db->where('event_id', $event['event_id']);
        $this->db->update('eventbooking_events', $data);


        $price = array();
        foreach ($_POST as $key => $row) {
            if (is_array($row)) {
                $index = 0;
                foreach ($row as $rowkey => $rowval) {
                    $price[$index][$key] = $rowval;
                    $index += 1;
                }
            }
        }

        $this->db->where('event_id', $event['event_id']);
        $this->db->delete('eventbooking_prices');

        $price_data = array();
        foreach ($price as $row) {
            $price_data['event_id'] = $event['event_id'];
            $price_data['title'] = $row['title'];
            $price_data['price'] = $row['price'];
            $price_data['available'] = $row['available'];
            $this->db->insert('eventbooking_prices', $price_data);
        }
    }
    
    
    /*====================INVOICE MANUAL =============================*/
    
    function insertInvoiceRecord() {
                       
        $franchise_id = $this->input->post('franchise_id');
        $due_date = $this->input->post('due_on');
        $installment_fees = $this->input->post('amount');
        $particular = $this->input->post('particular');
        $today_date = date("Y-m-d");
        $gettype = $this->getFranshiseType($franchise_id);
        //e($gettype);
        $type = $gettype->mon_fee_type;
        $frachisee_email = $gettype->email;
        $firstname = $gettype->fname;
        $lastname = $gettype->lname;
        $home_address = $gettype->home_address;
        $business_address = $gettype->bussiness_number;
        $country = $gettype->territory_name;
        $fid = $gettype->id;        
        
        
        $vat_amt = 20; // define what % vat is
        $price_with_vat = $installment_fees + ($vat_amt * ($installment_fees / 100)); 
        $price_with_vat = round($price_with_vat, 2); // round to 2 decimal places
        
        $price_without_vat = ($vat_amt * ($installment_fees / 100)); 
        $price_without_vat = round($price_without_vat, 2); // round to 2 decimal places
        
        $amt_after_vat = $installment_fees + $price_with_vat;
        $data = array(
            'id' => $franchise_id,
            'installment_fees'=>$installment_fees,
            'vat'=>'20',
            'total_amount' => $amt_after_vat,
            'invoice_code' => '0',
            'created_on' => $today_date,
            'due_on' => $due_date,
            'paid_on' => '0000-00-00 00:00:00',
            'is_paid' => '0'
        );
        $this->db->insert('invoice_new', $data);
        $insert_id = $this->db->insert_id();

        $rand = rand(00000, 99999);
        $invoice_code = $rand . "" . $insert_id;
        $this->db->where('invoice_id', $insert_id);
        $this->db->update('invoice_new', array('invoice_code' => $invoice_code));

        $array = array(
            "invoice_id" => $invoice_code,
            "fid" =>$fid,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'home_address' => $home_address,
            'business_address' => $business_address,
            'country' =>$country,
            "created_date" => $today_date,
            "due_date" => $due_date,
            "vat_value"=>$price_without_vat,
            "f_email"=>$frachisee_email,
            "price_with_vat"=>$price_with_vat,
            "price_without_vat"=>$price_without_vat,
            "installment_amount"=>$installment_fees,
            "particular"=>$particular
        );
        
        return $array;
    }
    
    function updatevirtualcabnet($fid=NULL,$filename) {
       $date = date("Y-m-d h:i:s");
        $data = array(
            "visible_name"=>$filename.'.pdf',
            "filetype"=>'pdf',
            "actual_name"=>$filename.'.pdf',
            "creator_id"=>'1',
            "assigne_grp"=>'3',
            "assignes"=>$fid,
            "create_dtime"=>$date,
            "update_dtime"=>$date
        ); 
        
        $this->db->insert('virtualCab',$data);
       
    }
    
    /*===============================================================*/
    
    function countAllWeekly() {
        $this->db->select("*")
                    ->from("invoice_new")
                    ->where("invoice_type",'W');
        $query = $this->db->get();
        return $this->db->count_all_results();
    }
    
    function countAllMonthly() {
        $this->db->select("*")
                    ->from("invoice_new")
                    ->where("invoice_type",'M');
        $query = $this->db->get();
        return $this->db->count_all_results();
    }
    
    function countAllQuaterly() {
        $this->db->select("*")
                    ->from("invoice_new")
                    ->where("invoice_type",'Q');
        $query = $this->db->get();
        return $this->db->count_all_results();
    }
    
    function countAllHalfyearly() {
        $this->db->select("*")
                    ->from("invoice_new")
                    ->where("invoice_type",'HF');
        $query = $this->db->get();
        return $this->db->count_all_results();
    }

}

?>