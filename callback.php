<<<<<<< HEAD
<?php
// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

// intantiate the IPN listener
include('ipn-listener.php');
$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = true;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
error_log(print_r($_REQUEST));
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}

// TODO: Handle IPN Response here

=======
<?php
// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

// intantiate the IPN listener
include('ipn-listener.php');
$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = true;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
    error_log($_REQUEST);
    
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}

// TODO: Handle IPN Response here

>>>>>>> e5d72d9372e0402223673f8774730748d076410e
?>