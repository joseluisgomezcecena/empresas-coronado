<?php

class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('my_url'); // Our custom helper - rename the file to my_url_helper.php

        //$this->load->helper('url');

        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        $this->load->model('Products_model');

    }


    public function view($page = 'home')
    {
        
        $data['madeby'] = "joseluisgomezcecena.";
        $data['title'] = ucfirst($page);
        $data['brands'] = $this->Brand_model->get_all_brands();


        if($page=="julian-moreno" || $page=="gustavo-coronado")
        {
            $this->load->view('_frontend/header', $data);
            
            $this->load->view('pages/'.$page, $data);
            
        }
        else
        {
            $this->load->view('_frontend/header', $data);
            $this->load->view('_frontend/navbar', $data);
            $this->load->view('pages/' . $page, $data);
            $this->load->view('_frontend/footer', $data);
        }

        
    }


    public function search()
    {
        // Get search parameters
        $brand_id = $this->input->get('brand');
        $model_id = $this->input->get('model');
        $year = $this->input->get('year');
        $term = $this->input->get('search');

        $category_id = $this->input->get('category');

        // Load required models
        $this->load->model('Products_model');
        $this->load->model('Brand_model');
        $this->load->model('Model_model');


          // Pagination config
    $this->load->library('pagination');
    
    // Count total results for pagination
    $total_rows = $this->Products_model->count_search_results($brand_id, $model_id, $year, $term, $category_id);

    //if total rows is equal to 0.
    if ($total_rows == NULL) {
        $total_rows = 0;
    }

    
    // Pagination settings
    $config['base_url'] = site_url('pages/search');
    $config['total_rows'] = $total_rows;
    $config['per_page'] = 9; // 9 products per page (3x3 grid)
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 'page';
    $config['reuse_query_string'] = TRUE;
    
    // Bootstrap 4 pagination styling
    $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = '&laquo;';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = '&raquo;';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '&rsaquo;';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '&lsaquo;';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['attributes'] = array('class' => 'page-link');
    
    $this->pagination->initialize($config);
    
    // Get current page
    $page = ($this->input->get('page')) ? $this->input->get('page') : 0;




        // Get search results
        $data['products'] = $this->Products_model->search_catalog(
            $brand_id, 
            $model_id, 
            $year, 
            $term,
            $category_id,
            $config['per_page'], //pag.
            $page //pag.
        );

        // Load additional data for the view

        $data['pagination'] = $this->pagination->create_links();
        $data['total_results'] = $total_rows;

        $data['brands'] = $this->Brand_model->get_all_brands();
        $data['search_term'] = $term;
        $data['selected_brand'] = $brand_id;
        $data['selected_model'] = $model_id;
        $data['selected_year'] = $year;

        // Get all categories with product counts
        $data['categories'] = $this->Categories_model->get_categories_with_count();
        $data['selected_category'] = $category_id; // Store selected category

        
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



    public function product_detail($id)
    {
        // Load required models
        $this->load->model('Products_model');
        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        
        // Get product details
        $data['product'] = $this->Products_model->get_product_with_inventory($id);
        
        // If product doesn't exist, redirect to home
        if(empty($data['product'])) {
            redirect(base_url());
        }
        
        // Get product years
        $data['product_years'] = $this->Products_model->get_product_years($id);
        
        // Get similar products
        $data['similar_products'] = $this->Products_model->get_similar_products(
            $data['product']['car_brand'],
            $data['product']['car_model'],
            $id,
            4
        );
        
        // Load views
        $data['title'] = $data['product']['product_name'];
        $data['madeby'] = "joseluisgomezcecena";
        
        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/product_detail', $data);
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


    public function catalog()
    {
        // Load required models
        $this->load->model('Products_model');
        $this->load->model('Brand_model');
        $this->load->model('Model_model');

        // Pagination config
        $this->load->library('pagination');
        $category_id = $this->input->get('category');

        // Count total products with stock
        $total_rows = $this->Products_model->count_products_with_stock($category_id);
        
        // Pagination settings
        $config['base_url'] = site_url('catalogo');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 9; // 9 products per page (3x3 grid)
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        
        // Bootstrap 4 pagination styling
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lsaquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        
        // Get current page
        $page = ($this->input->get('page')) ? $this->input->get('page') : 0;
        
        // Get paginated products
        $data['products'] = $this->Products_model->get_all_products_with_stock($config['per_page'], $page, $category_id);

        // Load additional data for the view
        $data['pagination'] = $this->pagination->create_links();
        $data['total_results'] = $total_rows;
        $data['brands'] = $this->Brand_model->get_all_brands();

         // Get all categories with product counts
        $data['categories'] = $this->Categories_model->get_categories_with_count();
        $data['selected_category'] = $category_id; // Store selected category
            
        // For search form
        $data['search_term'] = '';
        $data['selected_brand'] = '';
        $data['selected_model'] = '';
        $data['selected_year'] = '';
        $data['models'] = array();

        // Load views
        $data['title'] = 'Catálogo de Productos';
        $data['madeby'] = "joseluisgomezcecena";
        
        $this->load->view('_frontend/header', $data);
        $this->load->view('_frontend/navbar', $data);
        $this->load->view('pages/catalog', $data); // We'll reuse the search_results view
        $this->load->view('_frontend/footer', $data);
    }
   
          
}