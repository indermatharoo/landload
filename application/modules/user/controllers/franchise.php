<?php

class Franchise extends Admin_Controller {

    function index() {
        $inner = array();
        $page = array();
        $this->load->model('usermodel');
        $inner['labels'] = array(
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email Id',
            'territory_name' => 'Territory Name',
            'franchise_no' => 'Franchise No',
        );
        $inner['franchises'] = $this->usermodel->getAllFranchise();
        $inner['targetcolors'] = $this->usermodel->targetcolor();
        $page['content'] = $this->load->view('franchise', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function stat($id) {
//        $id = gParam('id');
        if (!$id)
            return false;
//        $id = 2;
        $this->load->model('usermodel');
        $this->load->model('calender/event');
        $ids = $this->usermodel->getFranchiseUsersId($id);
        $targets = $this->usermodel->franchiseTarget($id);
        $colors = $this->usermodel->targetcolor();
        $user_data = $this->usermodel->getFranchise($id);
        $datee = explode(' ', $user_data->franchise_target);
        if (count($datee)):
            $datee = $datee[0];
        else:
            $datee = null;
        endif;
        if ($datee) {
            $datee = explode('/', $datee);
            $tmp[0] = $datee[2];
            $tmp[1] = $datee[1];
            $tmp[2] = $datee[0];
            $datee = implode('-', $tmp);
            $timestamp = strtotime($datee);
        }
        $current_session = $timestamp;
        $workdone = $this->usermodel->franchiseUserEvents($ids, $datee);
        $current_time = time();
        $numDays = round(abs($current_session - $current_time) / 60 / 60 / 24);
//        e($numDays);
        // check targets
        $mainArr = array();
        foreach ($targets as $key => $target):
            foreach ($target as $index => $value):  // target daily weekly monthly yearly
                $exclude_weekends = arrIndex($value, 'exclude_weekends', 0);
                $index = Event::$report[$index];
                $counter = $numDays;
                switch ($index):
                    case 'WEEKLY':
                        $week = 7;
                        $counter = $numDays / $week;
                        break;
                    case 'MONTHLY':
                        $month = 30.50;
                        $counter = $numDays / $month;
                        break;
                    case 'YEARLY':
                        $month = 365;
                        $counter = $numDays / $month;
                        break;
                endswitch;
                $target_wrokdone = arrIndex($workdone, $key);  // work done for current event type
                $cur_target[$index] = array();
                if (arrIndex($value, 'no_of_event')) {
                    $cur_target[$index]['no_of_event']['done'] = arrIndex($target_wrokdone, 'no_of_event');
                    $cur_target[$index]['no_of_event']['outof'] = $counter * arrIndex($value, 'no_of_event');
                    $percentage = round(($cur_target[$index]['no_of_event']['done'] / $cur_target[$index]['no_of_event']['outof']) * 100);
                    $cur_target[$index]['no_of_event']['percentage'] = $percentage;
                }
                if (arrIndex($value, 'no_of_customer')) {
                    $cur_target[$index]['no_of_customer']['done'] = arrIndex($target_wrokdone, 'no_of_customer');
                    $cur_target[$index]['no_of_customer']['outof'] = $counter * arrIndex($value, 'no_of_customer');
                    $percentage = round(($cur_target[$index]['no_of_customer']['done'] / $cur_target[$index]['no_of_customer']['outof']) * 100);
                    $cur_target[$index]['no_of_customer']['percentage'] = $percentage;
                }
            endforeach;
            $mainArr[$key] = $cur_target;
        endforeach;
//        $mainArr

        $page['content'] = $this->load->view('targetpopup', array('data' => $mainArr, 'colors' => $colors), true);
        $this->load->view($this->default, $page);
    }

    function saveTargetColor() {
        $precentages = gParam('percentage');
        $colors = gParam('color');
        $this->load->model('usermodel');
        $this->db->empty_table('target_color');
        foreach ($precentages as $key => $precentage):
            $this->usermodel->saveTargetColor($precentage, arrIndex($colors, $key));
        endforeach;
    }

}