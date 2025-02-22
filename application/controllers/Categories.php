<?php 

class Categories extends MY_Controller
{

    public function index(){
        $data['active'] = 'categories';
        $data['title'] = 'Categorias';
        $data['categories'] = $this->Categories_model->get_categories();
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('categories/index', $data);
        $this->load->view('_templates/footer');
    }



    public function create(){
        $data['active'] = 'categories';
        $data['title'] = 'Nueva Categoria';
        $data['categories'] = $this->Categories_model->get_categories();
        

        $this->form_validation->set_rules('category_name', 'Nombre de la Categoria', 'required');

        if ($this->form_validation->run() === FALSE){
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('categories/create', $data);
            $this->load->view('_templates/footer');
        } else {

            $category_slug = url_title($this->input->post('category_name'));

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_slug' => $category_slug
            );


            $this->Categories_model->create_category($data);
            $this->session->set_flashdata('success', 'Categoria creada exitosamente');
            redirect(base_url().'categories');
        }
    }



    public function update($id){
        // Check if category exists
        if(!$this->Categories_model->get_category($id)){
            $this->session->set_flashdata('error', 'La categoría no existe');
            redirect(base_url().'categories');
        }
        
        $data['active'] = 'categories';
        $data['title'] = 'Actualizar Categoria';
        $data['category'] = $this->Categories_model->get_category($id);
        $data['categories'] = $this->Categories_model->get_categories();
        
        $this->form_validation->set_rules('category_name', 'Nombre de la Categoria', 'required');
        
        if($this->form_validation->run() === FALSE){
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('categories/update', $data);
            $this->load->view('_templates/footer');
        } else {
            $category_slug = url_title($this->input->post('category_name'));
            
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_slug' => $category_slug
            );
            
            $this->Categories_model->update_category($id, $data);
            $this->session->set_flashdata('success', 'Categoria actualizada exitosamente');
            redirect(base_url().'categories');
        }
    }
    

    public function delete($id){
        // Check if category exists
        if(!$this->Categories_model->get_category($id)){
            $this->session->set_flashdata('error', 'La categoría no existe');
            redirect(base_url().'categories');
        }
        
        // Check if form is submitted
        if($this->input->post('confirm_delete')){
            // Check if category has products assigned
           
            
            $this->Categories_model->delete_category($id);
            $this->session->set_flashdata('success', 'Categoria eliminada exitosamente');
            redirect(base_url().'categories');
        } else {
            $data['active'] = 'categories';
            $data['title'] = 'Eliminar Categoria';
            $data['category'] = $this->Categories_model->get_category($id);
            
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('categories/delete', $data);
            $this->load->view('_templates/footer');
        }
    }


    



}