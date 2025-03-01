<?php

class Categories_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_categories()
    {
        $query = $this->db->get('category');
        return $query->result_array();
    }

    public function create_category($data)
    {
        return $this->db->insert('category', $data);
    }

    public function get_category($id)
    {
        $query = $this->db->get_where('category', array('category_id' => $id));
        return $query->row_array();
    }

    public function update_category($id, $data)
    {
        $this->db->where('category_id', $id);
        return $this->db->update('category', $data);
    }

    public function delete_category($id)
    {
        $this->db->where('category_id', $id);
        return $this->db->delete('category');
    }

    public function get_categories_with_count()
    {
        $this->db->select('c.category_id, c.category_name, COUNT(DISTINCT pc.product_id) as product_count');
        $this->db->from('category c');
        $this->db->join('product_categories pc', 'c.category_id = pc.category_id', 'left');
        $this->db->join('products p', 'p.id = pc.product_id', 'left');
        $this->db->join('inventory_movements im', 'p.id = im.product_id', 'left');
        $this->db->group_by('c.category_id');
        $this->db->having('SUM(CASE WHEN im.movement_type = "entrada" THEN im.quantity ELSE -im.quantity END) > 0');
        $this->db->order_by('c.category_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

}