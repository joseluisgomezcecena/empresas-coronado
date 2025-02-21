<?php 

class Customfields_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_customfields()
    {
        $query = $this->db->get('custom_fields');
        return $query->result_array();
    }

    public function create_customfield($data)
    {
        $this->db->insert('custom_fields', $data);
        return $this->db->insert_id();
    }

    public function get_customfield($id)
    {
        $query = $this->db->get_where('custom_fields', array('customfield_id' => $id));
        return $query->row_array();
    }

    public function update_customfield($data, $id)
    {
        $this->db->where('customfield_id', $id);
        return $this->db->update('custom_fields', $data);
    }

    public function delete_customfield($id)
    {
        $this->db->where('customfield_id', $id);
        return $this->db->delete('custom_fields');
    }   
}