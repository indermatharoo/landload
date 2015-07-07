<?php

class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('calender/event');
        $this->load->model('user/usermodel');
    }

    function filter($range = '4-6') {
        $ranges = explode('-', $range);
        $inner['start'] = current($ranges);
        $inner['end'] = end($ranges);
        $this->load->model('usermodel');
        $rangeArray = self::getRangeNumbers($inner['start'], $inner['end']);
        $inner['dasbBoardData'] = $this->usermodel->ajaxFilterDashboardData($rangeArray, self::getYearFromRange($range), $this->ids);
        $inner['monLabel'] = self::getRangeLabel($inner['start'], $inner['end']);
        $page['content'] = $this->load->view('dashboard/quaterly', $inner);
//        $this->load->view($this->dashboard, $page);
    }

    function back() {
        $syear = $this->session->userdata('syear');
        $eyear = $this->session->userdata('eyear');
        $inner['dasbBoardData'] = $this->usermodel->dasbBoardData($syear, $eyear);
        $this->load->view('dashboard/back', $inner);
    }

    function eventdetail() {
//        gAParams();
        $range = gParam('range');
        $type = gParam('type');
        $range = explode('-', $range);
        if (count($range) != 2 || !$type)
            return false;
        $year = self::getYearFromRange(gParam('range'));
        $rangeNumbers = self::getRangeNumbers(current($range), end($range));
//        e($type);
        if (strpos($type, '__income') || strpos($type, '__retail_buyed')) {
            if (strpos($type, '__income'))
                $type = str_replace('__income', '_INCOME', $type);
            if (strpos($type, '__retail_buyed'))
                $type = str_replace('__retail_buyed', '_RETAILS', $type);
            self::detaill($rangeNumbers, $type, $year);
        } else {
            self::detaill($rangeNumbers, $type, $year);
        }
    }

    function detaill($rangeNumbers = array(), $type, $year) {
        $type = explode('_', $type);
        $typee = (count($type) == 2) ? end($type) : 0;
        if ($type[0] == 'RETAILS') {
            $type = Event::$types;
        } else {
            $type = array(arrIndex(Event::$types, $type[0]));
        }
        $type = implode(',', $type);
//        e($rangeNumbers,0);   //  months range
//        e($type,0);   //  event type
//        e($typee);    // represent customer or income or retail
        $result = $this->usermodel->eventStat($rangeNumbers, $type, $year, $typee);
//        e($result);
        echo json_encode($result);
    }

    function getRangeLabel($start, $end) {
        $temp = array();
        for ($i = $start; $i <= $end; $i++) {
            $number = $i;
            switch ($number) {
                case 1:
                    $number = 'Jan';
                    break;
                case 2:
                    $number = 'Feb';
                    break;
                case 3:
                    $number = 'Mar';
                    break;
                case 4:
                    $number = 'April';
                    break;
                case 5:
                    $number = 'May';
                    break;
                case 6:
                    $number = 'Jun';
                    break;
                case 7:
                    $number = 'July';
                    break;
                case 8:
                    $number = 'Aug';
                    break;
                case 9:
                    $number = 'Sep';
                    break;
                case 10:
                    $number = 'Oct';
                    break;
                case 11:
                    $number = 'Nov';
                    break;
                case 12:
                    $number = 'Dec';
                    break;
            }
            $temp[$i] = $number;
        }
        return $temp;
    }

    function getRangeNumbers($start, $end) {
        $temp = array();
        for ($i = $start; $i <= $end; $i++) {
            $number = $i;
            switch ($number) {
                case 1:
                    $number = '01';
                    break;
                case 2:
                    $number = '02';
                    break;
                case 3:
                    $number = '03';
                    break;
                case 4:
                    $number = '04';
                    break;
                case 5:
                    $number = '05';
                    break;
                case 6:
                    $number = '06';
                    break;
                case 7:
                    $number = '07';
                    break;
                case 8:
                    $number = '08';
                    break;
                case 9:
                    $number = '09';
                    break;
            }
            $temp[] = $number;
        }
        return $temp;
    }

    function getYearFromRange($range) {
        $year = $this->session->userdata('syear');
        switch ($range) {
            case '1-3':
                $year = $this->session->userdata('eyear');
                break;
        }
        return $year;
    }

    function saveFilter() {
        $ids = gParam('id');
        $value = gParam('val');
        if ($ids == 'year') {
            $year = explode('-', $value);
            $this->session->set_userdata('syear', current($year));
            $this->session->set_userdata('eyear', end($year));
        }
        $this->session->set_userdata($ids, $value);
        $data = $this->session->all_userdata();
//        e($data);
    }

    function regionReport() {
        $syear = $this->session->userdata('syear');
        $eyear = $this->session->userdata('eyear');
        $reportType = $this->session->userdata('reporttype');
        $template = ($reportType == 'default') ? 'regionfull' : 'region';
//        e($reportType);
        switch ($reportType) {
            case 'region_customer':
                $inner['get'] = 'customers';
                $inner['dasbBoardData'] = $this->usermodel->dasbBoardRegion($syear, $eyear);
                break;
            case 'region_income':
                $inner['get'] = 'income';
                $inner['dasbBoardData'] = $this->usermodel->dasbBoardRegion($syear, $eyear);
                break;
            default:
                $inner['get'] = 'income';
                $inner['dasbBoardData'] = $this->usermodel->dasbBoardRegion($syear, $eyear);
                break;
        }
        $inner['regions'] = $this->db->get('franchise_region')->result_array();

        $regions = array();
        foreach ($inner['regions'] as $temp):
            $regions[arrIndex($temp, 'id')] = $temp;
        endforeach;
        $inner['regions'] = $regions;
        if (count($inner['dasbBoardData'])) {
//            $page['content'] = $this->load->view("dashboard/$template", $inner);
            $page['content'] = $this->load->view("dashboard/region", $inner);
//            $page['content'] = $this->load->view("dashboard/region", $inner, true);
//            $this->load->view($this->dashboard, $page);
        } else
            $page['content'] = $this->load->view("dashboard/notFound", $inner);
    }

    function franchiseReport() {
        $syear = $this->session->userdata('syear');
        $eyear = $this->session->userdata('eyear');
        $reportType = $this->session->userdata('reporttype');
        $template = ($reportType == 'default') ? 'regionfull' : 'region';
        switch ($reportType) {
            case 'franchise_customer':
                $inner['get'] = 'customers';
                $inner['dasbBoardData'] = $this->usermodel->dasbBoardFranchise($syear, $eyear);
                break;
            case 'franchise_income':
                $inner['get'] = 'income';
                $inner['dasbBoardData'] = $this->usermodel->dasbBoardFranchise($syear, $eyear);
                break;
            default:
                $inner['get'] = 'income';
                $inner['dasbBoardData'] = $this->usermodel->dasbBoardFranchise($syear, $eyear);
                break;
        }
//        e($inner['dasbBoardData']);
        $inner['regions'] = $this->usermodel->getAllFranchise();
        $regions = array();
        foreach ($inner['regions'] as $temp):
            $temp['name'] = "<a href=" . createUrl('user/profile/' . $temp['id']) . ">" . $temp['name'] . "</a>";
            $regions[arrIndex($temp, 'id')] = $temp;
        endforeach;
        $inner['regions'] = $regions;
        if (count($inner['dasbBoardData'])) {
            $page['content'] = $this->load->view("dashboard/$template", $inner);
//            $page['content'] = $this->load->view("dashboard/regionfull", $inner,true);
//            $this->load->view($this->dashboard, $page);
        } else
            $page['content'] = $this->load->view("dashboard/notFound", $inner);
    }

    function regionfranchise() {
        $data = $this->session->all_userdata('regions');
        $regions = arrIndex($data, 'regions');
        $franchises = $this->usermodel->getAllFranchise($regions);
        $html = '';
        foreach ($franchises as $franchise):
            $html .= "<option value=" . arrIndex($franchise, 'id') . ">" . arrIndex($franchise, 'name') . "</option>";
        endforeach;
        echo $html;
    }

    function loadGoogleChart() {
        $this->load->view("dashboard/chart");
    }

    function franchiseClass() {
        $inner = array();
        $inner['eventType'] = null;
        $custom_groupby = false;
        $type = gParam('type');
//        $type = 'CLASS__income';
        $franchise = gParam('franchise');
        $ids = ($franchise) ? array($franchise) : array();
        $arr = explode('__', $type);
        $eventType[] = Event::$types[$arr[0]];
        if (Event::$types[$arr[0]] == 9) {
            $eventType = Event::$types;
            $inner['eventType'] = Event::$types1[9];
        } else {
            $inner['eventType'] = $type;
        }
        $syear = $this->session->userdata('syear');
        $eyear = $this->session->userdata('eyear');
        $inner['models'] = $this->usermodel->dashboardEventFilter($syear, $eyear, $ids, $eventType,$this->ids);
        $inner['display'] = $arr[1];
//        e($inner['models']);
        if (!count($inner['models'])) {
            return false;
        }
        $page['content'] = $this->load->view("dashboard/franchisesRegions", $inner);
    }

    function franchiseClass1() {
        $this->usermodel->dashboardEventFilter1('2014', '2015', array(), Event::$types);
    }

    function getUserSession() {
        e($this->session->all_userdata());
    }

}
