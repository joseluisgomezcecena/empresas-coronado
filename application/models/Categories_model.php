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


}