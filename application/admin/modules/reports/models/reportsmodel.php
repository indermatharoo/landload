<?php

class Reportsmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function test() {
        $this->db->select('t2.name,t1.franchise_target,t1.id as franchise_id,t3.event_type_id as event_type, sum(t4.total_customer) as no_of_customer, count(*) as no_of_event,t5.no_of_event,t5.no_of_customer');
        $this->db->from('user_extra_detail t1');
        $this->db->join('aauth_users t2', 't1.id = t2.id OR t1.id = t2.pid');
        $this->db->join('eventbooking_events t3', 't3.user_id = t2.id OR t3.user_id = t2.pid');
        $this->db->join('event_complete t4', 't4.event_id=t3.event_id');
        $this->db->join('targets t5', 't5.user_id=t1.id AND t5.event_type=t3.event_type_id');
        $this->db->where('t1.franchise_target <>', '');
        $this->db->group_by('franchise_id,event_type');
        $rs = $this->db->get()->result_array();
        e($rs);
    }

    function getAllFranchise() {
        $this->db->select('aauth_users.id,aauth_users.name,aauth_users.email')
                ->from('aauth_users')
                ->join('aauth_user_to_group', 'aauth_users.id = aauth_user_to_group.user_id')
                ->join('user_extra_detail', 'aauth_users.id = user_extra_detail.id')
                ->join('franchise_region', 'franchise_region.id = user_extra_detail.region')
                ->where('aauth_user_to_group.group_id', 3);
        $rs = $this->db->get()->result_array();
        return $rs;
    }

    function getEventTypes() {
        $this->db->from('eventbooking_event_type');
        $rs = $this->db->get()->result_array();
        return $rs;
    }

    function franchiseTargets() {
        $targetTypes = $this->usermodel->getTargetTypes();
        $allfranchises = self::getAllFranchise();
        $eventTypes = self::getEventTypes();
        $this->db->select('aauth_users.name,aauth_users.id,targets.*,');
        $this->db->from('user_extra_detail');
        $this->db->join('aauth_users', 'user_extra_detail.id=aauth_users.id');
        $this->db->join('targets', 'user_extra_detail.id=targets.user_id');
        $rs = $this->db->get()->result_array();
//        e($rs);
//        e($targetTypes);
//        e($allfranchises);
//        e($eventTypes);
        $main_array = array();
        foreach ($allfranchises as $franchise):
//            e($franchise);
            foreach ($eventTypes as $event):
//                e($event);
                foreach ($targetTypes as $target):
//                    e($target);
                    $franchise_id = arrIndex($franchise, 'id');
                    $event_id = arrIndex($event, 'event_type_id');
                    $target_id = arrIndex($target, 'id');
                    foreach ($rs as $result) {
                        $no_of_event = $no_of_customer = 0;
                        if ((arrIndex($result, 'user_id') == $franchise_id) && (arrIndex($result, 'target_id') == $target_id) && arrIndex($result, 'event_type') == $event_id) {
                            $no_of_event = arrIndex($result, 'no_of_event');
                            $no_of_customer = arrIndex($result, 'no_of_customer');
                            $main_array[$franchise_id]['detail'] = $franchise;
                            $main_array[$franchise_id]['data'][$event_id][$target_id] = array(
                                'no_of_event' => $no_of_event,
                                'no_of_customer' => $no_of_customer
                            );
                        } else {
                            if (!isset($main_array[$franchise_id]['data'][$event_id][$target_id])) {
                                $main_array[$franchise_id]['detail'] = $franchise;
                                $main_array[$franchise_id]['data'][$event_id][$target_id] = array(
                                    'no_of_event' => $no_of_event,
                                    'no_of_customer' => $no_of_customer
                                );
                            }
                        }
                    }
                endforeach;
//                e($main_array);
            endforeach;
        endforeach;
//        e($main_array);
        return $main_array;
    }

    function updateOrCreateTraget($params = array()) {
        if (!arrIndex($params, 'user_id') || !arrIndex($params, 'target_id') || !arrIndex($params, 'event_type')) {
            return false;
        }
        $this->db->where('user_id', arrIndex($params, 'user_id'));
        $this->db->where('target_id', arrIndex($params, 'target_id'));
        $this->db->where('event_type', arrIndex($params, 'event_type'));
        $rs = $this->db->get('targets')->row_array();
        if (count($rs)) {
            $this->db->where('user_id', arrIndex($params, 'user_id'));
            $this->db->where('target_id', arrIndex($params, 'target_id'));
            $this->db->where('event_type', arrIndex($params, 'event_type'));
            $this->db->update('targets', $params);
//            e($this->db->last_query());
        } else {
            $this->db->insert('targets', $params);
        }
    }

    function getTargetPerformance() {
        $query = "
            select count(*) as no_of_event_have,sum(t4.total_customer) as no_of_customer_have,t6.name,t7.event_type as event_name
            ,t1.id as fid,t1.franchise_target,t3.event_type_id,t5.exclude_weekends,
            DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(`t1`.`franchise_target`, ' - ', 1), '%d/%m/%Y'), '%Y-%m-%d') as starget,
            DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(`t1`.`franchise_target`, ' - ', -1), '%d/%m/%Y'), '%Y-%m-%d') as ltarget,
            t5.target_id,t5.no_of_event as no_of_event_have_to,t5.no_of_customer as no_of_customer_have_to
            from dpd_user_extra_detail t1
            join dpd_aauth_users t2 on t2.id = t1.id OR t2.pid=t1.id
            join dpd_eventbooking_events t3 on t3.user_id=t2.id
            AND (t3.event_start_ts > DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(`t1`.`franchise_target`, ' - ', 1), '%d/%m/%Y'), '%Y-%m-%d')) 
            AND (t3.event_end_ts < DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(`t1`.`franchise_target`, ' - ', -1), '%d/%m/%Y'), '%Y-%m-%d'))
            join dpd_event_complete t4 on t4.event_id=t3.event_id
            join dpd_targets t5 on t5.user_id=t1.id and t5.event_type=t3.event_type_id
            join dpd_targets_type t6 on t6.id=t5.target_id
            join dpd_eventbooking_event_type t7 on t7.event_type_id=t3.event_type_id
            where t1.franchise_target <> ''
            group by fid,event_type_id,target_id
            ;
            ";
