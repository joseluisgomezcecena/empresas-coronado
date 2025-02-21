<?php

class Properties extends CI_Controller
{
   

    public function index()
    {

        $data['controller'] = $this;

        $data['properties'] = $this->Property_model->get_property(NULL, 1);//null for all properties, 1 for published properties
        $data['title'] = 'Propiedades';
        $data['active'] = 'properties';


        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('properties/index', $data);
        $this->load->view('_templates/footer', $data);
    }


    public function create()
    {
        $data['categories'] = $this->Categories_model->get_categories();
        $data['title'] = 'Nueva Propiedad';
        $data['active'] = 'properties';
        $data['states'] = $this->Property_model->get_states();
        $data['custom_fields'] = $this->Customfields_model->get_customfields();
        $data['users'] = $this->User_model->get_agents();
        
        
        //$this->form_validation->set_rules('property_type', 'Property Type', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('purpose', 'Purpose', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');
        $this->form_validation->set_rules('surface', 'Surface', 'required');
        $this->form_validation->set_rules('build_surface', 'Build Surface', 'required');
        $this->form_validation->set_rules('um', 'UM', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('nhood', 'Neighborhood', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        //$this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('properties/create', $data);
            $this->load->view('_templates/footer', $data);
        } 
        else
        {

            $slug = url_title($this->input->post('title'));


            //$map = $this->input->post('map');
            //$map = str_replace('https://www.google.com/maps/embed?pb=', '', $map);

            $data = array(
                'slug' => $slug,
                //'property_type' => $this->input->post('property_type'),
                'category' => $this->input->post('category'),
                'purpose' => $this->input->post('purpose'),
                'price' => $this->input->post('price'),
                'currency' => $this->input->post('currency'),
                'surface' => $this->input->post('surface'),
                'build_surface' => $this->input->post('build_surface'),
                'um' => $this->input->post('um'),
                'street' => $this->input->post('street'),
                'number' => $this->input->post('number'),
                'nhood' => $this->input->post('nhood'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'description' => $this->input->post('description'),
                'title' => $this->input->post('title'),
                'bedrooms' => $this->input->post('bedrooms'),
                'bathrooms' => $this->input->post('bathrooms'),
                'garage' => $this->input->post('garage'),
                'user_id' => $this->input->post('user_id'),
                'youtube_id' => $this->input->post('video'),
                'google_map' => $this->input->post('map'),
            );

            $property_id = $this->Property_model->create_property($data);

            // Get the custom fields from the form submission
            $custom_fields = $this->input->post('custom_fields');

            // Loop through the custom fields
            foreach ($custom_fields as $custom_field_id) {
                // Prepare the data for insertion
                $custom_field_data = array(
                    'c_property_id' => $property_id,
                    'c_custom_field' => $custom_field_id
                );

                // Insert the data into your custom fields table
                $this->db->insert('property_custom_field', $custom_field_data);
            }


            $this->session->set_flashdata('success', 'Propiedad creada exitosamente');

            redirect(base_url() . 'properties/images/' . $property_id);
        }
    }






    public function update($property_id){
        $data['property'] = $this->Property_model->get_property($property_id);
        $data['categories'] = $this->Categories_model->get_categories();
        $data['title'] = 'Editar Propiedad';
        $data['active'] = 'properties';
        $data['states'] = $this->Property_model->get_states();
        $data['custom_fields'] = $this->Customfields_model->get_customfields();
        $data['property_custom_fields'] = $this->Property_model->get_custom_fields($property_id);
        $data['users'] = $this->User_model->get_agents();

        
        $data['property_custom_field_ids'] = array_column($data['property_custom_fields'], 'c_custom_field');
        
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('purpose', 'Purpose', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');
        $this->form_validation->set_rules('surface', 'Surface', 'required');
        $this->form_validation->set_rules('build_surface', 'Build Surface', 'required');
        $this->form_validation->set_rules('um', 'UM', 'required');
        $this->form_validation->set_rules('street', 'Street', 'required');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('nhood', 'Neighborhood', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('properties/update', $data);
            $this->load->view('_templates/footer', $data);
        } 
        else
        {
            $slug = url_title($this->input->post('title'));

            $map = $this->input->post('map');
            if ($map ==  '' || $map == null || empty($map)) {
                $map = $data['property']['google_map'];
            }
            
          

            $data = array(
                'slug' => $slug,
                //'property_type' => $this->
                'category' => $this->input->post('category'),
                'purpose' => $this->input->post('purpose'),
                'price' => $this->input->post('price'),
                'currency' => $this->input->post('currency'),
                'surface' => $this->input->post('surface'),
                'build_surface' => $this->input->post('build_surface'),
                'um' => $this->input->post('um'),
                'street' => $this->input->post('street'),
                'number' => $this->input->post('number'),
                'nhood' => $this->input->post('nhood'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'description' => $this->input->post('description'),
                'title' => $this->input->post('title'),
                'bedrooms' => $this->input->post('bedrooms'),
                'bathrooms' => $this->input->post('bathrooms'),
                'garage' => $this->input->post('garage'),
                'user_id' => $this->input->post('user_id'),
                'youtube_id' => $this->input->post('video'),
                'google_map' => $map,

            );

            $this->Property_model->update_property($property_id, $data);


            // Delete the current custom fields for this property. We'll add the new ones in a moment.
            $this->db->where('c_property_id', $property_id);
            $this->db->delete('property_custom_field');



            // Get the custom fields from the form submission
            $custom_fields = $this->input->post('custom_fields');

            // Loop through the custom fields
            foreach ($custom_fields as $custom_field_id) {
                // Prepare the data for insertion
                $custom_field_data = array(
                    'c_property_id' => $property_id,
                    'c_custom_field' => $custom_field_id
                );

                // Insert the data into your custom fields table
                $this->db->insert('property_custom_field', $custom_field_data);
            }

            $this->session->set_flashdata('success', 'Propiedad actualizada exitosamente');

            redirect(base_url() . 'properties/images/' . $property_id);
        }

    }



    public function sold($property_id)
    {
    
        $data['property'] = $this->Property_model->get_property($property_id);
        $data['title'] = 'Vender Propiedad';
        $data['active'] = 'properties';
        $data['users'] = $this->User_model->get_agents();

        
        $this->form_validation->set_rules('seller', 'Vendedor', 'required');
       
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('properties/sold', $data);
            $this->load->view('_templates/footer', $data);
        } 
        else
        {
            $data = array(
                'status' => 2,
                'seller' => $this->input->post('seller'),
                'sell_notes' => $this->input->post('description'),
                'sell_date' => date('Y-m-d H:i:s')
            );

            $this->Property_model->sell_property($property_id, $data);
            $this->session->set_flashdata('success', 'Propiedad registrada como vendida.');
            redirect(base_url() . 'properties');
        }
    }





    public function delete($property_id){

        //confirm delete.
        $data['property'] = $this->Property_model->get_property($property_id);
        $data['categories'] = $this->Categories_model->get_categories();
        $data['title'] = 'Eliminar Propiedad';
        $data['active'] = 'properties';
        $data['states'] = $this->Property_model->get_states();
        $data['custom_fields'] = $this->Customfields_model->get_customfields();
        $data['property_custom_fields'] = $this->Property_model->get_custom_fields($property_id);
        $data['users'] = $this->User_model->get_agents();

        
        $data['property_custom_field_ids'] = array_column($data['property_custom_fields'], 'c_custom_field');
        
        
        if (!isset($_POST['submit'])) 
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('properties/delete', $data);
            $this->load->view('_templates/footer', $data);
        } 
        else
        {
            $this->Property_model->delete_property($property_id);
            $this->session->set_flashdata('success', 'Propiedad eliminada exitosamente');
            redirect(base_url() . 'properties');
        }

    }




    public function cover($property_id)
    {
        $this->Property_model->update_cover($property_id);
        $this->session->set_flashdata('success', 'Se actualizo el estado en la portada.');
        redirect(base_url() . 'properties');
    }














    public function images($property_id)
    {
        $data['property'] = $this->Property_model->get_property($property_id);
        $data['title'] = 'Subir Imagenes';
        $data['active'] = 'properties';
        $data['images'] = $this->Property_model->get_images($property_id);

        //$this->form_validation->set_rules('userfile', 'Imagen', 'required');

        
        if (!isset($_POST['submit'])) 
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('properties/images', $data);
            $this->load->view('_templates/footer', $data);
        } 
        else
        {
            
            $upload_result = $this->upload_image($property_id);

            if (isset($upload_result['error'])) {
                // The upload failed, handle the error
                $this->session->set_flashdata('error', $upload_result['error']);
            } else {
                $image_data = array(
                     'property_id' => $property_id,
                     'url' => $upload_result['upload_data']['file_name']
                );

                $upload_db = $this->Property_model->create_image($image_data);
               
                $this->session->set_flashdata('success', 'Imagen subida exitosamente');
            }

            redirect(base_url() . 'properties/images/' . $property_id);
        }
    }



    public function delete_image($image_id, $property_id) {
        $this->load->model('Property_model');
    
        // Get the image details
        $image = $this->Property_model->get_image($image_id);
    
        if ($image) {
            // Delete the image file from the server
            $file_path = './uploads/properties/' . $image['url'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
    
            // Delete the image record from the database
            $this->Property_model->delete_image($image_id);
        }
    
        // Redirect back to the property images page
        redirect('properties/images/' . $property_id);
    }








    public function update_order() 
    {
        $order = $this->input->post('order');
        $this->Property_model->update_order($order);
    }

    


    public function upload_image($property_id)
    {
        $config['upload_path'] = './uploads/properties/'; // specify the directory where the image will be uploaded
        $config['allowed_types'] = 'gif|jpg|png'; // specify the allowed types of files
        $config['max_size'] = 2048; // specify the max size in kilobytes
        $config['max_width'] = 2024; // specify the max width in pixels
        $config['max_height'] = 1768; // specify the max height in pixels
    
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }
    



    public function get_municipios($estado_id)
    {
        $municipios = $this->Property_model->get_municipios($estado_id);
        echo json_encode($municipios);
    }


    public function main_image($property)
    {
        $data = $this->Property_model->get_main_image($property);
        return $data['url'];
    }


    public function get_custom_fields($property_id)
    {
        $custom_fields = $this->Property_model->get_custom_fields($property_id);
        return $custom_fields;
    }
    

   

}
   