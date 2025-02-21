<?php 

class Messages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
    }

    public function index(){
        $data['active'] = 'messages';
        $data['title'] = 'Mensajes';
        $data['messages'] = $this->Message_model->index();
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('messages/index', $data);
        $this->load->view('_templates/footer');
    }


    public function view($id)
    {
        $data['active'] = 'messages';
        $data['title'] = 'Mensajes';
        $data['message'] = $this->Message_model->get($id);
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('messages/view', $data);
        $this->load->view('_templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a new message';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('messages/create', $data);
        } else {
            $this->Message_model->set_message();
            $this->load->view('messages/success');
        }
    }
}