<?php

class Companymodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //Count All Records
    function countAll() {
        $this->db->from(convertToAuthStr('users'));
        return $this->db->count_all_results();
    }

    //Get List of countries

    function getCountry() {
        $query = $this->db->get('country');
        $row = $query->result_array();
        return $row;
    }

    //attributes
    function labels() {
        return array(
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'home_address' => 'Home Address',
            'bussiness_address' => 'Bussiness Address',
            'bussiness_number' => 'Bussiness Number',
            'vat_number' => 'Vat Number',
            'start_date' => 'Start Date',
            'telephone' => 'Telephone',
            'linkedin' => 'Linkedin',
            'pinterest' => 'Pinterest',
            'google' => 'Google',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'paypal' => 'Paypal',
            'mon_fee_type' => 'Fee Type',
            'fee_increase_year' => 'Amount To Pay',
            'region' => 'Region Name',
            'log' => 'Longitude',
            'lat' => 'Latitude',
            'franchise_no' => 'Franchise No',
            'territory_name' => 'Territory Name',
            'post_code' => 'Post Code',
            'store_id' => 'Store Id'
        );
    }

    //List All Records
    function listAll($ids = array()) {
        if (count($ids)) {
            $this->db->where_in('pid', $ids);
            $this->db->or_where_in('id', $ids);
        }
        $this->db->where('id !=', curUsrId());
        $this->db->where('id !=', curUsrPid());
        $this->db->from(convertToAuthStr('users'));
        $this->db->join(
                convertToAuthStr('user_to_group'), convertToAuthStr('user_to_group') . '.user_id = ' . convertToAuthStr('users') . '.id'
                . ' and dpd_' . convertToAuthStr('user_to_group') . '.group_id!=6'
        );
        $rs = $this->db->get();
        return $rs->result_array();
    }

    //List All Records
    function listAllAsGrp($offset = FALSE, $limit = FALSE, $columns = null, $param = array()) {

        if ($columns) {
            $this->db->select($columns);
        }
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
        $this->db->from(convertToAuthStr('users'));
        $this->db->join(convertToAuthStr('user_to_group'), convertToAuthStr('user_to_group') . '.user_id = ' . convertToAuthStr('users') . '.id');
        if (isset($param['where'])) {
            $this->db->where($param['where']);
        }
        $rs = $this->db->get();
        return $rs->result_array();
    }

    //List All Records
    function fetchAllRole() {
        $rs = $this->db->get('role');
        return $rs->result_array();
    }

    //Get User Detial
    function fetchByID($uid) {

        $this->db->select('*')
                ->from('aauth_users')
                ->join('user_extra_detail', 'user_extra_detail.id=aauth_users.id')
                ->where('aauth_users.id', $uid);

//        $this->db->where('id', intval($uid));
//        $this->db->where('is_active', 1);
        $rs = $this->db->get();
        if ($rs && $rs->num_rows() > 0)
            return $rs->row_array();

        return FALSE;
    }

    //Get Current Permission
    function getPermission($uid) {
        $this->db->select('*');
        $this->db->from('permission');
        $this->db->join('user', 'user.role_id = permission.role_id');
        $this->db->where('permission.role_id', intval($uid));
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();

        return FALSE;
    }

    //List Permission
    function listPermission() {
        $rs = $this->db->get('protected_resource');
        return $rs->result_array();
    }

    //get extrafields
    function getExtraFields($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('user_extra_detail')->row();
        if ($query)
            $return = (array) $query;
        else
            $return = tableFields('user_extra_detail', true);
        return $return;
    }

    function uploadImage() {
        $config['upload_path'] = $this->config->item('UPLOAD_PATH_USERS');

        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
        if (count($_FILES) > 0) {
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['image']['tmp_name'])) {
                if (!$this->upload->do_upload('image')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    return $upload_data['file_name'];
                }
            }
        }
        return false;
    }

    function updateChatRecord($id = null, $data = array()) {
        $prefix = $this->db->dbprefix;
        $temp['username'] = $data['name'];
        $temp['displayname'] = $data['name'];
        $temp['id'] = $data['id'];
        if ($id) {
            $this->db->dbprefix = '';
            $this->db->where('id', arrIndex($data, 'id'));
            $result = $this->db->get('cometchat_users')->row();
            if (count($result)) {
                $this->db->dbprefix = '';
                $this->db->where('id', arrIndex($data, 'id'));
                $this->db->update('cometchat_users', $temp);
            } else {
                $this->db->dbprefix = '';
                $this->db->insert('cometchat_users', $temp);
            }
        } else {
            $this->db->dbprefix = '';
            $this->db->insert('cometchat_users', $data);
        }
        if (!$id) {
            $this->db->dbprefix = '';
            $temp = array(
                'userid' => arrIndex($data, 'id'),
            );
            $this->db->insert('cometchat_status', $temp);
        }
        $this->db->dbprefix = $prefix;
    }

    //Add Insert User
    function insertRecord() {

        $user_id = $this->aauth->create_user(gParam('email'), gParam('pass'), gParam('name'), '3', gParam('package'), $this->aauth->get_user()->id, self::uploadImage());

        $data1['company_name'] = $this->input->post('company_name');
        $data1['contact_person'] = $this->input->post('contact_person');
        $data1['phone'] = $this->input->post('phone');
        $data1['mobile'] = $this->input->post('mobile');
        $data1['address'] = $this->input->post('address');
        $data1['city'] = $this->input->post('city');
        $data1['state'] = $this->input->post('state');
        $data1['country'] = $this->input->post('country');
        $data1['id'] = $user_id;

        $this->db->insert('user_extra_detail', $data1);
        return $user_id;
    }

    //Update User
    function updateRecord($uid) {
        $group = current('3');
        if ($this->aauth->getUserGroup($uid) != $group) {
            $this->aauth->remove_member($uid, $this->aauth->getUserGroup());
            $this->aauth->add_member($uid, $group);
        }
        $this->aauth->update_user($uid, gParam('email'), gParam('pass'), gParam('name'), gParam('package'), gParam('store_id'), self::uploadImage());
        $data = array();
        // $data = rSF('user_extra_detail');
//        e($data);
        $data1['company_name'] = $this->input->post('company_name');
        $data1['contact_person'] = $this->input->post('contact_person');
        $data1['phone'] = $this->input->post('phone');
        $data1['mobile'] = $this->input->post('mobile');
        $data1['address'] = $this->input->post('address');
        $data1['city'] = $this->input->post('city');
        $data1['state'] = $this->input->post('state');
        $data1['country'] = $this->input->post('country');
        $data1['id'] = $uid;
        unset($data['id']);
        $this->db->where('id', $uid);
        $row = $this->db->get('user_extra_detail');
        $row = $row->num_rows();
        if ($row) {
            unset($data['start_date']);
            $this->db->where('id', $uid);
            $this->db->update('user_extra_detail', $data1);
        } else {
            $data1['id'] = $uid;
            //$data['start_date'] = time();
            $this->db->insert('user_extra_detail', $data1);
        }
    }

    function updateTargets($uid, $event, $customer, $target, $event_type, $exludeWeekEnd) {
        $result = $this->db->select('*')->get_where('targets', array('user_id' => $uid, 'target_id' => $target, 'event_type' => $event_type));
        $data = array('user_id' => $uid, 'no_of_event' => $event, 'no_of_customer' => $customer, 'target_id' => $target, 'event_type' => $event_type, 'exclude_weekends' => $exludeWeekEnd);
        if (!count($result->row()))
            $this->db->insert('targets', $data);
        else {
            $this->db->where('user_id', $uid);
            $this->db->where('target_id', $target);
            $this->db->where('event_type', $event_type);
            $this->db->update('targets', $data);
        }
    }

    //Update User
    function updateRole($user) {
        $data = array();

        $data['username'] = $this->input->post('username', true);
        $data['email'] = strtolower($this->input->post('email', true));
        if ($this->input->post('passwd', true)) {
            $data['passwd'] = $this->encrypt->encode($this->input->post('passwd', true));
        }
        $this->db->where('user_id', $user['user_id']);
        $this->db->update('user', $data);

        return;

        if ($user['role_id'] == 1)
            return;

        //Delete the previous permission of user
        $this->db->where('role_id', $user['role_id']);
        $this->db->delete('permission');

        //Add user permission
        if ($this->input->post('protected_resource_id', true)) {
            foreach ($this->input->post('protected_resource_id', true) as $item) {
                $resource = array();
                $resource['role_id'] = $user['role_id'];
                //$resource['user_id'] = $user['user_id'];
                $resource['protected_resource_id'] = $item;
                $this->db->insert('permission', $resource);
            }
        }
    }

    //Delete User
    function deleteRecord($user) {
        $this->db->where('id', $user['id']);
        $this->db->where('id !=', 0);
        $this->db->delete(convertToAuthStr('users'));
    }

    //Get User Detial
    function fetchByUsername($username) {
        $this->db->where('username', $username);
        $this->db->where('user_is_active', 1);
        $rs = $this->db->get('user');
        if ($rs && $rs->num_rows() == 1)
            return $rs->row_array();

        return FALSE;
    }

    //function issue password
    function issuePassword($username) {

        //get customer detail on email
        $user = array();
        $user = $this->fetchByUsername($username);

        $passwd = $this->encrypt->decode($user['passwd']);

        //Email to Password Member
        $emailData = array();
        $emailData['DATE'] = date("jS F, Y");
        $emailData['BASE_URL'] = base_url();
        $emailData['USERNAME'] = $user['username'];
        $emailData['PASSWORD'] = $passwd;

        $emailBody = $this->parser->parse('user/emails/lostpasswd', $emailData, TRUE);


        $this->email->initialize($this->config->item('EMAIL_CONFIG'));
        $this->email->from(DWS_EMAIL_NOREPLY, DWS_EMAIL_FROM);
        $this->email->to($user['email']);
        $this->email->subject('Password Recovery');
        $this->email->message($emailBody);
        $this->email->send();
    }

    function updatePassword($user) {
        $data = array();

        if ($this->input->post('passwd')) {
            $data['passwd'] = $this->encrypt->encode($this->input->post('passwd', TRUE));
        }

        $this->db->where('user_id', $user['user_id']);
        $this->db->update('user', $data);
    }

    function returnUserGroup() {
//        e($this->aauth->get_user());
        $start = 1;
        $end = 6;
        if ($this->aauth->isFranshisor())
            $start = 2;
        elseif ($this->aauth->isFranshisee())
            $start = 3;
        elseif ($this->aauth->isUser()) {
            $start = 2;
            $end = 5;
        }
        $this->db->select('*');
        $this->db->from(convertToAuthStr('groups'));
        $condition = array(
            'id > ' => $start,
            'id < ' => $end,
        );
        $this->db->where($condition);
        $query = $this->db->get()->result();
        return $query;
    }

    function returnCurUserGroup($uid) {
        $this->db->select('*');
        $this->db->where('user_id', $uid);
        $query = $this->db->get(convertToAuthStr('user_to_group'))->result_array();
        $data = array();
        foreach ($query as $query):
            $data[arrIndex($query, 'group_id')] = arrIndex($query, 'group_id');
        endforeach;
        return $data;
    }

    function getNotification() {
        $this->db->select('*');
        if (!$this->aauth->isAdmin()) {
            $this->db->where('user_id', self::getNoficationUsers());
        }
        $this->db->order_by('activity_time', 'desc');
        $result = $this->db->get('user_notification', 10, 100);
        $result = $result->result_array();
        return $result;
    }

    function getNoficationUsers() {
        $query = $this->db->query("
            select id from dpd_aauth_users where id =" . $this->aauth->get_user()->id . "
                or pid = " . $this->aauth->get_user()->id . "
                ");
        $temp = array();
        foreach ($query->result_array() as $row):
            $temp[] = $row['id'];
        endforeach;
        $temp = implode(',', $temp);
        return $temp;
    }

    function getTargetTypes() {
        $this->db->select('*');
        $result = $this->db->get('targets_type');
        $result = $result->result_array();
        return $result;
    }

    function notiicationMsg($className = null, $classFunc = null) {
        if (!$classFunc || !$className)
            return 'blank message';
        $msgArr = array(
            'user' => array(
                'index' => 'this is user index',
                'add' => 'this is add funciton',
                'edit' => 'this is a edit function',
            ),
        );
    }

    function dasbBoardData($startYear = '2014', $endYear = '2015', $ids = array()) {
        $ids = implode(',', $ids);
        if ($ids):
            $lastLine = " join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` and t1.user_id in ($ids) group by gid , event_type_id";
        else:
            $lastLine = " join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` group by gid , event_type_id";
        endif;
        $query = "select count(*) as count,event_type_id as type,
        (IFNULL(sum(retail_buyed),0)) as retail_buyed,  (IFNULL(sum(retail_sailed),0)) as retail_sailed,
        (IFNULL(sum(total_customer),0))  as `customers`,
        (IFNULL(sum(total_income),0)) as `income`,
        ( case 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "04 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "05 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "06 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "07 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "08 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "09 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "10 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "11 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $startYear . "12 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $endYear . "01 then 'G4' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $endYear . "02 then 'G4' 
            when DATE_FORMAT(`event_start_ts`,'%Y%m') = " . $endYear . "03 then 'G4'  
            else 0 
        end) as `gid` 
        from dpd_eventbooking_events t1 $lastLine";
//        left join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` group by gid , event_type_id";
//        e($query);
        $results = $this->db->query($query)->result_array();
//        e($results);
        return self::formatDasboardData($results);
    }

    function dasbBoardCustomdate($sdate, $edate, $ids = array()) {
        $ids = implode(',', $ids);
        if ($ids):
            $lastLine = " join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` and t1.user_id in ($ids) group by gid , event_type_id";
        else:
            $lastLine = "                
                join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` 
                where event_start_ts >= '$sdate' AND event_start_ts <= '$edate'
                group by gid , event_type_id
                ";
        endif;
        $query = "select count(*) as count,event_type_id as type,
        (IFNULL(sum(retail_buyed),0)) as retail_buyed,  (IFNULL(sum(retail_sailed),0)) as retail_sailed,
        (IFNULL(sum(total_customer),0))  as `customers`,
        (IFNULL(sum(total_income),0)) as `income`,
        ( case 
            when DATE_FORMAT(`event_start_ts`,'%m') = 04 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 06 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 07 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 08 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 09 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 10 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 11 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 12 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 01 then 'G4' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 02 then 'G4' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 03 then 'G4' 
            else 0 
        end) as `gid` 
        from dpd_eventbooking_events t1 $lastLine";
//        e($query);
//        left join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` group by gid , event_type_id";
//        e($query);
        $results = $this->db->query($query)->result_array();
//        e($results);
        return self::formatDasboardData($results);
    }

    function dasbBoardRegion($startYear = '2014', $endYear = '2015', $ids = array()) {
        $sessionData = $this->session->all_userdata();
        $regions = (arrIndex($sessionData, 'regions')) ? implode(',', arrIndex($sessionData, 'regions')) : array(0);
        $ids = implode(',', $ids);
        if ($this->aauth->isFranshisee()):
            $lastLine = " join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` and t1.user_id in ($ids) group by gid , event_type_id";
        elseif ($this->aauth->isUser()):
            $lastLine = " join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` and t1.user_id in ($ids) group by gid , event_type_id";
        else:
            $lastLine = "
                join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` 
                join dpd_user_extra_detail t3 on t3.id = user_id and t3.region in ($regions)
                group by gid , event_type_id";
        endif;
        $query = "select count(*) as count,event_type_id as type,
        (IFNULL(sum(retail_buyed),0)) as retail_buyed,  (IFNULL(sum(retail_sailed),0)) as retail_sailed,
        (IFNULL(sum(total_customer),0))  as `customers`,
        (IFNULL(sum(total_income),0)) as `income`,
        ( case 
            when DATE_FORMAT(`event_start_ts`,'%m') = 04 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 05 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 06 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 07 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 08 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 09 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 10 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 11 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 12 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 01 then 'G4' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 02 then 'G4' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 03 then 'G4' 
            else 0 
        end) as `gid` 
        from dpd_eventbooking_events t1 $lastLine";
//        left join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` group by gid , event_type_id";
//        e($query);
        $results = $this->db->query($query)->result_array();
        return self::formatDasboardData($results);
    }

    function dashboardEventFilter($startYear = '2014', $endYear = '2015', $ids = array(), $eventType = array(), $userIds = array()) {
        $sessionData = $this->session->all_userdata();
        $regions = (arrIndex($sessionData, 'regions')) ? implode(',', arrIndex($sessionData, 'regions')) : array(0);
        $userIds = implode(',', $userIds);
        if ($userIds) {
            $userIds = " and t1.user_id in ($userIds)";
        } else {
            $userIds = " ";
        }
        $where = " ";
        if (count($eventType)) {
            $eventType = implode(',', $eventType);
            $eventType = " and t1.event_type_id in ($eventType)";
        } else {
            $eventType = " ";
        }
        if (count($ids)) {
            $ids = implode(',', $ids);
            $ids = " and user_id in ($ids) ";
        } else {
            $ids = " ";
        }
        $query = "
                SELECT t1.event_type_id as type,t1.event_id,t3.id as user_id,
                t5.name as regionname , t3.name as franchisename , 
                (IFNULL(sum(retail_buyed),0)) as retail_buyed,  (IFNULL(sum(retail_sailed),0)) as retail_sailed,
                (IFNULL(sum(total_customer),0))  as `customers`,
                (IFNULL(sum(total_income),0)) as `income`, 
                case DATE_FORMAT(`event_start_ts`,'%m')
                when 04 then 'G1'
                when 05 then 'G1'
                when 06 then 'G1'
                when 07 then 'G2'
                when 08 then 'G2'
                when 09 then 'G2'
                when 10 then 'G3'
                when 11 then 'G3'
                when 12 then 'G3'
                when 01 then 'G4'
                when 02 then 'G4'
                when 03 then 'G4'
                else 'unkown_gid'
                end as gid
                from dpd_eventbooking_events t1 
                join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` $ids $eventType
                join dpd_aauth_users t3 on t3.id = t1.user_id $userIds
                join dpd_user_extra_detail t4 on t4.id = IF(t3.pid = 1,t3.id,t3.pid)
                join dpd_franchise_region t5 on t5.id = t4.region and t5.id in ($regions)
                group by gid , user_id
                having gid in ('G1','G2','G3','G4')
                ";
//        e($query);
        $results = $this->db->query($query)->result_array();
//            e($results);
        $mainArray = array();
        foreach ($results as $result):
            if (isset($mainArray[$result['user_id']][$result['gid']])) {
                $temp = $mainArray[$result['user_id']][$result['gid']];
                $result['count'] += arrIndex($temp, 'count', 0);
                $result['retail_buyed'] += arrIndex($temp, 'retail_buyed', 0);
                $result['retail_sailed'] += arrIndex($temp, 'retail_sailed', 0);
                $result['customers'] += arrIndex($temp, 'customers', 0);
                $result['income'] += arrIndex($temp, 'income', 0);
            }
            $mainArray[$result['user_id']][$result['gid']] = $result;
        endforeach;
        foreach ($mainArray as $key => $arr):
            $regionName;
            $franchisename;
            $user_id;
            $type;
            foreach ($arr as $a):
                $regionName = arrIndex($a, 'regionname');
                $franchisename = arrIndex($a, 'franchisename');
                $user_id = arrIndex($a, 'user_id');
                $type = arrIndex($a, 'type');
                break;
            endforeach;
            $mainArray[$key]['G1'] = arrIndex($arr, 'G1', array());
            $mainArray[$key]['G2'] = arrIndex($arr, 'G2', array());
            $mainArray[$key]['G3'] = arrIndex($arr, 'G3', array());
            $mainArray[$key]['G4'] = arrIndex($arr, 'G4', array());
            $mainArray[$key]['regionname'] = $regionName;
            $mainArray[$key]['franchisename'] = $franchisename;
            $mainArray[$key]['user_id'] = $user_id;
            $mainArray[$key]['type'] = $type;
        endforeach;
        return $mainArray;
    }

    function dasbBoardFranchise($startYear = '2014', $endYear = '2015', $ids = array()) {
        $sessionData = $this->session->all_userdata();
        $regions = (arrIndex($sessionData, 'regions')) ? implode(',', arrIndex($sessionData, 'regions')) : array(0);
        $ids = implode(',', $ids);
        if ($this->aauth->isFranshisee()):
            $lastLine = " join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` and t1.user_id in ($ids) group by gid , event_type_id";
        elseif ($this->aauth->isUser()):
            $lastLine = " join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` and t1.user_id in ($ids) group by gid , event_type_id";
        else:
            $lastLine = "
                join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` 
                join dpd_user_extra_detail t3 on t3.id = user_id and t3.region in ($regions)
                group by gid , event_type_id";
        endif;
        $query = "select count(*) as count,user_id,event_type_id as type,region,
        (IFNULL(sum(retail_buyed),0)) as retail_buyed,  (IFNULL(sum(retail_sailed),0)) as retail_sailed,
        (IFNULL(sum(total_customer),0))  as `customers`,
        (IFNULL(sum(total_income),0)) as `income`,        
        ( case 
            when DATE_FORMAT(`event_start_ts`,'%m') = 04 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 05 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 06 then 'G1' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 07 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 08 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 09 then 'G2' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 10 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 11 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 12 then 'G3' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 01 then 'G4' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 02 then 'G4' 
            when DATE_FORMAT(`event_start_ts`,'%m') = 03 then 'G4' 
            else 0 
        end) as `gid` 
        from dpd_eventbooking_events t1 $lastLine";
        $results = $this->db->query($query)->result_array();
//        e($query);
        $mainArray = array();
        foreach ($results as $result):
            if (isset($mainArray[arrIndex($result, 'user_id')][arrIndex($result, 'gid')])) {
                $temp = $mainArray[arrIndex($result, 'user_id')][arrIndex($result, 'gid')];
                $temp['customers'] += arrIndex($result, 'customers');
                $temp['income'] += arrIndex($result, 'income');
                $temp['count'] += arrIndex($result, 'count');
            } else
                $mainArray[arrIndex($result, 'user_id')][arrIndex($result, 'gid')] = $result;
        endforeach;
        $franchises = (arrIndex($sessionData, 'franchises')) ? arrIndex($sessionData, 'franchises') : array();
        $regions = (arrIndex($sessionData, 'regions')) ? arrIndex($sessionData, 'regions') : array();
        $temp = $mainArray;
        $mainArray = array();
        foreach ($temp as $key => $value):
            $temp = array();
            if (!in_array($key, $franchises)) {
                continue;
            }
            $temp['G1'] = self::uNEFIR($value, 'G1', 'region', $regions);
            $temp['G2'] = self::uNEFIR($value, 'G2', 'region', $regions);
            $temp['G3'] = self::uNEFIR($value, 'G3', 'region', $regions);
            $temp['G4'] = self::uNEFIR($value, 'G4', 'region', $regions);
            $mainArray[$key] = $temp;
        endforeach;
//        e($mainArray);
        return $mainArray;
    }

    //unsetNotExistFranchiseInRegion
    function uNEFIR($arrs = array(), $index, $valueIndex, $value = array()) {
        $temp = arrIndex($arrs, $index, array());
        if (in_array(arrIndex($temp, $valueIndex), $value)) {
            return $temp;
        } else {
            return array();
        }
    }

    function getUserRegion($uid) {
        if ($this->aauth->isFranshisee($uid)):
            $user = $this->aauth->get_user($uid);
        endif;
        e($user);
    }

    function eventStat($rangeNumbers, $type, $year, $typee) {
        $string = '';
        $i = 1;
        foreach ($rangeNumbers as $range):
            $string .= "
                when DATE_FORMAT(`event_start_ts`,'%m') = " . $year . $range . " then '$range'
                ";
            $i++;
        endforeach;
        $query = "
            select count(*) as count,t1.user_id as user_id,
            (IFNULL(sum(retail_buyed),0)) as retail_buyed,  (IFNULL(sum(retail_sailed),0)) as retail_sailed,
            (IFNULL(sum(total_customer),0))  as `customers`,
            (IFNULL(sum(total_income),0)) as `income`,
            ( case 
            $string
            else 0 
            end) as `gid`,
            t3.email,t3.name
            from dpd_eventbooking_events t1  
            join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` 
            join dpd_aauth_users t3 on t3.id = t1.user_id
            where t1.event_type_id in ($type)
            group by t1.user_id , gid  
            having gid in (" . implode(',', $rangeNumbers) . ")
        ";
//        e($query);
        $results = $this->db->query($query)->result_array();
//        e($results);
        if ($this->aauth->isFranshisor() || $this->aauth->isFrsUser()) {
            $temp = $franchises = $return = array();
//            e($results);
            foreach ($results as $result):
                if (arrIndex($franchises, $result['user_id'])) {
                    $temp = $franchises[$result['user_id']];
                    $temp['retail_buyed'] += $result['retail_buyed'];
                    $temp['retail_sailed'] += $result['retail_sailed'];
                    $temp['customers'] += $result['customers'];
                    $temp['income'] += $result['income'];
                    $temp['count'] += $result['count'];
                    $franchises[$result['user_id']] = $temp;
                } else {
                    $franchises[$result['user_id']] = $result;
                }
            endforeach;
//            e($franchises);
            foreach ($franchises as $franchise):
                $result = null;
                switch ($typee):
                    case 'CUSTOMER':
                        $result = arrIndex($franchise, 'customers');
                        break;
                    case 'INCOME':
                        $result = '&pound;' . arrIndex($franchise, 'income');
                        break;
                    case 'COUNT':
                        $result = arrIndex($franchise, 'count');
                        break;
                    case 'RETAILS':
                        $result = arrIndex($franchise, 'retail_buyed');
                        break;
                endswitch;
//                e($franchise);
                $return[] = array(
                    'user_id' => arrIndex($franchise, 'user_id'),
                    'result' => $result,
                    'email' => arrIndex($franchise, 'email'),
                    'name' => arrIndex($franchise, 'name'),
                );
//                e($return);
            endforeach;
//            e($return);
            return $return;
        }
    }

    function formatDasboardData($results) {
        $mainArray = array();
        foreach ($results as $result):
            if (!arrIndex($result, 'gid') || !arrIndex($result, 'type'))
                continue;
            $mainArray[arrIndex($result, 'gid')][arrIndex($result, 'type')] = $result;
        endforeach;
        $G = array();
        $G['G1'] = arrIndex($mainArray, 'G1');
        $G['G2'] = arrIndex($mainArray, 'G2');
        $G['G3'] = arrIndex($mainArray, 'G3');
        $G['G4'] = arrIndex($mainArray, 'G4');
        foreach ($G as $key => $value):
            if (!$value)
                $value = array();
            $retail_buyed = $retail_sailed = 0;
            foreach ($value as $arr):
                $retail_buyed += arrIndex($arr, 'retail_buyed', 0);
                $retail_sailed += arrIndex($arr, 'retail_sailed', 0);
            endforeach;
            $value['retail_buyed'] = $retail_buyed;
            $value['retail_sailed'] = $retail_sailed;
            $G[$key] = $value;
        endforeach;
        $mainArray = array();
        foreach (Event::$types as $type):
            foreach ($G as $key => $value):
                $mainArray[$type][] = (arrIndex($G[$key], $type)) ? $G[$key][$type] : array();
            endforeach;
        endforeach;
        $mainArray['retail']['G1']['retail_buyed'] = arrIndex($G['G1'], 'retail_buyed', 0);
        $mainArray['retail']['G1']['retail_sailed'] = arrIndex($G['G1'], 'retail_sailed', 0);
        $mainArray['retail']['G2']['retail_buyed'] = arrIndex($G['G2'], 'retail_buyed', 0);
        $mainArray['retail']['G2']['retail_sailed'] = arrIndex($G['G2'], 'retail_sailed', 0);
        $mainArray['retail']['G3']['retail_buyed'] = arrIndex($G['G3'], 'retail_buyed', 0);
        $mainArray['retail']['G3']['retail_sailed'] = arrIndex($G['G3'], 'retail_sailed', 0);
        $mainArray['retail']['G4']['retail_buyed'] = arrIndex($G['G4'], 'retail_buyed', 0);
        $mainArray['retail']['G4']['retail_sailed'] = arrIndex($G['G4'], 'retail_sailed', 0);
        return $mainArray;
    }

    function ajaxFilterDashboardData($rangeArray, $year, $ids) {
        $string = $join = '';
        if (count($ids)) {
            $ids = implode(',', $ids);
            $join = "join dpd_aauth_users t3 on t3.id = t1.user_id and t3.id in ($ids)";
        }
        $i = 1;
        foreach ($rangeArray as $range):
            $string .= "
                when DATE_FORMAT(`event_start_ts`,'%m') = " . $year . $range . " then 'G$i'
                ";
            $i++;
        endforeach;
        $query = "select count(*) as count,event_type_id as type,
        (IFNULL(sum(retail_buyed),0)) as retail_buyed,  (IFNULL(sum(retail_sailed),0)) as retail_sailed,
        (IFNULL(sum(total_customer),0))  as `customers`,
        (IFNULL(sum(total_income),0)) as `income`,
        ( case
           $string
            else 0 
        end) as `gid` 
        from dpd_eventbooking_events t1
        join dpd_event_complete t2 on t1.`event_id` = t2.`event_id` 
        $join
        group by gid , event_type_id";
//        e($query);
        $results = $this->db->query($query)->result_array();
        $results = self::formatDasboardData($results);
        return $results;
    }

    function getAllFranchise($regions = array()) {
        $this->db->select('aauth_users.*,user_extra_detail.*,franchise_region.name as regionname')
                ->from('aauth_users')
                ->join('aauth_user_to_group', 'aauth_users.id = aauth_user_to_group.user_id')
                ->join('user_extra_detail', 'aauth_users.id = user_extra_detail.id')
                ->join('franchise_region', 'franchise_region.id = user_extra_detail.region')
                ->where('aauth_user_to_group.group_id', 3);
        if (count($regions))
            $this->db->where_in('region', $regions);
        $rs = $this->db->get()->result_array();
        return $rs;
    }

    function getFranchiseUsersId($id = NULL) {
        if (!$id)
            $id = curUsrId();
        $results = $this->db->select('id')
                        ->from(convertToAuthStr('users'))
                        ->where('id', $id)
                        ->or_where('pid', $id)
                        ->get()->result_array();
        $tmp = array();
        foreach ($results as $result):
            $tmp[arrIndex($result, 'id')] = arrIndex($result, 'id');
        endforeach;
        return $tmp;
    }

    function franchiseTarget($id) {
        $results = $this->db
                        ->from('targets')
                        ->where('user_id', $id)
                        ->get()->result_array();
        $temp = array();
        foreach ($results as $result):
            $temp[arrIndex($result, 'event_type')][arrIndex($result, 'target_id')] = array(
                'no_of_event' => arrIndex($result, 'no_of_event'),
                'no_of_customer' => arrIndex($result, 'no_of_customer'),
                'exclude_weekends' => arrIndex($result, 'exclude_weekends', 0),
            );
        endforeach;
        return $temp;
    }

    function franchiseUserEvents($ids, $datee) {
        if (!count($ids))
            return false;
        $ids = implode(',', $ids);
        $results = $this->db
                        ->select('event_complete.*,eventbooking_events.event_type_id')
                        ->from('event_complete')
                        ->join('eventbooking_events', 'eventbooking_events.event_id = event_complete.event_id and user_id in(' . $ids . ')')
                        ->where('eventbooking_events.event_start_ts >=', $datee)
                        ->get()->result_array();
//        e($this->db->last_query());
        $total_customer = 0;
        $temp = array();
        foreach ($results as $result):
            $total_customer = $result['total_customer'];
            if (isset($temp[$result['event_type_id']]['no_of_customer']))
                $temp[$result['event_type_id']]['no_of_customer'] += $total_customer;
            else {
                $temp[$result['event_type_id']]['no_of_customer'] = $total_customer;
            }
            if (isset($temp[$result['event_type_id']]['no_of_event']))
                $temp[$result['event_type_id']]['no_of_event'] += 1;
            else
                $temp[$result['event_type_id']]['no_of_event'] = 1;
        endforeach;
        return $temp;
    }

    function targetcolor() {
        $result = $this->db->get('target_color')->result_array();
        return $result;
    }

    function saveTargetColor($percentage, $color) {
        $this->db->where('percentage', $percentage);
        $result = $this->db->get('target_color')->result_array();
        $data = array('percentage' => $percentage, 'color' => $color);
        if (count($result)) {
            $this->db->where('percentage', $percentage);
            $result = $this->db->update('target_color', $data);
        } else {
            $result = $this->db->insert('target_color', $data);
        }
        return $result;
    }

    function getFranchise($id) {
        if ($this->aauth->isFranshisee($id)):
            $id = $id;
        elseif ($this->aauth->isUser($id)):
            $user = $this->aauth->get_user($id);
            $id = $user->pid;
        else:
            return false;
        endif;
        $this->db->where('id', $id);
        $data = $this->db->get('user_extra_detail')->row();
        return $data;
    }

    function getName($id) {
        $this->db->select('name');
        $this->db->where('id', $id);
        $result = $this->db->get()->row();
        e($result);
    }

    function getRegions() {
        $results = $this->db->get('franchise_region')->result_array();
        return $results;
    }

    function eventsDetail() {
        $this->db->select('eventbooking_events.*,eventbooking_venues.*,eventbooking_bookings.customer_id,eventbooking_bookings.booking_status');
        $this->db->where('customer_id', curUsrId());
        $this->db->from('eventbooking_events');
        $this->db->join('eventbooking_event_type', 'eventbooking_event_type.event_type_id = eventbooking_events.event_type_id', 'left');
        $this->db->join('eventbooking_venues', 'eventbooking_venues.venue_id = eventbooking_events.venue_id', 'left');
        $this->db->join('eventbooking_bookings', 'eventbooking_bookings.event_id = eventbooking_events.event_id', 'left');
        $this->db->order_by('eventbooking_events.event_id', 'desc');
        $rs = $this->db->get();
//        e($rs->result_array());
        return $rs->result_array();
    }

    function IsFirstTimeLogin() {
        $array['first_time_login'] = 'N';
        $this->db->where('id', curUsrId());
        $this->db->update('aauth_users', $array);
        return true;
    }

    function hasCurPageAccess($pid) {
        $this->db->select('*');
        $this->db->where('page_id', $pid);
        $this->db->where('user_id', curUsrId());
        $rs = $this->db->get('page')->result_array();
        return count($rs);
    }

    function getCompanyId($id) {

        $this->db->get('aauth_groups');
    }

    function getRecentCompany() {
        $this->db->order_by("register_date", "desc");
        $this->db->select();
        $this->db->limit(10);
        $this->db->where('aauth_groups.id', 3);
        $this->db->join('aauth_user_to_group', 'aauth_groups.id=aauth_user_to_group.group_id', 'left');
        $this->db->join('aauth_users', 'aauth_users.id=aauth_user_to_group.user_id', 'left');
        $this->db->join('user_extra_detail', 'user_extra_detail.id=aauth_users.id', 'left');
        $res = $this->db->get('aauth_groups');
        return array('num_rows' => $res->num_rows(), 'results' => $res->result_array());
    }

    function countCompany() {
        $this->db->where('aauth_groups.id', 3);
        $this->db->join('aauth_user_to_group', 'aauth_groups.id=aauth_user_to_group.group_id', 'left');
        $this->db->join('aauth_users', 'aauth_users.id=aauth_user_to_group.user_id', 'left');
        $this->db->join('user_extra_detail', 'user_extra_detail.id=aauth_users.id', 'left');
        $res = $this->db->get('aauth_groups');
        return $res->num_rows();
    }
    
    function lineChartData(){
//        $this->db->select('max(year(datetime)) as max_year');
//        $result = $this->db->get('properties')->row_array();
//        $max_year
    }
}

?>
