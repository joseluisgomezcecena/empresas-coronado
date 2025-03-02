<?php 

class Messages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
        $this->output->set_content_type('application/json');
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
        

        
}