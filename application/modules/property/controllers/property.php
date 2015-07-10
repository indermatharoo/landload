<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Property extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('propertymodel');
        $property = $this->propertymodel->listAll();
        //e($property);

        $inner = array();
        $inner['property'] = $property;
        $shell['contents'] = $this->load->view("property-index", $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function detail($uid) {
       // e($uid);
        
        
        $this->load->model('propertymodel');
        $property = $this->propertymodel->getProperty($uid);
        $gallery_images = $this->propertymodel->getGalleryImages($uid);
        $attributes = $this->propertymodel->getAttributeValue($uid);

        $inner = array();
        $inner['property'] = $property;
        $inner['gallery'] = $gallery_images;
        $inner['attributes'] = $attributes;
       // e($inner);
        $inner['uid'] = $uid;
        $shell['contents'] = $this->load->view("detail", $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }
    
    function apply(){
        $this->load->model('propertymodel');
        
        $this->propertymodel->insertApplication();
        echo  "Done";
    }

    function event() {
        $this->load->model('Franchiseemodel');
        $franchisee = $this->Franchiseemodel->getEvent();
        $event = array();
        $count = 0;
        foreach ($franchisee as $row) {
            $url = base_url() . "booking/index/" . $row['event_id'];
            $row['start'] = strtotime(trim($row['event_start_ts'])) * 1000;
            $row['end'] = strtotime(trim($row['event_end_ts'])) * 1000;
            $row['time'] = 'From ' . date('d-m-Y h:m', strtotime(trim($row['event_start_ts']))) . ' till ' . date('d-m-Y h:m', strtotime(trim($row['event_end_ts'])));
            $event[$count] = array(
                "id" => $row['event_id'],
                "img" => $row['event_img'],
                "title" => $row['event_title'],
                "time" => $row['time'],
                "color" => $row['event_color'],
                "location" => $row['venue_name'],
                "class" => $row['event_type'],
                "url" => $url,
                "start" => $row['start'],
                "end" => $row['end']);
            $count ++;
        }
        $output = array();
        $output['success'] = 1;
        $output['result'] = $event;
        echo json_encode($output);
    }

    function eventdetail() {
        $this->load->model('Franchiseemodel');
        $eid = !empty($_POST['eid']) ? $_POST['eid'] : '';
        $franchisee = $this->Franchiseemodel->eventDetail($eid);
        $inner = array();
        $inner['row'] = $franchisee;
        $inner['small'] = arrIndex($_POST, 'small', false);
        $output = array();
        $output['event'] = $this->load->view("event-detail", $inner, true);
        echo json_encode($output);
    }

}

?>
