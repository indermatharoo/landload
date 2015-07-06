<?php

/**
 * dpd_survey_survey
 * 
  private $id;
  private $category_id;
  private $assigne_grp
  private $name;
  private $multipage;
  private $description;
  private $final_page_text;
  private $creation_date;
  private $update_date;
  private $start_date;
  private $expired_date;
  private $is_active;
  private $url_key;
 */
class SurveySurveymodel extends CI_Model {

    private $id;
    private $assigne_grp;
    private $assigne_id;
    private $creator_id;
    private $name;
    private $multipage;
    private $description;
    private $final_page_text;
    private $creation_date;
    private $update_date;
    private $start_date;
    private $expired_date;
    private $is_active;
    private $url_key;

    function __construct() {
        parent::__construct();
        $this->id = 'id';
        $this->name = 'name';
        $this->url_key = 'url_key';
        $this->multipage = 'multipage';
        $this->is_active = 'is_active';
        $this->start_date = 'start_date';
        $this->update_date = 'update_date';
        $this->description = 'description';
        $this->assigne_id = 'assigne_id';
        $this->creator_id = 'creator_id';
        $this->assigne_grp = 'assigne_grp';
        $this->expired_date = 'expired_date';
        $this->creation_date = 'creation_date';
        $this->final_page_text = 'final_page_text';
    }

    function detailById($id) {
        $this->db->where($this->id, intval($id));
        $rs = $this->db->get('survey_survey');
        if ($rs->num_rows()) {
            return $rs->row_array();
        }
        return FALSE;
    }

    function detailByCategId($id) {
        $this->db->where($this->category_id, intval($id));
        $rs = $this->db->get('survey_survey');
        if ($rs->num_rows()) {
            return $rs->result_array();
        }
        return FALSE;
    }

    function detailBySurveys($param = array()) {
        $this->db->select('survey_survey.id,'
                        . 'aauth_groups.name as "assigned_group", '
                        . 'survey_survey.name, '
                        . 'description, '
                        . 'date(start_date), '
                        . 'date(expired_date)')
                ->from('survey_survey')
                ->join('aauth_groups', 'assigne_id=aauth_groups.id', 'LEFT')
                ->order_by('expired_date', 'desc');
        if (isset($param['where'])) {
            foreach ($param['where'] as $fld => $fldVal) {
                $this->db->where($fld, $fldVal);
            }
        }
        $rs = $this->db->get();
        if ($rs->num_rows()) {
            return $rs->result_array();
        }
        return FALSE;
    }

