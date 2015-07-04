<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Franchisee extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('Franchiseemodel');
        $franchisee = $this->Franchiseemodel->listAll();

        $map = array();
        $count = 0;
//        e($franchisee);
        foreach ($franchisee as $row) {
            $html = "<div><h3>" . $row['bussiness_address'] . '</h3><p>' . $row['region'] . "</p><p><a href='" . base_url() . "franchisee/detail/" . $row['id'] . "'>Click here to View Details</a></p></div>";
            $map[$count] = array($row['bussiness_address'], $row['lat'], $row['log'], $html);
            $count ++;
        }

        $territory = array();
        $territory = $this->Franchiseemodel->territoryList();


        $inner = array();
        $inner['franchisee'] = $franchisee;
        $inner['territory'] = $territory;
        $inner['mapFranchisee'] = $map;
        $shell['contents'] = $this->load->view("franchisee-index", $inner, true);
        $this->load->view("themes/" . THEME . "/templates/map", $shell);
    }

    function detail($uid) {
        $this->load->model('Franchiseemodel');
        $franchisee = $this->Franchiseemodel->getFranchisee($uid);
        
        $testimonials = array();
        $testimonials = $this->Franchiseemodel->testimonials();

        $sidelinks = array();
        $sidelinks = $this->Franchiseemodel->sideLinks();

        $inner = array();
        $inner['franchisee'] = $franchisee;
        $inner['sidelinks'] = $sidelinks;
        $inner['testimonials'] = $testimonials;
        $inner['uid'] = $uid;
        $shell['contents'] = $this->load->view("detail", $inner, true);
        $this->load->view("themes/" . THEME . "/templates/franchisee", $shell);
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
