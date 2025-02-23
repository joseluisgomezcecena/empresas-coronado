<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get_all_brands() {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('brands');
        return $query->result_array();
    }
}