    //count all 
    function countAll() {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())):
            $this->db
                    ->where('is_active', '1')
                    ->where('assigne_id', curUsrId())
                    ->from('survey_survey');
        else:
            $this->db
                    ->where('is_active', '1')
                    ->from('survey_survey');
        endif;
        return $this->db->count_all_results();
    }

    function countRunning() {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())):
            $this->db
                    ->where($this->expired_date . ' >= now() ')
                    ->where('assigne_id', curUsrId())
                    ->from('survey_survey');
        else:
            $this->db->where($this->expired_date . ' >= now() ')->from('survey_survey');
        endif;
        return $this->db->count_all_results();
    }

    function getExpiredCount() {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())):
            $this->db
                    ->where($this->expired_date . ' < now() ')
                    ->where('assigne_id', curUsrId())
                    ->from('survey_survey');
        else:
            $this->db->where($this->expired_date . ' < now() ')->from('survey_survey');
        endif;
        return $this->db->count_all_results();
    }

    //list all 
    function listAll($offset = false, $limit = false) {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
        $rs = $this->db->where('is_active', '1')->get('survey_survey');
        if (!$rs->num_rows()) {
            return FALSE;
        }
        return $rs->result_array();
    }

    //function to insert record
    function insertUpdateRecord($param = array()) {
        $this->load->library('Notification');
        $data = array();
        $data[$this->update_date] = date('Y-m-d H:i:s');
        $data[$this->name] = $this->input->post($this->name, TRUE);
        //$data[$this->is_active] = $this->input->post($this->is_active, TRUE);
        $data[$this->creator_id] = $this->session->userdata['id'];
        $data[$this->assigne_grp] = $this->input->post($this->assigne_grp, TRUE);
        $data[$this->description] = $this->input->post($this->description, TRUE);
        $data[$this->final_page_text] = $this->input->post($this->final_page_text, TRUE);
        $data[$this->assigne_id] = isset($_POST['assigne_id']) ? $_POST['assigne_id'] : 0;
        if (is_null($data[$this->assigne_grp]) || empty($data[$this->assigne_grp]) || !$data[$this->assigne_grp]
        ) {
            $data[$this->assigne_grp] = 0;
        }
        if (is_array($data[$this->assigne_id])) {
            $data[$this->assigne_id] = implode(',', $data[$this->assigne_id]);
        }
        $survey_range = $_POST['survey_range'];
        $survey_range = explode('-', $survey_range);
        $survey_range[1] = explode('/', $survey_range[1]);
        $survey_range[0] = explode('/', $survey_range[0]);
        $survey_range[0] = trim($survey_range[0][2]) . '-' . trim($survey_range[0][1]) . '-' . trim($survey_range[0][0]);
        $survey_range[1] = trim($survey_range[1][2]) . '-' . trim($survey_range[1][1]) . '-' . trim($survey_range[1][0]);

        $survey_range[0] = strtotime($survey_range[0]);
        $survey_range[1] = strtotime($survey_range[1]);
        $data[$this->start_date] = date('Y-m-d', $survey_range[0]);
        $data[$this->expired_date] = date('Y-m-d', $survey_range[1]);
        $editId = $this->input->post('editsurvey', true);

        if ($editId) {
            $this->db->where('id', $editId);
            $this->db->update('survey_survey', $data);
            return $editId;
        } else {
            $data[$this->creation_date] = date('Y-m-d H:i:s');
            $this->db->insert('survey_survey', $data);
            $survey_id = $this->db->insert_id();

            $notify_data = array(
                'class' => $this->router->fetch_class(),
                'method' => $this->router->fetch_method(),
                'creator_id' => $data[$this->creator_id],
                'creator_name' => $this->session->userdata['name'],
                'sender_id' => $data[$this->creator_id],
                'sender_name' => $this->session->userdata['name'],
                'assigne_grp' => $data[$this->assigne_grp],
                'assigne_id' => $data[$this->assigne_id],
                'event_title' => $data[$this->name],
                'event_id' => $survey_id,
                'filter' => '',
            );

            $this->notification->notify($notify_data);
            return $survey_id;
        }
        return false;
    }

    //delete record
    function deleteRecord($param = array()) {
        $data = array();
        $data[$this->is_active] = 0;
        $this->db->where('id', $param['id']);
        $this->db->delete('survey_survey');
    }

    function getAssignedSurvey() {
        $userId = $this->session->userdata['id'];
        $rst = $this->db->select('distinct(survey_id)')->from('survey_answer')->where('user_id', $userId)->get();
        $rstId = array();

        if ($rst->num_rows) {
            $rstId = $rst->result_array();
            foreach ($rstId as $key => $kval) {
                $rstTmp[] = $kval['survey_id'];
            }
        } else {
            $rstTmp = array('0');
        }

        $sql = 'SELECT `dpd_survey_survey`.`id`, '
                . '`dpd_survey_survey`.`name`, '
                . '`dpd_survey_survey`.`description` '
                . 'FROM (`dpd_survey_survey`) '
                . 'WHERE id NOT IN (' . implode(',', $rstTmp) . ')'
                . ' AND (`assigne_id` LIKE "%,' . $userId . ',%"'
                . ' OR `assigne_id` LIKE "%,' . $userId . '"'
                . ' OR `assigne_id` LIKE "' . $userId . ',%" OR `assigne_id` LIKE "' . $userId . '%")';
        $rst = $this->db->query($sql);
        if ($rst->num_rows) {
            return $rst->result_array();
        }
        return array();
    }

    function getSurveyCountReport() {
        
    }

}

?>
