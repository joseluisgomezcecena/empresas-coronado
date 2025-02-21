<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('form_model');
    }
    
    public function render($form_id) {
        $data['form'] = $this->form_model->get_form($form_id);
        $data['fields'] = $this->form_model->get_form_fields($form_id);
        
        // Load the form view
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav', $data);
        $this->load->view('_templates/sidebar', $data);
        $this->load->view('forms/render', $data);
        $this->load->view('_templates/footer', $data);

    }
}