<?php

class Paypal extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('paypal_class');
       // ini_set('error_log',)
        ini_set('error_log', dirname(dirname(dirname(dirname((dirname(dirname(__FILE__))))))).'/ipn_errors.log');
    }

    function index() {        
            
   
  $p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
            
// setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
//$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$this_script = "http://landlord.webnseo.co.uk/test/paypal.php";
// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) {
    
   case 'process':      // Process and order...

      // There should be no output at this point.  To process the POST data,
      // the submit_paypal_post() function will output all the HTML tags which
      // contains a FORM which is submited instantaneously using the BODY onload
      // attribute.  In other words, don't echo or printf anything when you're
      // going to be calling the submit_paypal_post() function.
 
      // This is where you would have your form validation  and all that jazz.
      // You would take your POST vars and load them into the class like below,
      // only using the POST values instead of constant string expressions.
 
      // For example, after ensureing all the POST variables from your custom
      // order form are valid, you might have:
      //
      // $p->add_field('first_name', $_POST['first_name']);
      // $p->add_field('last_name', $_POST['last_name']);
      

      $p->add_field('business', 'kaur.amandip984@gmail.com');

//      $p->add_field('business', 'devrohit46@gmail.com');

      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', 'Paypal Test Transaction');
      $p->add_field('amount', '1.99');

     $p->add_field('currency_code', 'USD');


      $p->submit_paypal_post(); // submit the fields to paypal
      //$p->dump_fields();      // for debugging, output a table of all the fields
      break;
      
   case 'success':      // Order was successful...
   
      // This is where you would probably want to thank the user for their order
      // or what have you.  The order information at this point is in POST 
      // variables.  However, you don't want to "process" the order until you
      // get validation from the IPN.  That's where you would have the code to
      // email an admin, update the database with payment status, activate a
      // membership, etc.  
 mail("devrohit46@gmail.com","My subject", "<pre>".$_REQUEST.'</pre>'); 
      
      // You could also simply re-direct them to another page, or your own 
      // order status page which presents the user with the status of their
      // order based on a database (which can be modified with the IPN code 
      // below).
      
      break;
      
   case 'cancel':       // Order was canceled...
   
      // The order was canceled before being completed.
 
      echo "<html><head><title>Canceled</title></head><body><h3>The order was canceled.</h3>";
      echo "</body></html>";
      
      break;
      
   case 'ipn':          // Paypal is calling page for IPN validation...
   
      // It's important to remember that paypal calling this script.  There
      // is no output here.  This is where you validate the IPN data and if it's
      // valid, update your database to signify that the user has payed.  If
      // you try and use an echo or printf function here it's not going to do you
      // a bit of good.  This is on the "backend".  That is why, by default, the
      // class logs all IPN data to a text file.
      
      if ($p->validate_ipn()) {
          $in_code = $this->input->get('invoice_id', TRUE);
//          error_log('test-'.$in_code);
          $this->db->where('invoice_code',$in_code);
          $this->db->update('invoice_new',array('is_paid'=>'1','response'=>json_encode($_REQUEST)));
          
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.
  
         // Check the paypal documentation for specifics on what information
         // is available in the IPN POST variables.  Basically, all the POST vars
         // which paypal sends, which we send back for validation, are now stored
         // in the ipn_data() array.
  
         // For this example, we'll just email ourselves ALL the data.
//         $subject = 'Instant Payment Notification - Recieved Payment';
//         $to = 'YOUR EMAIL ADDRESS HERE';    //  your email
//         $body =  "An instant payment notification was successfully recieved\n";
//         $body .= "from ".$p->ipn_data['payer_email']." on ".date('m/d/Y');
//         $body .= " at ".date('g:i A')."\n\nDetails:\n";
//         
//         foreach ($p->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
        // the message

//mail("devrohit46@gmail.com","My subject", $in_code);
      }
      break;
 }     
}
    }



