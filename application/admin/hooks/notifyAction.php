<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */

class notifyAction extends Admin_Controller{
    
    protected $ci;
    
    function __construct() {        
        global $CI;
        $this->ci = $CI;
        $this->ci->load->model('UserNotificationmodel');
    }
    
    function saveNotify(){
        /* 
         * Store the ip as a INT(11) UNSIGNED, 
         * then use the INET_ATON and INET_NTOA 
         * functions to store/retrieve the ip address.
         */
        $loggedUserData = $this->ci->session->userdata;        
        if(!isset($loggedUserData['loggedin']) || !$loggedUserData['loggedin']){
            return false;
        }
        $data = array();                
        $data[$this->ci->UserNotificationmodel->user_id] = $loggedUserData['id'];
        $data[$this->ci->UserNotificationmodel->activity_time] = time();
        $data[$this->ci->UserNotificationmodel->user_ip] = $loggedUserData['ip_address'];
        
        $data[$this->ci->UserNotificationmodel->source_class] = $this->ci->router->fetch_class();
        $data[$this->ci->UserNotificationmodel->source_action] = $this->ci->router->fetch_method();
        
        $this->ci->UserNotificationmodel->insertRecord($data);
    }
}
