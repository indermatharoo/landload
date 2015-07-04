<?php

class Cartmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insertRecord($product, $product_images, $product_option, $option_values, $cart_id = false) {
        $CI = & get_instance();
        $CI->load->model('catalog/Productmodel');
        if ($cart_id) {
            //Delete previous cart entry
            $entry = array();
            $entry['rowid'] = $cart_id;
            $entry['qty'] = 0;
            $rs = $this->cart->update($entry);
        }

        $data = array();
        $options = array();
        $option_price = 0;
        $qty = $this->input->post('quantity', true);
        $product_discount = 0;
        $product_discount = $this->productDiscount($product, $qty);
        foreach ($product_option as $row) {
            $option_name = 'option_' . $row['option_id'];

            $option_post = $this->input->post($option_name, true);
            if ($option_post) {
                foreach ($option_values as $item) {
                    foreach ($item as $data) {
                        if ($data['option_row_id'] == $option_post) {
                            $options[$row['option_name']] = $data['row_value'];
                            $option_price = $option_price + $data['price'];
                        }
                    }
                }
            }
        }

        $product_price = $option_price + $product['product_price'];

        $product_discount = round(($product_price * $product_discount) / 100, 2);
        $product_price = $product_price - $product_discount;

        $options['weight'] = $product['weight'];
        $data['discount'] = $product_discount;
        //$options['image'] = $product['product_image'];
        $data['id'] = $product['product_id'];
        $data['qty'] = 1;
        $data['price'] = $product_price;
        $data['name'] = $product['product_name'];


        $this->cart->insert($data);
    }

    function productDiscount($product, $qty = 1) {
        $CI = & get_instance();
        $CI->load->model('catalog/Productmodel');

        //Product specific discount
        $customer_id = $this->session->userdata('CUSTOMER_ID');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('product_name', $product['product_name']);
        $this->db->where('active', 1);
        $product_rs = $this->db->get('customer_product_discount');


        if ($product_rs && $product_rs->num_rows() == 1) {
            $product_discount = $product_rs->row_array();
            return $product_discount['discount'];
        }

        $product_categories = $CI->Productmodel->getCategories($product['product_id']);
        //print_R($product_categories); 
        //Quantity specific discount
        foreach ($product_categories as $category) {

            $this->db->from('customer_quantity_discount');
            $this->db->join('customer_category_discount', 'customer_category_discount.category_discount_id = customer_quantity_discount.category_discount_id');
            $this->db->where('customer_category_discount.category_id', $category['category_id']);
            $this->db->where('customer_category_discount.customer_id', $customer_id);
            $this->db->where('customer_quantity_discount.min_quantity <=', $qty);
            $this->db->where('customer_quantity_discount.max_quantity >=', $qty);
            $result = $this->db->get();

            if ($result && $result->num_rows() >= 1) {
                $quantity_discount = $result->row_array();
                return $quantity_discount['quantity_discount'];
            }
        }

        //Category specific discount
        foreach ($product_categories as $category) {

            $this->db->from('customer_category_discount');
            $this->db->where('category_id', $category['category_id']);
            $this->db->where('active', 1);
            $this->db->where('customer_id', $customer_id);
            $result = $this->db->get();

            if ($result && $result->num_rows() >= 1) {
                $category_discount = $result->row_array();
                return $category_discount['discount'];
            }
        }


        //Customer specific discount
        $customer = array();
        $customer = $this->memberauth->checkAuth();

        return $customer['discount'];
    }

    function productDicountByID($product_id, $customer_id) {
        
    }

    //update Cart
    function updateRecord() {

        $CI = & get_instance();
        $CI->load->model('catalog/Productmodel');
        //echo "here"; exit();
        $keys = $this->input->post('key', true);
        $quantity = $this->input->post('quantity', true);
        $productId = $this->input->post('product_id', true);
        $price = $this->input->post('price', true);

        for ($i = 0; $i < count($keys); $i++) {

            // fertch a product detail
            $product = $CI->Productmodel->getDetails($productId[$i]);

            // fetch discount
            $product_discount = 0;
            $product_discount = $this->productDiscount($product, $quantity[$i]);

            //print_R($product_discount); exit();
            $product_discount = round(($price[$i] * $product_discount) / 100, 2);
            $product_price = $price[$i] - $product_discount;

            $data = array(
                'rowid' => $keys[$i],
                'qty' => $quantity[$i],
                'discount' => $product_discount,
                'price' => $product_price,
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

        $total_items = $this->cart->total_items();

        //Totals
        $cart_total = $this->cart->total();
        $order_total = $cart_total;

        //customer discount
        $discount = 0;

        //print_R($this->cart->contents()); exit();

        foreach ($this->cart->contents() as $item) {

            $discount = $discount + $item['discount'];
        }
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
        $variables['discount'] = $discount;
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