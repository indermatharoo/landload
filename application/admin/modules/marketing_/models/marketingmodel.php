<?php

class Marketingmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function sendSMS($template) {


        $customers = array();
        $customers = $this->input->post('customer_list', true);

        foreach ($customers as $item) {

            $this->db->join('company', 'company.company_id = customer.company_id');
            $this->db->join('branch', 'branch.branch_id = company.branch_id');
            $this->db->where('customer_id', $item);
            $rs = $this->db->get('customer');
            $customer = $rs->row_array();

            $sms_sent = true;

            $sms_url = "http://www.onverify.com/sms.php?userid=7998&apipass=3969&msg=" . $template['message'] . "&number=" . $customer['billing_phone'] . "&from=DesktopDeli";
            $f = file_get_contents($sms_url);
            //$f = 1000;
            switch ($f) {
                case "2":
                    echo "username or password is wrong";
                    $sms_sent = false;
                    break;
                case "3":
                    echo "balance is not enough";
                    $sms_sent = false;
                    break;
                case "4":
                    echo "number wrong";
                    $sms_sent = false;
                    break;
                case "6":
                    echo "ip restriction";
                    $sms_sent = false;
                    break;
                case "7":
                    echo "duplicate vid";
                    $sms_sent = false;
                    break;
                default:
                    if ($f > 100)
                        echo "sms is queued";
            }

            if ($sms_sent) {
                //Deduct credit
                if ($customer['credits'] > 0) {
                    $this->db->where('branch_id', $customer['branch_id']);
                    $this->db->set('credits', "credits - 1", FALSE);
                    $this->db->update('branch');
                }
            }
        }
    }

    function sendMail($template) {

        $customers = array();
        $customers = $this->input->post('assigne_id', true);

        $this->email->initialize($this->config->item('EMAIL_CONFIG'));
        $cIds = implode(',', $customers);
        
        $fields = ' aauth_user_to_group.group_id,'
                . ' aauth_users.id as aauth_id,  aauth_users.email as aauth_email,'
                . ' aauth_users.pass  as aauth_pass, aauth_users.name  as aauth_name,'
                . ' aauth_users.is_active as aauth_active,aauth_users.store_id as aauth_store_id,'
                . ' aauth_users.pic as aauth_pic';
        
        $fields .=  ','.' user_extra_detail.fname as user_fname, user_extra_detail.lname as user_lname,'
                . ' user_extra_detail.home_address as user_home_addr,'
                . ' user_extra_detail.bussiness_address as user_buss_addr,'
                . ' user_extra_detail.bussiness_number as user_buss_num,'
                . ' user_extra_detail.vat_number as user_vat_num, user_extra_detail.telephone as user_tel_num,'
                . ' user_extra_detail.linkedin as user_linkedin,  user_extra_detail.pinterest as user_pintrest,'
                . ' user_extra_detail.google as user_google,'
                . ' user_extra_detail.facebook as user_facebook, user_extra_detail.twitter as user_twitter,'
                . ' user_extra_detail.paypal as user_paypal,'                
                . ' user_extra_detail.territory_name as user_territory, user_extra_detail.franchise_no as user_franchise,'
                . ' user_extra_detail.lat as user_lat, user_extra_detail.log as user_long,'
                . ' user_extra_detail.region as user_region';
        
        $fields .=  ','. 'customer.customer_id as cust_id, customer.auth_user_id as cust_aauth_id,'
                . ' customer.first_name as cust_fname,'
                . ' customer.last_name as cust_lname, customer.email as cust_email, customer.passwd as cust_passwd, customer.linkedin as cust_linkedin,'
                . ' customer.twitter as cust_twitter, customer.facebook as cust_facebook,'
                . ' customer.delivery_first_name as cust_del_fname, customer.delivery_last_name as cust_del_lname,'
                . ' customer.delivery_address1 as cust_del_addr1,'
                . ' customer.delivery_address2 as cust_del_addr2, customer.delivery_phone as cust_del_phone, customer.delivery_city as cust_del_city,'
                . ' customer.delivery_state as cust_del_state, customer.delivery_zipcode as cust_del_zipcode,'
                . ' customer.billing_address1, customer.billing_address2, customer.billing_phone,'
                . ' customer.billing_mobile, customer.billing_city, customer.billing_state,'
                . ' customer.billing_zipcode';
        
        
        $this->db->select($fields)
                ->join('customer', 'customer.auth_user_id = aauth_users.id', 'LEFT')
                ->join('user_extra_detail', 'user_extra_detail.id = aauth_users.id', 'LEFT')
                ->join('aauth_user_to_group', 'aauth_user_to_group.user_id = aauth_users.id', 'LEFT')
                ->where('aauth_users.id in (' . $cIds . ')');
        $rs = $this->db->get('aauth_users');        
        if ($rs->num_rows()) {
            $rst = $rs->result_array();
//            e($rst);
            foreach ($rst as $customer) {                
//                e($customer);
                $emailData = array();
                $emailData['DATE'] = date("jS F, Y");
                if(in_array($customer['group_id'], array(2,3,5))){
                    $emailData['FIRST_NAME'] = $customer['user_fname'];
                    $emailData['LAST_NAME'] = $customer['user_lname'];                    
                }else{                    
                    $emailData['FIRST_NAME'] = $customer['cust_fname'];
                    $emailData['LAST_NAME'] = $customer['cust_lname'];
                }
                $search = array();
                $replace = array();

                $search[] = '{DATE}';
                $replace[] = $emailData['DATE'];

                $search[] = '{FIRST_NAME}';
                $replace[] = $emailData['FIRST_NAME'];

                $search[] = '{LAST_NAME}';
                $replace[] = $emailData['LAST_NAME'];
                
                //Preview link
                $link = uniqid(time(), true);

                //			$search[] = '{PREVIEW_URL}';
                //			$replace[] = config_item('site_url')."newsletter/preview/$link";
                //			$search[] = '{UNSUBSCRIBE_URL}';
                //			$replace[] = config_item('site_url')."newsletter/unsubscribe/{$customer['customer_id']}";
                $emailBody = str_ireplace($search, $replace, $template['email_content']);

                //$customer['email'] = 'mccvs@yopmail.com';
                $this->email->from(DWS_EMAIL_NOREPLY, DWS_EMAIL_FROM);
                $this->email->set_header('Return-Path', '<' . DWS_CLOUDMAILIN_EMAIL . '>');
                $this->email->set_header('X-HS-ID', "<{$customer['aauth_id']}>");
                $this->email->set_header('X-HS-Email', "<{$customer['aauth_email']}>");
                //$this->email->reply_to($customer['email'], $customer['first_name'].' '.$customer['last_name']);
                $this->email->to($customer['aauth_email']);
                $this->email->subject($template['email_subject']);
                $this->email->message($emailBody);
                $status = $this->email->send();
		if(empty($template['email_subject']) || is_null($templatete['email_subject']) ){
			$templatete['email_subject'] = ' testing sub ';
		}
		$templatete['email_subject'] = 'testing ';
                if ($status) {
                    $log_entry = array();
                    $log_entry['email_log_id'] = $link;
                    $log_entry['email_subject'] = 'test ing';
                    $log_entry['email_content'] = $emailBody;
                    $this->db->insert('email_log', $log_entry);
                }
            }
        }
        //redirect('marketing/index/email');
    }

    function subscribedCustomers($selected_branches = false) {
        $CI = & get_instance();

        $this->db->select('customer.customer_id, customer.company_id, customer.first_name, customer.last_name, customer.email, customer.delivery_phone, customer.delivery_address1,customer.delivery_zipcode, company.company_name,customer.billing_phone');
        $this->db->from('customer');
        $this->db->join('company', 'company.company_id = customer.company_id');
        if ($selected_branches) {
            $this->db->where_in('branch_id', $selected_branches);
        }
        if ($CI->isBranch()) {
            $this->db->where('branch_id', $CI->getUserID());
        }
        $this->db->where('news_subscription', 1);
        $this->db->order_by('customer.company_id');
        $this->db->order_by('customer.customer_id');
        $rs = $this->db->get();
        //echo $this->db->last_query();
        return $rs->result_array();
    }

    function subscribedGuardians($selected_branches = false) {
        $CI = & get_instance();

        $this->db->select('customer.customer_id, customer.company_id, customer.first_name, customer.last_name, customer.email, customer.delivery_phone, customer.delivery_address1,customer.delivery_zipcode, company.company_name,customer.billing_phone');
        $this->db->from('customer');
        $this->db->join('company', 'company.company_id = customer.company_id');

        if ($selected_branches) {
            $this->db->where_in('branch_id', $selected_branches);
        }
        if ($CI->isBranch()) {
            $this->db->where('branch_id', $CI->getUserID());
        }
        $this->db->where('guardian', 1);
        $this->db->where('news_subscription', 1);
        $this->db->order_by('customer.company_id');
        $this->db->order_by('customer.customer_id');
        $rs = $this->db->get();
        //echo $this->db->last_query();
        return $rs->result_array();
    }

    function customersWithoutOrders($days = 0, $selected_branches = false) {
        $CI = & get_instance();
        $time_period = 0;
        if ($days != 0) {
            $time_period = strtotime("-{$days} day", time());
        }
        $this->db->select('customer.customer_id, customer.company_id, customer.first_name, customer.last_name, customer.email, customer.delivery_phone, customer.delivery_address1,customer.delivery_zipcode, order.order_id,company.company_name,customer.billing_phone');
        $this->db->from('customer');
        if ($time_period) {
            $this->db->join('order', 'order.customer_id = customer.customer_id AND order_time >= ' . $time_period, 'LEFT OUTER');
        } else {
            $this->db->join('order', 'order.customer_id = customer.customer_id', 'LEFT OUTER');
        }
        $this->db->join('company', 'company.company_id = customer.company_id');
        $this->db->where('news_subscription', 1);
        if ($selected_branches) {
            $this->db->where_in('branch_id', $selected_branches);
        }
        if ($CI->isBranch()) {
            $this->db->where('branch_id', $CI->getUserID());
        }
        $this->db->where('order.order_id', NULL);
        $this->db->order_by('customer.company_id');
        $this->db->order_by('customer.customer_id');
        $rs = $this->db->get();
        return $rs->result_array();
    }

    function fetchCustomersByIDs($customer_ids) {
        $this->db->select('company.company_name, customer.first_name, customer.last_name, customer.email, customer.delivery_address1, customer.delivery_phone, customer.delivery_zipcode,customer.billing_phone');
        $this->db->from('customer');
        $this->db->join('company', 'company.company_id = customer.company_id');
        $this->db->where_in('customer_id', $customer_ids);
        $rs = $this->db->get();
        return $rs->result_array();
    }

}

?>
