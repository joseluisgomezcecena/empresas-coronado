<?php 

class Products extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->model('Categories_model');
    }

    public function index()
    {
        $data['active'] = 'products';
        $data['title'] = 'Productos';
        $data['products'] = $this->Products_model->get_products();
        
        // Get years for each product
        foreach ($data['products'] as &$product) {
            $product['years'] = $this->Products_model->get_product_years($product['id']);
        }
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('products/index', $data);
        $this->load->view('_templates/footer');
    }

    public function create()
    {
        $data['active'] = 'products';
        $data['title'] = 'Nuevo Producto';
        $data['categories'] = $this->Categories_model->get_categories();
        
        $this->form_validation->set_rules('part_number', 'Número de Parte', 'required|is_unique[products.part_number]');
        $this->form_validation->set_rules('car_brand', 'Marca de Auto', 'required');
        $this->form_validation->set_rules('car_model', 'Modelo de Auto', 'required');
        $this->form_validation->set_rules('product_name', 'Nombre del Producto', 'required');
        $this->form_validation->set_rules('purchase_price', 'Precio de Compra', 'required|numeric');
        $this->form_validation->set_rules('sale_price', 'Precio de Venta', 'required|numeric');
        $this->form_validation->set_rules('suggested_price', 'Precio Sugerido', 'required|numeric');
        $this->form_validation->set_rules('category_id[]', 'Categorías', 'required');
        // Years validation is not required, as a product might fit all years of a model

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('products/create', $data);
            $this->load->view('_templates/footer');
        } else {
            // Handle image upload
            $product_image = '';
            if (!empty($_FILES['product_image']['name'])) {
                $config['upload_path'] = './uploads/products/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = time() . '_' . $_FILES['product_image']['name'];
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('product_image')) {
                    $upload_data = $this->upload->data();
                    $product_image = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url().'products/create');
                }
            }
            
            $product_slug = url_title($this->input->post('product_name'));

            $product_data = array(
                'part_number' => $this->input->post('part_number'),
                'car_brand' => $this->input->post('car_brand'),
                'car_model' => $this->input->post('car_model'),
                'product_name' => $this->input->post('product_name'),
                'product_slug' => $product_slug,
                'purchase_price' => $this->input->post('purchase_price'),
                'sale_price' => $this->input->post('sale_price'),
                'suggested_price' => $this->input->post('suggested_price'),
                'product_image' => $product_image
            );

            $product_id = $this->Products_model->create_product($product_data);
            
            // Save product categories
            $categories = $this->input->post('category_id');
            $this->Products_model->save_product_categories($product_id, $categories);
            
            // Save product years
            $years = $this->input->post('years');
            if (!empty($years)) {
                $this->Products_model->save_product_years($product_id, $years);
            }
            
            $this->session->set_flashdata('success', 'Producto creado exitosamente');
            redirect(base_url().'products');
        }
    }

    public function update($id)
    {
        // Check if product exists
        if(!$this->Products_model->get_product($id)){
            $this->session->set_flashdata('error', 'El producto no existe');
            redirect(base_url().'products');
        }
        
        $data['active'] = 'products';
        $data['title'] = 'Actualizar Producto';
        $data['product'] = $this->Products_model->get_product($id);
        $data['categories'] = $this->Categories_model->get_categories();
        $data['product_categories'] = $this->Products_model->get_product_categories($id);
        $data['product_years'] = $this->Products_model->get_product_years($id);
        
        $this->form_validation->set_rules('part_number', 'Número de Parte', 'required');
        $this->form_validation->set_rules('car_brand', 'Marca de Auto', 'required');
        $this->form_validation->set_rules('car_model', 'Modelo de Auto', 'required');
        $this->form_validation->set_rules('product_name', 'Nombre del Producto', 'required');
        $this->form_validation->set_rules('purchase_price', 'Precio de Compra', 'required|numeric');
        $this->form_validation->set_rules('sale_price', 'Precio de Venta', 'required|numeric');
        $this->form_validation->set_rules('suggested_price', 'Precio Sugerido', 'required|numeric');
        $this->form_validation->set_rules('category_id[]', 'Categorías', 'required');
        
        if($this->form_validation->run() === FALSE){
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('products/update', $data);
            $this->load->view('_templates/footer');
        } else {
            // Handle image upload
            $product_image = $data['product']['product_image'];
            if (!empty($_FILES['product_image']['name'])) {
                $config['upload_path'] = './assets/uploads/products/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = time() . '_' . $_FILES['product_image']['name'];
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('product_image')) {
                    // Delete old image if exists
                    if (!empty($product_image) && file_exists('./assets/uploads/products/'.$product_image)) {
                        unlink('./assets/uploads/products/'.$product_image);
                    }
                    
                    $upload_data = $this->upload->data();
                    $product_image = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url().'products/update/'.$id);
                }
            }
            
            $product_slug = url_title($this->input->post('product_name'));
            
            $product_data = array(
                'part_number' => $this->input->post('part_number'),
                'car_brand' => $this->input->post('car_brand'),
                'car_model' => $this->input->post('car_model'),
                'product_name' => $this->input->post('product_name'),
                'product_slug' => $product_slug,
                'purchase_price' => $this->input->post('purchase_price'),
                'sale_price' => $this->input->post('sale_price'),
                'suggested_price' => $this->input->post('suggested_price'),
                'product_image' => $product_image
            );
            
            $this->Products_model->update_product($id, $product_data);
            
            // Update product categories
            $categories = $this->input->post('category_id');
            $this->Products_model->update_product_categories($id, $categories);
            
            // Update product years
            $years = $this->input->post('years');
            $this->Products_model->update_product_years($id, $years);
            
            $this->session->set_flashdata('success', 'Producto actualizado exitosamente');
            redirect(base_url().'products');
        }
    }

    public function delete($id)
    {
        // Check if product exists
        if(!$this->Products_model->get_product($id)){
            $this->session->set_flashdata('error', 'El producto no existe');
            redirect(base_url().'products');
        }
        
        // Check if form is submitted
        if($this->input->post('confirm_delete')){
            $product = $this->Products_model->get_product($id);
            
            // Delete product image if exists
            if (!empty($product['product_image']) && file_exists('./assets/uploads/products/'.$product['product_image'])) {
                unlink('./assets/uploads/products/'.$product['product_image']);
            }
            
            $this->Products_model->delete_product($id);
            $this->session->set_flashdata('success', 'Producto eliminado exitosamente');
            redirect(base_url().'products');
        } else {
            $data['active'] = 'products';
            $data['title'] = 'Eliminar Producto';
            $data['product'] = $this->Products_model->get_product($id);
            $data['product_years'] = $this->Products_model->get_product_years($id);
            
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('products/delete', $data);
            $this->load->view('_templates/footer');
        }
    }

    public function view($id)
    {
        // Check if product exists
        if(!$this->Products_model->get_product($id)){
            $this->session->set_flashdata('error', 'El producto no existe');
            redirect(base_url().'products');
        }
        
        $data['active'] = 'products';
        $data['title'] = 'Detalles de Producto';
        $data['product'] = $this->Products_model->get_product($id);
        $data['product_categories'] = $this->Products_model->get_product_categories($id);
        $data['product_years'] = $this->Products_model->get_product_years($id);
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('products/view', $data);
        $this->load->view('_templates/footer');
    }
}