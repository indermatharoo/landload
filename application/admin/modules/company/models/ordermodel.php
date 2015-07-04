<?php

class Ordermodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listOrderItems($oid) {
        $this->db->from('order_item');
        $this->db->where('order_id', $oid);
        $query = $this->db->get();
        return $query->result_array();
    }

    //count all orders
    function countAll($filter) {

        if ($filter['order_from'] != '' && $filter['order_to'] != '') {
            $order_from = strtotime($filter['order_from']);
            //	print_R($order_from); exit();
            $order_to = strtotime($filter['order_to'] . "23:59:00");
            //$this->db->where('delivery_date >=',$order_from);
            //$this->db->where('delivery_date <=',$order_to);
            $this->db->where("order_time BETWEEN '$order_from' AND '$order_to'");
        }
        if ($filter['customer'] != '') {
            $this->db->where("(first_name LIKE '%{$filter['customer']}%' OR last_name LIKE '%{$filter['customer']}%')");
        }

        if ($filter['company_name'] != '') {
            $this->db->where("(company_name LIKE '%{$filter['company_name']}%')");
        }
        if ($filter['email'] != '') {
            $this->db->where("(email LIKE '%{$filter['email']}%')");
        }

        $this->db->where('is_paid', 1);
        $this->db->join('order_detail', 'order_detail.order_id = order.order_id');
        $this->db->join('company', 'company.company_id = order.company_id');
        $company_id = $this->session->userdata('COMPANY_ID');
        if (isset($company_id) && $company_id) {
            $this->db->where('company.company_id', intval($company_id));
        }
        $branch_id = $this->session->userdata('BRANCH_ID');
        if (isset($branch_id) && $branch_id) {
            $this->db->join('branch', 'branch.branch_id = company.branch_id');
            $this->db->where('branch.branch_id', intval($branch_id));
        }
        //echo $this->db->last_query(); exit();
        return $this->db->count_all_results('order');
    }

    function fetchMealDetals($oid) {

        $this->db->join('order_item', 'order_item.order_meal_id = order_meal.order_meal_id', 'left');
        $this->db->where('order_meal.order_id', $oid);
        $query = $this->db->get('order_meal');

        return $query->result_array();
    }

    //list all order
    function listAll($filter, $sort_order_type, $sort_order, $offset = FALSE, $limit = FALSE) {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);

        if ($filter['order_from'] != '' && $filter['order_to'] != '') {
            $order_from = strtotime($filter['order_from']);
            //print_R($order_from); exit();
            $order_to = strtotime($filter['order_to'] . "23:59:00");
            //$this->db->where('delivery_date >=',$order_from);
            //$this->db->where('delivery_date <=',$order_to);
            $this->db->where("FROM_UNIXTIME(order_time, '%Y-%m-%d') BETWEEN '" . date("Y-m-d", $order_from) . "' AND '" . date("Y-m-d", $order_to) . "'");
        }


        if ($filter['customer'] != '') {
            $this->db->where("(first_name LIKE '%{$filter['customer']}%' OR last_name LIKE '%{$filter['customer']}%')");
        }

        if ($filter['company_name'] != '') {
            $this->db->where("(company_name LIKE '%{$filter['company_name']}%')");
        }

        if ($filter['email'] != '') {
            $this->db->where("(email LIKE '%{$filter['email']}%')");
        }

        $this->db->select('*');
        $this->db->from('order');
        $this->db->join('order_detail', 'order_detail.order_id = order.order_id');
        $this->db->join('company', 'company.company_id = order.company_id');
        $this->db->join('location', 'location.location_id = order.location_id');

        $branch_id = $this->session->userdata('BRANCH_ID');

        if (isset($branch_id) && $branch_id) {
            $this->db->join('branch', 'branch.branch_id = company.branch_id');
            $this->db->where('branch.branch_id', intval($branch_id));
        }
        //company 
        $company_id = $this->session->userdata('COMPANY_ID');
        if (isset($company_id) && $company_id) {

            $this->db->where('company.company_id', intval($company_id));
        }

        $this->db->where('is_paid', 1);

        if ($sort_order != '' && $sort_order_type == "name") {
            $this->db->order_by('order_detail.first_name', $sort_order);
        }
        if ($sort_order != '' && $sort_order_type == "date") {
            $this->db->order_by('order.delivery_date', $sort_order);
        } else {
            $this->db->order_by('order.order_time', 'Desc');
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    function groupAll($filter, $sort_order_type, $sort_order, $offset = FALSE, $limit = 5) {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);

        if ($filter['order_from'] != '' && $filter['order_to'] != '') {
            $order_from = strtotime($filter['order_from']);
            //print_R($order_from); exit();
            $order_to = strtotime($filter['order_to'] . "23:59:00");
            //$this->db->where('delivery_date >=',$order_from);
            //$this->db->where('delivery_date <=',$order_to);
            $this->db->where("FROM_UNIXTIME(order_time, '%Y-%m-%d') BETWEEN '" . date("Y-m-d", $order_from) . "' AND '" . date("Y-m-d", $order_to) . "'");
        }


        if ($filter['customer'] != '') {
            $this->db->where("(first_name LIKE '%{$filter['customer']}%' OR last_name LIKE '%{$filter['customer']}%')");
        }

        if ($filter['company_name'] != '') {
            $this->db->where("(company_name LIKE '%{$filter['company_name']}%')");
        }

        if ($filter['email'] != '') {
            $this->db->where("(email LIKE '%{$filter['email']}%')");
        }

             $this->db->select("order.company_id,order.order_id,SUM(dpd_order.cart_total),SUM(dpd_order.order_total) as 'totala',branch.*",FALSE);
//                //$this->db->select_sum("order_total");
//                $this->db->from('order');
//		$this->db->join('company', 'company.company_id = order.company_id');
//                $this->db->join('branch', 'branch.branch_id = company.branch_id');
//                $this->db->join('order_item', 'order_item.order_id = order.order_id');
//                $this->db->join('product', 'product.product_id = order_item.product_id');
//		$this->db->group_by('company_id');
//                $this->db->order_by('totala desc');
//                
          //  $this->db->select("order.company_id,order.order_id,order.cart_total,SUM(dpd_order_item.order_item_qty * dpd_order_item.order_item_price) as 'totala',branch.*,order_item.product_id", FALSE);
        //$this->db->select_sum("order_total");
        $this->db->from('order');
        $this->db->join('company', 'company.company_id = order.company_id');
        $this->db->join('branch', 'branch.branch_id = company.branch_id');
        //$this->db->join('order_item', 'order_item.order_id = order.order_id');

        $this->db->group_by('branch_id');
        $this->db->order_by('totala desc');
        $branch_id = $this->session->userdata('BRANCH_ID');

       // $this->db->where('is_paid', 1);

//        if (isset($branch_id) && $branch_id) {
//            $this->db->join('branch', 'branch.branch_id = company.branch_id');
//            $this->db->where('branch.branch_id', intval($branch_id));
//        }
//        if ($sort_order != '' && $sort_order_type == "date") {
//            
//        } else {
//            $this->db->order_by('order.order_time', 'Desc');
//        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
//                echo "<pre>";
//                print_r($return); exit;
    }

    // Best 5 comapnies based on profit and sales
    
    // Best product performing based on sales AMOUNT(COnsider AMOUNT here)

    function bestprofit($filter, $sort_order_type, $sort_order, $offset = FALSE, $limit = FALSE,$f_type='') {
        
	if ($offset)
			$this->db->offset($offset);
		if ($limit)
			$this->db->limit($limit);	
        
        if($f_type =='profit_and_sale'){
         $this->db->select("order_item.product_id,SUM(dpd_order_item.order_item_qty * dpd_order_item.order_item_price) as 'totala',SUM(dpd_order_item.order_item_qty * dpd_product.cost_price) as 'cost_total',order.order_id,order.company_id,branch.*", FALSE);
        }elseif($f_type == 'best_product'){
            $this->db->select("count(dpd_order.order_id) as total_orders,order_item.product_id,SUM(dpd_order_item.order_item_qty * dpd_order_item.order_item_price) as 'totala',product.*", FALSE);
        }
        $this->db->from('order_item ');
        $this->db->join('product', 'product.product_id = order_item.product_id');
        if($f_type =='profit_and_sale'){
        $this->db->join('order', 'order_item.order_id = order.order_id');
        $this->db->join('company', 'company.company_id = order.company_id');
        $this->db->join('branch', 'branch.branch_id = company.branch_id');
        $this->db->group_by('branch_id');
        }elseif($f_type == 'best_product'){
            $this->db->join('order', 'order.order_id = order_item.order_id');
            $this->db->group_by('product.product_id');
        }
        $this->db->order_by('totala desc');
        $this->db->limit($limit);
        
        $branch_id = $this->session->userdata('BRANCH_ID');

//        $this->db->where('is_paid', 1);

        if (isset($branch_id) && $branch_id) {
            $this->db->join('branch', 'branch.branch_id = company.branch_id');
            $this->db->where('branch.branch_id', intval($branch_id));
        }
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
//                echo "<pre>";
//                print_r($return); exit;
    }

     function bestprofit_b($filter, $sort_order_type, $sort_order, $offset = FALSE, $limit = FALSE,$f_type='') {
        
//        $this->db->select("order_item.product_id,"
//                . "SUM(dpd_order.order_total) as 'totala',"
//                . "SUM(dpd_order_item.order_item_qty * dpd_product.cost_price) as 'cost_total',"
//                . "branch.*", FALSE);
//        
//        
//        $this->db->from('order');
//        $this->db->join('order', 'order.order_id = order_item.order_id');
//        $this->db->join('product', 'order_item.product_id = product.product_id');
//        $this->db->join('company', 'company.company_id = order.company_id');
//        $this->db->join('branch', 'branch.branch_id = company.branch_id');
//       
         
        $this->db->select("SUM(dpd_order_item.order_item_price * dpd_order_item.order_item_qty ) as 'totala',"
                . "SUM(dpd_order_item.order_item_qty * dpd_product.cost_price) as 'cost_total'",FALSE);
        $this->db->from('order_item');
        $this->db->join('order', 'order_item.order_id = order.order_id');
        $this->db->join('company', 'order.company_id = company.company_id');
        //$this->db->join('order_item', 'order.order_id = order_item.order_id');
        $this->db->join('product', 'order_item.product_id = product.product_id');
        //  $this->db->join('branch', 'company.branch_id = branch.branch_id');
        //$this->db->join('order_item', 'order_item.order_id = order.order_id');

        $this->db->group_by('order_item_id');
        
        $this->db->order_by('totala desc');
        $this->db->limit($limit);
        
      //  $branch_id = $this->session->userdata('BRANCH_ID');

//        $this->db->where('is_paid', 1);

        
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
//                echo "<pre>";
//                print_r($return); exit;
    }

    function weekReport(){
        $today =  time();
        $return =array();
        for($i=1;$i<=31;$i++){
            $data = "";        
            $daywise = strtotime("-".(150+$i)." day");
            $last_day = strtotime("-".(150+$i-1)." day");
       $this->db->select("count(order_id) as 'total_orders',SUM(dpd_order.order_total) as 'total_amount'", FALSE);
        $this->db->from('order');
        $this->db->where("order_time BETWEEN '" .  $daywise  . "' AND'" .   $last_day   . "'");
        $query = $this->db->get();
         $data = $query->result_array();
         $return[$i]  = $data[0];
       $return[$i]['result_date'] = date("F d", $daywise) ;
}
      return array_reverse($return);
    }
    
    function profitLoss(){

        
         $this->db->select("count(dpd_order.order_id) as total_orders,SUM(dpd_order_item.order_item_qty * dpd_order_item.order_item_price) as 'totala',SUM(dpd_order_item.order_item_qty * dpd_product.cost_price) as 'cost_total'", FALSE);
        $this->db->from('order_item');
        $this->db->join('product', 'product.product_id = order_item.product_id');
        $this->db->join('order', 'order.order_id = order_item.order_id');
        $this->db->where('is_paid', 1);
       $query = $this->db->get();
        return $query->result_array();
        
    }
    //get detail of order
    function getDetail($oid) {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->join('order_detail', 'order_detail.order_id = order.order_id');
        $this->db->where('order.order_id', $oid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return FALSE;
    }

    //Function Delete Record
    function deleteRecord($order) {
        $this->db->where('order_id', $order['order_id']);
        $this->db->delete('order_detail');

        $this->db->where('order_id', $order['order_id']);
        $this->db->delete('order');
    }

    function getCompanyByID($cid = 0) {
        if ($cid == 0)
            return False;
        $this->db->from('company');
        $this->db->join('branch', 'branch.branch_id = company.branch_id');
        $this->db->where('company_id', intval($cid));
        $rs = $this->db->get();
        if ($rs && $rs->num_rows() == 1) {
            return $rs->row_array();
        }
    }

    //function get location
    function getLocationByID($lid = 0) {
        if ($lid == 0)
            return False;
        $this->db->from('location');
        $this->db->where('location_id', intval($lid));
        $rs = $this->db->get();
        if ($rs && $rs->num_rows() == 1) {
            return $rs->row_array();
        }
    }

    // function filter
    function FilterTotalorder($total_amount = 0, $total_order = 0) {

        $order = array();
        $this->db->from('order');
        $this->db->join('company', 'company.company_id = order.company_id');
        $this->db->select_sum('cart_total', 'Amount');
        $this->db->where('is_paid', 1);
        //branch 
        $branch_id = $this->session->userdata('BRANCH_ID');
        if (isset($branch_id) && $branch_id) {
            $this->db->join('branch', 'branch.branch_id = company.branch_id');
            $this->db->where('branch.branch_id', intval($branch_id));
        }
        //company 
        $company_id = $this->session->userdata('COMPANY_ID');
        if (isset($company_id) && $company_id) {
            $this->db->where('company.company_id', intval($company_id));
        }
        $query = $this->db->get();

        if ($query && $query->num_rows() == 1) {
            $total_amount = $query->row_array();

            $this->db->join('company', 'company.company_id = order.company_id');
            $this->db->where('is_paid', 1);
            //branch login
            $branch_id = $this->session->userdata('BRANCH_ID');
            if (isset($branch_id) && $branch_id) {
                $this->db->join('branch', 'branch.branch_id = company.branch_id');
                $this->db->where('branch.branch_id', intval($branch_id));
            }
            //company  login
            $company_id = $this->session->userdata('COMPANY_ID');
            if (isset($company_id) && $company_id) {
                $this->db->where('company.company_id', intval($company_id));
            }
            $total_order = $this->db->count_all_results('order');
            //print_R($total_order); exit();
        }
        $order['Amount'] = $total_amount['Amount'];
        $order['Total_order'] = $total_order;
        $order['order'] = $order;

        return $order['order'];
    }

}

?>