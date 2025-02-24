<?php

class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        $this->load->model('Products_model');
    }


    public function view($page = 'home')
    {
        
        $data['madeby'] = "joseluisgomezcecena.";
        $data['title'] = ucfirst($page);
        $data['brands'] = $this->Brand_model->get_all_brands();


        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('_frontend/footer', $data);
    }


    public function search()
    {
        // Get search parameters
        $brand_id = $this->input->get('brand');
        $model_id = $this->input->get('model');
        $year = $this->input->get('year');
        $term = $this->input->get('search');

        // Load required models
        $this->load->model('Products_model');
        $this->load->model('Brand_model');
        $this->load->model('Model_model');

        // Get search results
        $data['products'] = $this->Products_model->search_catalog(
            $brand_id, 
            $model_id, 
            $year, 
            $term
        );

        // Load additional data for the view
        $data['brands'] = $this->Brand_model->get_all_brands();
        $data['search_term'] = $term;
        $data['selected_brand'] = $brand_id;
        $data['selected_model'] = $model_id;
        $data['selected_year'] = $year;
        
        // Get models if brand is selected
        if($brand_id) {
            $data['models'] = $this->Model_model->get_models_by_brand($brand_id);
        } else {
            $data['models'] = array();
        }

        // Load views
        $data['title'] = 'Resultados de búsqueda';
        $data['madeby'] = "joseluisgomezcecena";
        
        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/search_results', $data);
        $this->load->view('_frontend/footer', $data);
    }

    //ajax search.
    public function get_models()
    {
        $brand_id = $this->input->post('brand_id');
        $models = $this->Model_model->get_models_by_brand($brand_id);
        echo json_encode($models);
    }

    public function search_products()
    {
        $term = $this->input->post('term');
        if(strlen($term) >= 3) {
            $products = $this->Products_model->search_products($term);
            echo json_encode($products);
        }
    }
   
          
}