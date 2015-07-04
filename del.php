<?php
$msg = "this ios a test";
$s = mail("balwinder@multichannelcreative.co.uk","My subject",$msg);

if($s){
    echo 123;
}   else {
    echo 321;
}