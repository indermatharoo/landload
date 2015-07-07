<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    function index() {
       echo "Index called first";
      //  echo base_url();
    }
    
    function weekly() {
        
        $this->load->model('invoicemodel');
        $data = $this->invoicemodel->getWeeklyUsers();
        //e($data);
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        
        $this->email->initialize($config);
               
        foreach($data as $rows){
            //echo $rows['property_id'];
            $application_id = $rows['id'];
            $company_detail = getCompany($rows['property_id']);
            $comId = $company_detail->company_id;
            $applicantId = $rows['applicant_id'];
            $payable_install_fees = $rows['invoice_amount'];
            //e($company_detail);
            
            $addvat = $this->invoicemodel->vat($payable_install_fees);
            $without_value = $this->invoicemodel->withoutvat($payable_install_fees);
            
            $invoicedata = $this->invoicemodel->getInvoice($application_id,$applicantId,$comId,$payable_install_fees,$addvat);
            $sendto = $rows['email'];
            $fname = $rows['fname'];
            $lname = $rows['lname'];
            $home_address = $rows['address'];
            
            $invoice_ref_code = $invoicedata["invoice_id"];
            $created_on = $invoicedata["created_date"];
            $due_on = $invoicedata["due_date"];
            $senddata = array(
                                "firstname"=>$fname,
                                "lastname"=>$lname,
                                "homeaddress"=>$home_address,
                                "invoice_no"=>$invoicedata["invoice_id"],
                                "created_date"=>$invoicedata["created_date"],
                                "due_date"=>$invoicedata["due_date"],
                                "installment_amount"=>$payable_install_fees,
                                "vat_value"=>$without_value,
                                "after_vat"=>$addvat
                            );
            
            $msg_body = $this->load->view('invoice', $senddata, true);
            
            // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
                     
            $filename = $invoicedata["invoice_id"];
            $pdfFilePath = FCPATH."upload/virtcab/doc/$filename.pdf";          
            include_once APPPATH.'third_party/mpdf/mpdf.php';
            ini_set('memory_limit','64M');
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';  
            $mpdf=new mPDF('c'); 
            $mpdf->WriteHTML($msg_body);
            
            $mpdf->Output($pdfFilePath, 'F');
            $this->invoicemodel->updatevirtualcabnet($applicantId,$comId,$filename);
            
            

            
            $this->email->set_newline("\r\n");
            $this->email->from('invoice@checksample.co.uk','Landlord Masters'); // change it to yours
            $this->email->to($sendto); // change it to yours
            $this->email->subject('Invoice Notification');
            $this->email->message($msg_body);

            if ($this->email->send()) {
               //$this->invoicemodel->updateIsFirst($application_id,'W',$invoice_ref_code);
               echo "sent";
            } else {
                show_error($this->email->print_debugger());
            }
            
        }
        
    }
    
    function monthly() {
        
        $this->load->model('invoicemodel');
        $data = $this->invoicemodel->getMonthlyUsers();
       // e($data);
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        
        $this->email->initialize($config);
               
        foreach($data as $rows){
            //echo $rows['property_id'];
            $application_id = $rows['id'];
            $company_detail = getCompany($rows['property_id']);
            $comId = $company_detail->company_id;
            $applicantId = $rows['applicant_id'];
            $payable_install_fees = $rows['invoice_amount'];
            //e($company_detail);
            
            $addvat = $this->invoicemodel->vat($payable_install_fees);
            $without_value = $this->invoicemodel->withoutvat($payable_install_fees);
            
            $invoicedata = $this->invoicemodel->getInvoice($application_id,$applicantId,$comId,$payable_install_fees,$addvat);
            $sendto = $rows['email'];
            $fname = $rows['fname'];
            $lname = $rows['lname'];
            $home_address = $rows['address'];
            
            $invoice_ref_code = $invoicedata["invoice_id"];
            $created_on = $invoicedata["created_date"];
            $due_on = $invoicedata["due_date"];
            $senddata = array(
                                "firstname"=>$fname,
                                "lastname"=>$lname,
                                "homeaddress"=>$home_address,
                                "invoice_no"=>$invoicedata["invoice_id"],
                                "created_date"=>$invoicedata["created_date"],
                                "due_date"=>$invoicedata["due_date"],
                                "installment_amount"=>$payable_install_fees,
                                "vat_value"=>$without_value,
                                "after_vat"=>$addvat
                            );
            
            $msg_body = $this->load->view('invoice', $senddata, true);
            
            // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
                     
            $filename = $invoicedata["invoice_id"];
            $pdfFilePath = FCPATH."upload/virtcab/doc/$filename.pdf";          
            include_once APPPATH.'third_party/mpdf/mpdf.php';
            ini_set('memory_limit','64M');
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';  
            $mpdf=new mPDF('c'); 
            $mpdf->WriteHTML($msg_body);
            
            $mpdf->Output($pdfFilePath, 'F');
            $this->invoicemodel->updatevirtualcabnet($applicantId,$comId,$filename);
            
            

            
            $this->email->set_newline("\r\n");
            $this->email->from('invoice@checksample.co.uk','Landlord Masters'); // change it to yours
            $this->email->to($sendto); // change it to yours
            $this->email->subject('Invoice Notification');
            $this->email->message($msg_body);

            if ($this->email->send()) {
               $this->invoicemodel->updateIsFirst($application_id);
               echo "sent";
            } else {
                show_error($this->email->print_debugger());
            }
            
        }
    }
    
    function quarterly(){
        $this->load->model('invoicemodel');
        $data['rows'] = $this->invoicemodel->getQuaterlyUsers();
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
        
        
        
        if (!empty($data['rows'])) {
            foreach ($data['rows'] as $val) {
            $fid = $val->id;
            
            $total_amount = $val->fee_increase_year;
            $single_installment_fees = ($total_amount / 4);
            
            
            $check_first_installment = $this->invoicemodel->getIsFirst($fid);
            foreach($check_first_installment as $firstinstallment_check){
              $chk = $firstinstallment_check->is_paid_first;
              
            }
            
            if($chk=="N"){
                $modlus = $total_amount % 4; 
                $payable_install_fees = (int)$single_installment_fees;
                $payable_install_fees = $payable_install_fees + $modlus;
            }
            else
            {
                $payable_install_fees = (int)$single_installment_fees;
            }
          
            $addvat = $this->invoicemodel->vat($payable_install_fees);
            
            $invoicedata = $this->invoicemodel->getInvoice($fid,$payable_install_fees,$addvat);
                       
            $sendto = $val->email;
            $fname = $val->fname;
            $lname = $val->lname;
            $home_address = $val->home_address;
            $business_address = $val->bussiness_address;
            $region = $val->region;
            $country = $val->territory_name;
            $invoice_ref_code = $invoicedata["invoice_id"];
            $created_on = $invoicedata["created_date"];
            $due_on = $invoicedata["due_date"];
            $senddata = array(
                                "firstname"=>$fname,
                                "lastname"=>$lname,
                                "homeaddress"=>$home_address,
                                "businessaddress"=>$business_address,
                                "region"=>$region,
                                "country"=>$country,
                                "invoice_no"=>$invoicedata["invoice_id"],
                                "created_date"=>$invoicedata["created_date"],
                                "due_date"=>$invoicedata["due_date"],
                                "installment_amount"=>$payable_install_fees,
                                "vat_value"=>$withoutvat_show,
                                "after_vat"=>$addvat
                            );
            
            $msg_body = $this->load->view('invoice', $senddata, true);
            
            // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
                     
            $filename = $invoicedata["invoice_id"];
            $pdfFilePath = FCPATH."upload/virtcab/doc/$filename.pdf";          
            include_once APPPATH.'third_party/mpdf/mpdf.php';
            ini_set('memory_limit','64M');
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';  
            $mpdf=new mPDF('c'); 
            $mpdf->WriteHTML($msg_body);
            
            $mpdf->Output($pdfFilePath, 'F');
            $this->invoicemodel->updatevirtualcabnet($fid,$filename);
            
            $mpdf->Output($pdfFilePath, 'F');
            
            $this->email->set_newline("\r\n");
            $this->email->from('invoice@checksample.co.uk','The Creative Station'); // change it to yours
            $this->email->to($sendto); // change it to yours
            $this->email->subject('Invoice Notification');
            $this->email->message($msg_body);

            if ($this->email->send()) {
               $this->invoicemodel->updateIsFirst($fid,'Q',$invoice_ref_code);
               echo "sent";
            } else {
                show_error($this->email->print_debugger());
            }
             
            
        }
        }
    }
    
    
    function halfyearly(){
        $this->load->model('invoicemodel');
        $data['rows'] = $this->invoicemodel->getHalfyearlyUsers();
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
        
        
        
        if (!empty($data['rows'])) {
            foreach ($data['rows'] as $val) {
            $fid = $val->id;
            
            $total_amount = $val->fee_increase_year;
            $single_installment_fees = ($total_amount / 6);
            
            
            $check_first_installment = $this->invoicemodel->getIsFirst($fid);
            foreach($check_first_installment as $firstinstallment_check){
              $chk = $firstinstallment_check->is_paid_first;
              
            }
            
            if($chk=="N"){
                $modlus = $total_amount % 6; 
                $payable_install_fees = (int)$single_installment_fees;
                $payable_install_fees = $payable_install_fees + $modlus;
            }
            else
            {
                $payable_install_fees = (int)$single_installment_fees;
            }
          
            $addvat = $this->invoicemodel->vat($payable_install_fees);
            
            $invoicedata = $this->invoicemodel->getInvoice($fid,$payable_install_fees,$addvat);
                       
            $sendto = $val->email;
            $fname = $val->fname;
            $lname = $val->lname;
            $home_address = $val->home_address;
            $business_address = $val->bussiness_address;
            $region = $val->region;
            $country = $val->territory_name;
            $invoice_ref_code =  $invoicedata["invoice_id"];
            $created_on = $invoicedata["created_date"];
            $due_on = $invoicedata["due_date"];
            $senddata = array(
                                "firstname"=>$fname,
                                "lastname"=>$lname,
                                "homeaddress"=>$home_address,
                                "businessaddress"=>$business_address,
                                "region"=>$region,
                                "country"=>$country,
                                "invoice_no"=>$invoicedata["invoice_id"],
                                "created_date"=>$invoicedata["created_date"],
                                "due_date"=>$invoicedata["due_date"],
                                "installment_amount"=>$payable_install_fees,
                                "vat_value"=>$withoutvat_show,
                                "after_vat"=>$addvat
                            );
            
            $msg_body = $this->load->view('invoice', $senddata, true);
            
            // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
                     
            $filename = $invoicedata["invoice_id"];
            $pdfFilePath = FCPATH."upload/virtcab/doc/$filename.pdf";          
            include_once APPPATH.'third_party/mpdf/mpdf.php';
            ini_set('memory_limit','64M');
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';  
            $mpdf=new mPDF('c'); 
            $mpdf->WriteHTML($msg_body);
            
            $mpdf->Output($pdfFilePath, 'F');
            $this->invoicemodel->updatevirtualcabnet($fid,$filename);
            
            $this->email->set_newline("\r\n");
            $this->email->from('invoice@checksample.co.uk','The Creative Station'); // change it to yours
            $this->email->to($sendto); // change it to yours
            $this->email->subject('Invoice Notification');
            $this->email->message($msg_body);

            if ($this->email->send()) {
               $this->invoicemodel->updateIsFirst($fid,'HY',$invoice_ref_code);
               echo "sent";
            } else {
                show_error($this->email->print_debugger());
            }
             
            
        }
        }
    }
    
   

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */