<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /*
    public function get_products()
    {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->order_by('p.product_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    */

    public function get_products()
    {
        $this->db->select('p.*, 
            COALESCE(SUM(CASE WHEN im.movement_type = "entrada" THEN im.quantity ELSE -im.quantity END), 0) as current_stock');
        $this->db->from('products p');
        $this->db->join('inventory_movements im', 'p.id = im.product_id', 'left');
        $this->db->group_by('p.id');
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

    /*
    public function create_product($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }
    */


    public function create_product($data)
    {
        $this->db->trans_begin();

        // Start transaction
        try {
            // Insert product
            $this->db->insert('products', $data);
            $product_id = $this->db->insert_id();

            // If initial quantity is set, create inventory movement
            if (isset($data['qty']) && $data['qty'] > 0) {
                $movement_data = array(
                    'product_id' => $product_id,
                    'movement_type' => 'entrada',
                    'quantity' => $data['qty'],
                    'reason' => 'inventario_inicial',
                    'description' => 'Inventario inicial del producto',
                    'created_by' => $this->session->userdata('user_id')
                );
                
                $this->db->insert('inventory_movements', $movement_data);
            }

            $this->db->trans_commit();
            return $product_id;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
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


    public function get_product_with_inventory($id)
    {
        $this->db->select('p.*, 
            COALESCE(SUM(CASE WHEN im.movement_type = "entrada" THEN im.quantity ELSE 0 END), 0) as total_entradas,
            COALESCE(SUM(CASE WHEN im.movement_type = "salida" THEN im.quantity ELSE 0 END), 0) as total_salidas,
            COALESCE(SUM(CASE WHEN im.movement_type = "entrada" THEN im.quantity ELSE -im.quantity END), 0) as current_stock');
        $this->db->from('products p');
        $this->db->join('inventory_movements im', 'p.id = im.product_id', 'left');
        $this->db->where('p.id', $id);
        $this->db->group_by('p.id');
        $query = $this->db->get();
        return $query->row_array();
    }
}