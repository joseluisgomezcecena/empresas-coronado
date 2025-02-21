<?php 

class Property_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }



    public function get_property($property_id =NULL, $status = NULL)
    {
        if ($property_id != NULL) {
            $this->db->where('property_id', $property_id);
        }

        $this->db->select('property.*, category.category_name, category.category_id, estados.nombre as estado, municipios.nombre as ciudad');
        $this->db->from('property');
        $this->db->join('category', 'category.category_id = property.category');
        //$this->db->join('property_custom_field', 'c_property_id = property.property_id', 'left');
       // $this->db->join('custom_fields', 'custom_fields.custom_id = property_custom_field.c_custom_field', 'left');
        $this->db->join('estados', 'estados.id = property.state', 'left');
        $this->db->join('municipios', 'municipios.id = property.city', 'left');

        if ($status != NULL) {
            $this->db->where('status', $status);
        }
       
        $query = $this->db->get();
        if ($property_id != NULL) {
            return $query->row_array();
        }else{
            return $query->result_array();
        }
    }


    public function get_property_by_slug($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->select('property.*, category.category_name, category.category_id, estados.nombre as estado, municipios.nombre as ciudad');
        $this->db->from('property');
        $this->db->join('category', 'category.category_id = property.category');
        $this->db->join('estados', 'estados.id = property.state', 'left');
        $this->db->join('municipios', 'municipios.id = property.city', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }


    public function get_property_by_slug_category($slug)
    {
        $this->db->where('category_slug', $slug);
        $this->db->select('property.*, category.category_name, category.category_id, estados.nombre as estado, municipios.nombre as ciudad');
        $this->db->from('property');
        $this->db->join('category', 'category.category_id = property.category');
        $this->db->join('estados', 'estados.id = property.state', 'left');
        $this->db->join('municipios', 'municipios.id = property.city', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function get_main_image($property_id)
    {
        $this->db->where('property_id', $property_id);
        $this->db->where('image_order', 0); // Get the first image (main image)
        $this->db->limit(1);
        $query = $this->db->get('images');
        return $query->row_array();
    }



    public function get_slides()
    {
        $this->db->select('*');
        $this->db->from('property');
        $this->db->join('images', 'images.property_id = property.property_id');
        $this->db->where('images.image_order', 0);
        $this->db->where('property.portada', 1);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function count_property($status = NULL)
    {
        if ($status != NULL) {
            $this->db->where('status', $status);
        }
        return $this->db->count_all_results('property');
    }



    public function create_property($data){
        $this->db->insert('property', $data);
        return $this->db->insert_id();
    }


    public function create_image($data){

        $property_id = $data['property_id'];
        $this->db->where('property_id', $property_id);
        $query = $this->db->get('images');
        $image_order = $query->num_rows() + 1;
        $data['image_order'] = $image_order;
        

        $this->db->insert('images', $data);
        return $this->db->insert_id();
    }



    public function update_order($order) 
    {
        foreach ($order as $i => $po_id) {
            $data = array('image_order' => $i);
            $this->db->where('image_id', $po_id);
            $this->db->update('images', $data);
        }
    }


    public function update_property($property_id,$data){
        $this->db->where('property_id', $property_id);
        return $this->db->update('property', $data);
    }

    public function sell_property($property_id, $data){
        $this->db->where('property_id', $property_id);
        return $this->db->update('property', $data);
    }


    public function get_images($property_id){
        $this->db->order_by('image_order', 'ASC');
        $this->db->where('property_id', $property_id);
        $query = $this->db->get('images');
        return $query->result_array();
    }
    

    public function get_image($image_id){
        $this->db->where('image_id', $image_id);
        $query = $this->db->get('images');
        return $query->row_array();
    }


    public function delete_image($image_id){
        $this->db->where('image_id', $image_id);
        $query = $this->db->get('images');
        $image = $query->row_array();
        $property_id = $image['property_id'];

        $this->db->where('image_id', $image_id);
        return $this->db->delete('images');
    }



    public function update_cover($property_id){
        
        //select property.portada from property where property_id = $property_id
        $this->db->select('portada');
        $this->db->where('property_id', $property_id);
        $query = $this->db->get('property');
        $portada = $query->row_array();
        $portada = $portada['portada'];

        if ($portada == 0) {
            $data = array('portada' => 1);
        }else{
            $data = array('portada' => 0);
        }

        //update property set portada = $data where property_id = $property_id
        $this->db->where('property_id', $property_id);
        return $this->db->update('property', $data);


    
    }



    public function get_municipios($state_id){
        $this->db->where('estado', $state_id);
        $query = $this->db->get('municipios');
        return $query->result_array();
    }


    public function get_all_municipios(){
        $query = $this->db->get('municipios');
        return $query->result_array();
    }



    public function get_states(){
        $query = $this->db->get('estados');
        return $query->result_array();
    }


    public function get_custom_fields($property_id){
        $this->db->where('c_property_id', $property_id);
        $this->db->select('custom_fields.custom_name, property_custom_field.c_custom_field, property_custom_field.c_property_id, property_custom_field.c_custom_field');
        $this->db->from('property_custom_field');
        $this->db->join('custom_fields', 'custom_fields.custom_id = property_custom_field.c_custom_field');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_custom_fields_for_page($property_id){
        //get all custom fields for this property and return them as an array
        $this->db->where('c_property_id', $property_id);
        $this->db->select('custom_fields.custom_name, property_custom_field.c_custom_field, property_custom_field.c_property_id, property_custom_field.c_custom_field');
        $this->db->from('property_custom_field');
        $this->db->join('custom_fields', 'custom_fields.custom_id = property_custom_field.c_custom_field');
        $query = $this->db->get();

        //$last_query = $this->db->last_query();
        //print_r($last_query);

        return $query->result_array();
    }



    /*
    public function search($data) {
        // Perform the city lookup separately
        if (!empty($data['city'])) {
            $this->db->select('id');
            $this->db->from('municipios');
            $this->db->where('nombre', $data['city']);
            $query = $this->db->get();
            $city = $query->row_array();
            
            if ($city) {
                $data['city'] = $city['id'];
            } else {
                $data['city'] = null;
            }
        }
    
        // Main query
        $this->db->select('property.*, category.category_name, category.category_id, estados.nombre as estado, municipios.nombre as ciudad');
        $this->db->from('property');
        $this->db->join('category', 'category.category_id = property.category');
        $this->db->join('estados', 'estados.id = property.state', 'left');
        $this->db->join('municipios', 'municipios.id = property.city', 'left');
    
        if (!empty($data['keyword'])) {
            $this->db->like('title', $data['keyword']);
            $this->db->or_like('description', $data['keyword']);
            $this->db->or_like('street', $data['keyword']);
            $this->db->or_like('nhood', $data['keyword']);
        }
    
        if (!empty($data['category'])) {
            $this->db->where('category', $data['category']);
        }
    
        if (!empty($data['city'])) {
            $this->db->where('city', $data['city']);
        }
    
        if (!empty($data['bedrooms'])) {
            $this->db->where('bedrooms', $data['bedrooms']);
        }
    
        if (!empty($data['garage'])) {
            $this->db->where('garage', $data['garage']);
        }
    
        if (!empty($data['bathrooms'])) {
            $this->db->where('bathrooms', $data['bathrooms']);
        }
    
        if (!empty($data['purpose'])) {
            $this->db->where('purpose', $data['purpose']);
        }
    
        if (!empty($data['max_price'])) {
            $this->db->where('price <=', $data['max_price']);
        }
    
        if (!empty($data['surface'])) {
            $this->db->where('surface >=', $data['surface']);
        }

        
        $this->db->where('status', 1);
        
    
        #$query = $this->db->get();
        #return $query->result_array();
        $last_query = $this->db->last_query();
        print_r($last_query);
    }
        */

        public function search($data) {
            // Perform the city lookup separately
            if (!empty($data['city'])) {
                $this->db->select('id');
                $this->db->from('municipios');
                $this->db->where('nombre', $data['city']);
                $query = $this->db->get();
                $city = $query->row_array();
                
                if ($city) {
                    $data['city'] = $city['id'];
                } else {
                    $data['city'] = null;
                }
            }
        
            // Main query
            $this->db->select('property.*, category.category_name, category.category_id, estados.nombre as estado, municipios.nombre as ciudad');
            $this->db->from('property');
            $this->db->join('category', 'category.category_id = property.category');
            $this->db->join('estados', 'estados.id = property.state', 'left');
            $this->db->join('municipios', 'municipios.id = property.city', 'left');
        
            if (!empty($data['keyword'])) {
                $this->db->group_start(); // Open parenthesis
                $this->db->like('title', $data['keyword']);
                $this->db->or_like('description', $data['keyword']);
                $this->db->or_like('street', $data['keyword']);
                $this->db->or_like('nhood', $data['keyword']);
                $this->db->group_end(); // Close parenthesis
            }
        
            if (!empty($data['category'])) {
                $this->db->where('category', $data['category']);
            }
        
            if (!empty($data['city'])) {
                $this->db->where('city', $data['city']);
            }
        
            if (!empty($data['bedrooms'])) {
                $this->db->where('bedrooms', $data['bedrooms']);
            }
        
            if (!empty($data['garage'])) {
                $this->db->where('garage', $data['garage']);
            }
        
            if (!empty($data['bathrooms'])) {
                $this->db->where('bathrooms', $data['bathrooms']);
            }
        
            if (!empty($data['purpose'])) {
                $this->db->where('purpose', $data['purpose']);
            }
        
            if (!empty($data['max_price'])) {
                $this->db->where('price <=', $data['max_price']);
            }
        
            if (!empty($data['surface'])) {
                $this->db->where('surface >=', $data['surface']);
            }
        
            $this->db->where('status', 1);
        
            $query = $this->db->get();
            return $query->result_array();
        }

}