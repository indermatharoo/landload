<?php

class InvoiceModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function getIsFirst($fid=NULL){
        $franchise_id = $fid;
        $this->db->select('is_paid_first');
        $this->db->from('user_extra_detail');
        $this->db->where('id', $franchise_id);
        
        $query = $this->db->get();
        if ($query->num_rows) {
            return $query->result();
        }
        return FALSE;
        
    }
    
    function updateIsFirst($fid=NULL,$type=NULL,$invoiceid=NULL){
        
        
        $today = date("Y-m-d");
        $time = strtotime($today);
        
        if($type=='W'){
            $final = date("Y-m-d", strtotime("+1 week", $time));
            $invoice_type="W";
        }
        if($type=='M'){
            $final = date("Y-m-d", strtotime("+1 month", $time));
            $invoice_type="M";
        }
        if($type=='Q'){
            $final = date("Y-m-d", strtotime("+4 month", $time));
            $invoice_type="Q";
        }
        if($type=='HF'){
            $final = date("Y-m-d", strtotime("+6 month", $time));
            $invoice_type="HF";
        }
        
        $data = array(
            "is_paid_first" =>'Y',
            "last_installment"=>$final
        );
        
        $data1 = array(
            "invoice_type"=>$invoice_type
        );
        
        $this->db->where('id', $fid);
        $this->db->update('user_extra_detail', $data);
        
        
        $this->db->where('invoice_code', $invoiceid);
        $this->db->update('invoice_new', $data1);
        
    }
    
    function getWeeklyUsers() {

        //$date = date("Y-m-d");
        $today_date = date("Y-m-d");
        $this->db->select('*');
        $this->db->from('user_extra_detail');
        $this->db->join('aauth_users', 'user_extra_detail.id = aauth_users.id');
        $this->db->where('user_extra_detail.mon_fee_type', 'W');
        $this->db->where('user_extra_detail.last_installment', $today_date);
        //$this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows) {
            return $query->result();
        }
        
        return FALSE;
        
    }

    function getMonthlyUsers() {

        //$date = date("Y-m-d");
        $today_date = date("Y-m-d");
        $this->db->select('*');
        $this->db->from('user_extra_detail');
        $this->db->join('aauth_users', 'user_extra_detail.id = aauth_users.id');
        $this->db->where('user_extra_detail.mon_fee_type', 'M');
        $this->db->where('user_extra_detail.last_installment', $today_date);
        //$this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows) {
            return $query->result();
        }
        
        return FALSE;
        
    }
    
    function getQuaterlyUsers(){
        //$date = date("Y-m-d");
        $today_date = date("Y-m-d");
        $this->db->select('*');
        $this->db->from('user_extra_detail');
        $this->db->join('aauth_users', 'user_extra_detail.id = aauth_users.id');
        $this->db->where('user_extra_detail.mon_fee_type', 'Q');
        $this->db->where('user_extra_detail.last_installment', $today_date);
        //$this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows) {
            return $query->result();
        }
        
        return FALSE;
    }
    
    function getHalfyearlyUsers(){
        //$date = date("Y-m-d");
        $today_date = date("Y-m-d");
        $this->db->select('*');
        $this->db->from('user_extra_detail');
        $this->db->join('aauth_users', 'user_extra_detail.id = aauth_users.id');
        $this->db->where('user_extra_detail.mon_fee_type', 'HY');
        $this->db->where('user_extra_detail.last_installment', $today_date);
        //$this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows) {
            return $query->result();
        }
        
        return FALSE;
    }

    function getInvoice($fid = NULL,$installment_fees,$amt_after_vat) {
        $franchise_id = $fid;
        $today_date = date("Y-m-d");
        $due_date = date('Y-m-d', strtotime("+5 days"));
        
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
            "created_date" => $today_date,
            "due_date" => $due_date
        );

        return $array;
    }
    
   

    function vat($price_without_vat=NULL) {
       
        $vat = 20; // define what % vat is

        $price_with_vat = $price_without_vat + ($vat * ($price_without_vat / 100)); // work out the amount of vat

        $price_with_vat = round($price_with_vat, 2); // round to 2 decimal places

        return $price_with_vat;
    }
    
    function withoutvat($price_without_vat=NULL) {
       
        $vat = 20; // define what % vat is

        $price_with_vat = ($vat * ($price_without_vat / 100)); // work out the amount of vat

        $price_with_vat = round($price_with_vat, 2); // round to 2 decimal places

        return $price_with_vat;
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
    
}
?>