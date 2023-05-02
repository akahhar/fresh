<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Deals_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    function get_deal_cost($deals_id)
    {
        $this->db->select_sum('total_cost');
        $this->db->where('deals_id', $deals_id);
        $this->db->from('tbl_deals_items');
        $query_result = $this->db->get();
        $cost = $query_result->row();
        if (!empty($cost->total_cost)) {
            $result = $cost->total_cost;
        } else {
            $result = '0';
        }
        return $result;
    }

    public function getItemsInfo($term = null, $warehouse_id = null, $limit = 10)
    {
        $for_purcahse = $this->input->get('for', true);
        $this->db->select('tbl_saved_items.*, tbl_warehouses_products.quantity as total_qty');
        $this->db->join('tbl_warehouses_products', 'tbl_warehouses_products.product_id = tbl_saved_items.saved_items_id');

        if (!empty($term)) {
            $this->db->where("(item_name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR  concat(item_name, ' (', code, ')') LIKE '%" . $term . "%')");
        }
        if (!empty($warehouse_id)) {
            $this->db->where('tbl_warehouses_products.warehouse_id', $warehouse_id);
            if ($for_purcahse != 'purchase_item') {
                $this->db->where('tbl_warehouses_products.quantity >', 0);
            }
        }
        $this->db->limit($limit);
        $this->db->order_by('saved_items_id', 'DESC');
        $q = $this->db->get('tbl_saved_items');
        if ($q->num_rows() > 0) {
            return $q->result();
        }
        return FALSE;
    }
}
