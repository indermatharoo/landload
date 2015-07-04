<?php

class Locationmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getDetails($lid) {
        $this->db->where('location_id', intval($lid));
        $rs = $this->db->get('location');
        if ($rs->num_rows() == 1) {
            return $rs->row_array();
        }
        return FALSE;
    }

    function listAll() {
        $rs = $this->db->get('location');
        return $rs->result_array();
    }

    function getClosedDays($lid) {
        $this->db->from('location_holidays');
        $this->db->where('location_id', $lid);
        $this->db->where('is_active', 1);
        $rs = $this->db->get();
        return $rs->result_array();
    }
    
    function getClosedDates($lid) {
        $closed_days = array();
        
        $location = $this->getDetails($lid);
        if(!$location) return FALSE;
        
        $start = new DateTime(date('Y-m-d'));
        $current_time = date("H:i", time());
        $cutoff_time = $location['location_cutoff_time'];
        if ($current_time > $cutoff_time) {
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
        $rs = $this->Locationmodel->getClosedDays($lid);
        foreach ($rs as $row) {
            $dt = $row['date'];
            if ($row['recurring'] == 1) {
                $dt_arr = explode('-', $dt);
                $dt = date('Y') . '-' . $dt_arr[1] . '-' . $dt_arr[2];
            }
            $closed_days[] = $dt;
        }
        
        return $closed_days;
    }

}

?>