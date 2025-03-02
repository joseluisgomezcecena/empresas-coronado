<?php

class Message_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function save_message($data) {
        return $this->db->insert('messages', $data);
    }

    public function index()
    {
        $this->db->select('*');
        $this->db->from('messages');
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function get($id)
    {
        $this->db->select('*');
        $this->db->from('messages');
        $this->db->where('message_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function count_message()
    {
        $this->db->select('*');
        $this->db->from('messages');
        $this->db->where('MONTH(created_at)', date('m'));
        $query = $this->db->get();
        return $query->num_rows();
    }

}