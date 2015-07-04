<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Location extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($lid = 0) {
        $this->load->model('Locationmodel');
        $this->load->helper('text');
        $this->load->library('form_validation');

        $location = $this->Locationmodel->getDetails($lid);
        if(!$location) {
            show_404('');
        }
        
        $closed_days = $this->Locationmodel->getClosedDates($location['location_id']);
        
        /*$closed_days = array();
        
        $min_date = 0;
        $start = new DateTime(date('Y-m-d'));
        $current_time = date("H:i", time());
        $cutoff_time = $location['location_cutoff_time'];
        if ($current_time > $cutoff_time) {
            $min_date++;
            $start->add(new DateInterval('P1D'));
        }
        $end = new DateTime(date('Y-m-d'));
        $days = $location['max_delivery_limit'];
        $end->add(new DateInterval('P' . $days . 'D'));
        
        //Find and add Sat/Sun
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);
        foreach ($period as $dt) {
            if($location['sunday_open'] == 0) {
                if ($dt->format('N') == 7) {
                    $closed_days[] = $dt->format('Y-m-d');
                }
            }
            if($location['saturday_open'] == 0) {
                if ($dt->format('N') == 6) {
                    $closed_days[] = $dt->format('Y-m-d');
                }
            }
        }

        //Add Holidays
        $rs = $this->Locationmodel->getClosedDays($location['location_id']);
        foreach ($rs as $row) {
            $dt = $row['date'];
            if ($row['recurring'] == 1) {
                $dt_arr = explode('-', $dt);
                $dt = date('Y') . '-' . $dt_arr[1] . '-' . $dt_arr[2];
            }
            $closed_days[] = $dt;
        }
        
        //Check for next min_date
        foreach ($period as $dt) {
           if(!in_array($dt->format("Y-m-d"), $closed_days)) {
               break;
            }
            $min_date++;
        }*/
        
        $min_date = 0;
        $start = new DateTime(date('Y-m-d'));
        $current_time = date("H:i", time());
        $cutoff_time = $location['location_cutoff_time'];
        if ($current_time > $cutoff_time) {
            $min_date++;
            $start->add(new DateInterval('P1D'));
        }
        $end = new DateTime(date('Y-m-d'));
        $days = $location['max_delivery_limit'];
        $end->add(new DateInterval('P' . $days . 'D'));
        
        //Find and add Sat/Sun
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);
        foreach ($period as $dt) {
           if(!in_array($dt->format("Y-m-d"), $closed_days)) {
               break;
            }
            $min_date++;
        }
        
        

        $output = array();
        $output['min_date'] = $min_date;
        $output['max_date'] = $days;
        $output['closed_days'] = $closed_days;
        echo json_encode($output);
        exit();
    }
	
	function buttons($lid = 0) {
        $this->load->model('Locationmodel');
        $this->load->helper('text');
        $this->load->library('form_validation');

        $location = $this->Locationmodel->getDetails($lid);
        if(!$location) {
            show_404('');
        }
        
        $closed_days = $this->Locationmodel->getClosedDates($location['location_id']);
        
        $min_date = 0;
        $start = new DateTime(date('Y-m-d'));
        $current_time = date("H:i", time());
        $cutoff_time = $location['location_cutoff_time'];
        if ($current_time > $cutoff_time) {
            $min_date++;
            $start->add(new DateInterval('P1D'));
        }
        $end = new DateTime(date('Y-m-d'));
        $days = $location['max_delivery_limit'];
        $end->add(new DateInterval('P' . $days . 'D'));
        
        //Find and add Sat/Sun
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);
        foreach ($period as $dt) {
           if(!in_array($dt->format("Y-m-d"), $closed_days)) {
               break;
            }
            $min_date++;
        }
		
		
		$min_dt = new DateTime($min_date);
		$max_dt = new DateTime($max_date);
		
		$min_ts = $min_dt->getTimestamp();
		$max_ts = $max_dt->getTimestamp();
		
		$current_ts = time();
		$show_today = false;
		
		if($current_ts >= $min_ts && $current_ts <= $max_ts) {
			$show_today = true;
		}
		
		$today_date = date("Y-m-d");
        

        $output = array();
        $output['min_date'] = $min_date;
        $output['max_date'] = $days;
        $output['closed_days'] = $closed_days;
        echo json_encode($output);
        exit();
    }

}

?>