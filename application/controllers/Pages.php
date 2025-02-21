<?php

class Pages extends CI_Controller
{
    
    public function view($page = 'home')
    {
        $data['controller'] = $this;
        $data['title'] = ucfirst($page); // Capitalize the first letter
        //$data['categories'] = $this->Categories_model->get_categories();
        $data['cities'] = $this->Property_model->get_all_municipios();


        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if ($page == 'home') {

            $data['slides'] = $this->Property_model->get_slides();
            $data['properties'] = $this->Property_model->get_property(NULL, 1);
           
            

            $data['main_image'] = array();
            foreach ($data['properties'] as $key => $property) {
                $data['main_image'][$key] = $this->Property_model->get_main_image($property['property_id']);
            }

        }

        if ($page == 'property_list'){
            $data['properties'] = $this->Property_model->get_property();
            $data['main_image'] = array();
            foreach ($data['properties'] as $key => $property) {
                $data['main_image'][$key] = $this->Property_model->get_main_image($property['property_id']);
            }
        }

        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('_frontend/footer', $data);
    }


    public function property_details($slug) {
        $data['controller'] = $this;
        
        //get property by slug
        $data['property'] = $this->Property_model->get_property_by_slug($slug);
        $data['images'] = $this->Property_model->get_images($data['property']['property_id']);

        //get custom fields
        $data['custom_fields'] = $this->Property_model->get_custom_fields_for_page($data['property']['property_id']);

        $user_id = $data['property']['user_id'];
        $data['user'] = $this->User_model->get_user($user_id);
        

        $data['title'] = 'Detalles | ' . $data['property']['title'];
        $data['categories'] = $this->Categories_model->get_categories();
        $data['cities'] = $this->Property_model->get_all_municipios();
    
        
    
        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/property_details', $data);
        $this->load->view('_frontend/footer', $data);
    }


    public function property_list($category = null)
    {
       
        $data['controller'] = $this;

        if ($category == null) {
            $title = 'Nuestras propiedades';
        } else {
            $title = 'Propiedades en ' . $category;
        }
        $data['title'] = $title;
        
        $data['categories'] = $this->Categories_model->get_categories();
        $data['cities'] = $this->Property_model->get_all_municipios();
        $data['properties'] = $this->Property_model->get_property_by_slug_category($category);

        $data['main_image'] = array();
        foreach ($data['properties'] as $key => $property) {
            $data['main_image'][$key] = $this->Property_model->get_main_image($property['property_id']);
        }


        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/property_list', $data);
        $this->load->view('_frontend/footer', $data);
    }


    public function search()
    {

        if(isset($_POST['search']))
        {
            $data['title'] = 'Resultados de la Busqueda.';

                
            $data = array(
                'keyword' => $this->input->post('keyword'),
                'category' => $this->input->post('category'),
                'city' => $this->input->post('city'),
                'max_price' => $this->input->post('max_price'),
                'bedrooms' => $this->input->post('bedrooms'),
                'bathrooms' => $this->input->post('bathrooms'),
                'garage' => $this->input->post('garage'),
                'surface' => $this->input->post('surface'),
                'purpose' => $this->input->post('purpose'),
                'status' => 1
            );

            $data['properties'] = $this->Property_model->search($data);
            
            

            $data['controller'] = $this;
            $data['categories'] = $this->Categories_model->get_categories();
            $data['cities'] = $this->Property_model->get_all_municipios();
            //$data['properties'] = $this->Property_model->get_property();

            $data['main_image'] = array();
            foreach ($data['properties'] as $key => $property) {
                $data['main_image'][$key] = $this->Property_model->get_main_image($property['property_id']);
            }

            

            $this->load->view('_frontend/header', $data);
            $this->load->view('_frontend/navbar', $data);
            $this->load->view('pages/property_list', $data);
            $this->load->view('_frontend/footer', $data);

            
                   
        }
        else
        {
            redirect(base_url() . 'home');
        }
    }
    
 
    public function main_image($property)
    {
        $data = $this->Property_model->get_main_image($property);
        return $data['url'];
    }


    public function send() {
        $this->load->model('Message_model');
    
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');
        $property_id = $this->input->post('property_id');

        $data = array(
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'property' => $property_id
            
        );
    
        $this->Message_model->save_message($data);
    
        echo json_encode(array('status' => 'success'));
    }
          
}