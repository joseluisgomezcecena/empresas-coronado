<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_product_inventory($product_id)
    {
        $this->db->select('p.*, 
            COALESCE(SUM(CASE WHEN im.movement_type = "entrada" THEN im.quantity ELSE 0 END), 0) as total_entradas,
            COALESCE(SUM(CASE WHEN im.movement_type = "salida" THEN im.quantity ELSE 0 END), 0) as total_salidas');
        $this->db->from('products p');
        $this->db->join('inventory_movements im', 'p.id = im.product_id', 'left');
        $this->db->where('p.id', $product_id);
        $this->db->group_by('p.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_product_movements($product_id)
    {
        $this->db->select('im.*, u.username as created_by_user');
        $this->db->from('inventory_movements im');
        $this->db->join('users u', 'im.created_by = u.user_id', 'left');
        $this->db->where('im.product_id', $product_id);
        $this->db->order_by('im.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_inventory_reasons($movement_type = null)
    {
        if ($movement_type) {
            $this->db->where('movement_type', $movement_type);
        }
        $query = $this->db->get('inventory_reasons');
        return $query->result_array();
    }

    public function add_movement($data)
    {
        $this->db->insert('inventory_movements', $data);
        return $this->db->insert_id();
    }

    public function get_current_stock($product_id)
    {
        $inventory = $this->get_product_inventory($product_id);
        return $inventory['total_entradas'] - $inventory['total_salidas'];
    }

    public function validate_stock($product_id, $quantity)
    {
        $current_stock = $this->get_current_stock($product_id);
        return $current_stock >= $quantity;
    }
}