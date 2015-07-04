<?php

class Cartmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insertRecord($event, $price) {

        $data = array();
        $qty = $this->input->post('qty', true);

        $data['id'] = $event['event_id'];
        $data['name'] = $event['event_title'];
        $data['qty'] = $qty;
        $data['price'] = $price['price'];
        $data['amount'] = $qty * $price['price'];
        $data['image'] = $event['event_img'];
        $this->cart->insert($data);
    }

    //update Cart
    function updateRecord() {
        $CI = & get_instance();
        $CI->load->model('Bookingmodel');
        //echo "here"; exit();
        $keys = $this->input->post('key', true);
        $quantity = $this->input->post('quantity', true);
        $productId = $this->input->post('product_id', true);
        $price = $this->input->post('price', true);

        for ($i = 0; $i < count($keys); $i++) {
//            $event = $CI->Bookingmodel->getEvent($this->input->post('eid', TRUE));
            $price = $CI->Bookingmodel->getEventPrice($this->input->post('eid', TRUE));
            $data = array(
                'rowid' => $keys[$i],
                'qty' => $quantity[$i],
                'price' => $price['price'],
            );
            $this->cart->update($data);
        }
    }

    //delete record from cart
    function deleteRecord($ctid) {
        $data = array();
        $data['rowid'] = $ctid;
        $data['qty'] = 0;
        $this->cart->update($data);
    }

    function variables($customer = false) {
        $this->load->library('Cart');
        $total_items = $this->cart->total_items();
        //Totals
        $cart_total = $this->cart->total();
        $order_total = $cart_total;

        //customer discount
//        $discount = 0;
        //print_R($this->cart->contents()); exit();
//        foreach ($this->cart->contents() as $item) {
//
//            $discount = $discount + $item['discount'];
//        }
        //print_R($discount);
        // exit();
        //$discount = 0;
        //$discount = $this->productDiscount($product, $qty);
        //if (isset($customer['discount']) && $customer['discount'] > 0) {
        //$discount = round($this->cart->total() * ($customer['discount'] / 100), 2);
        //$order_total = $order_total - $discount;
        //}
        //Tax
        $tax = 0;
        //$tax = round(($order_total * (DWS_TAX / 100)), 2);
        $order_total = $order_total + $tax;

        //$shipping = $this->Cartmodel->calculateShipping($customer);
        //$order_total = $order_total + $shipping;

        $variables = array();
        $variables['total_items'] = $total_items;
        $variables['cart_total'] = $cart_total;
        $variables['order_total'] = $order_total;
//        $variables['discount'] = $discount;
        $variables['tax'] = $tax;
        //$variables['shipping'] = $shipping;
        return $variables;
    }

    function minicart() {
        $variables = $this->variables();
        extract($variables);

        $inner = array();
        $inner['total_items'] = $total_items;
        $inner['cart_total'] = $cart_total;
        $inner['order_total'] = $order_total;
        return $this->load->view('cart/cart-mini', $inner, true);
    }

}

?>