//        e($query);
        $rs = $this->db->query($query)->result_array();
        $main_array = array();
        foreach ($rs as $row):
            $target_start = arrIndex($row, 'starget');
            $current_time = date('Y-m-d'); // current date
            $current_time = '2015-03-31';
            $exclude_weekends = arrIndex($row, 'exclude_weekends', 1);
            switch (arrIndex($row, 'target_id')):
                case 1: //daily
                    $differ = daysBettween($target_start, $current_time, $exclude_weekends, 'D');
                    break;
                case 2: // weekly
                    $differ = daysBettween($target_start, $current_time, $exclude_weekends, 'W');
                    break;
                case 3: // monthly
                    $differ = monthsBetween($target_start, $current_time);
                    break;
                case 4: // yearly
                    $differ = daysBettween($target_start, $current_time, $exclude_weekends, 'Y');
                    break;
            endswitch;
            $no_of_event_have_to_yet = arrIndex($row, 'no_of_event_have_to') * $differ;
            $no_of_customer_have_to_yet = arrIndex($row, 'no_of_customer_have_to') * $differ;
            if ($no_of_event_have_to_yet):
                $_event_percet = round(((arrIndex($row, 'no_of_event_have') / $no_of_event_have_to_yet) * 100), 2);
            else:
                $_event_percet = 0;
            endif;
            if ($no_of_customer_have_to_yet):
                $_customer_percet = round(((arrIndex($row, 'no_of_customer_have') / $no_of_event_have_to_yet) * 100), 2);
            else:
                $_customer_percet = 0;
            endif;
            if (isset($main_array[arrIndex($row, 'event_type_id')][arrIndex($row, 'target_id')])) {
//                e($main_array[arrIndex($row, 'event_type_id')][arrIndex($row, 'target_id')], 0);
                $temp = $main_array[arrIndex($row, 'event_type_id')][arrIndex($row, 'target_id')];
                $temp['count'] += 1;
                $temp['_event_percet'] += $_event_percet;
                $temp['_customer_percet'] += $_customer_percet;
                if($_event_percet > 90){
                }
                if($_customer_percet > 90){
                    
                }
//                e($_event_percet, 0);
//                e($_customer_percet, 0);
//                e($temp);
                $main_array[arrIndex($row, 'event_type_id')][arrIndex($row, 'target_id')] = $temp;
            } else {
                $main_array[arrIndex($row, 'event_type_id')][arrIndex($row, 'target_id')] = array(
                    'count' => 1,
                    '_event_percet' => $_event_percet,
                    '_customer_percet' => $_customer_percet,
                    'event_name' => ucfirst(arrIndex($row, 'event_name')),
                    'name' => ucfirst(arrIndex($row, 'name'))
                );
            }
//            e($main_array);
        endforeach;
//        e($main_array);
        return $main_array;
    }

}
