<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_products()
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->order_by('p.product_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_product($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->row_array();
    }

    public function create_product($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    public function save_product_categories($product_id, $categories)
    {
        foreach ($categories as $category_id) {
            $data = array(
                'product_id' => $product_id,
                'category_id' => $category_id
            );
            $this->db->insert('product_categories', $data);
        }
        return true;
    }

    public function update_product_categories($product_id, $categories)
    {
        // Delete existing category relationships
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_categories');
        
        // Insert new category relationships
        return $this->save_product_categories($product_id, $categories);
    }

    public function get_product_categories($product_id)
    {
        $this->db->select('pc.category_id');
        $this->db->from('product_categories pc');
        $this->db->where('pc.product_id', $product_id);
        $query = $this->db->get();
        
        $categories = array();
        foreach ($query->result_array() as $row) {
            $categories[] = $row['category_id'];
        }
        
        return $categories;
    }

    // YEAR FUNCTIONS
    public function save_product_years($product_id, $years)
    {
        if(empty($years)) {
            return true;
        }
        
        foreach ($years as $year) {
            if(!empty($year)) {
                $data = array(
                    'product_id' => $product_id,
                    'year' => $year
                );
                $this->db->insert('product_years', $data);
            }
        }
        return true;
    }

    public function update_product_years($product_id, $years)
    {
        // Delete existing year relationships
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_years');
        
        // Insert new year relationships
        return $this->save_product_years($product_id, $years);
    }

    public function get_product_years($product_id)
    {
        $this->db->select('py.year');
        $this->db->from('product_years py');
        $this->db->where('py.product_id', $product_id);
        $this->db->order_by('py.year', 'ASC');
        $query = $this->db->get();
        
        $years = array();
        foreach ($query->result_array() as $row) {
            $years[] = $row['year'];
        }
        
        return $years;
    }

    public function get_products_by_category($category_id)
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->join('product_categories pc', 'p.id = pc.product_id');
        $this->db->where('pc.category_id', $category_id);
        $this->db->order_by('p.product_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_products_by_year($year)
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->join('product_years py', 'p.id = py.product_id');
        $this->db->where('py.year', $year);
        $this->db->order_by('p.product_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_products($keyword)
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->group_start();
        $this->db->like('p.product_name', $keyword);
        $this->db->or_like('p.part_number', $keyword);
        $this->db->or_like('p.car_brand', $keyword);
        $this->db->or_like('p.car_model', $keyword);
        $this->db->group_end();
        $this->db->order_by('p.product_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}