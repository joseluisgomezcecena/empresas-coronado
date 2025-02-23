<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get_models_by_brand($brand_id) {
        $this->db->where('brand_id', $brand_id);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('models');
        return $query->result_array();
    }
}