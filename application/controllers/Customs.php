<?php 

class Customs extends MY_Controller
{

    public function index(){
        $data['active'] = 'customfields';
        $data['title'] = 'Campos Personalizados';
        $data['customfields'] = $this->Customfields_model->get_customfields();
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('customfields/index', $data);
        $this->load->view('_templates/footer');
    }



    public function create(){
        $data['active'] = 'customfields';
        $data['title'] = 'Nuevo Campo Personalizado';
        $data['customfields'] = $this->Customfields_model->get_customfields();
        

        $this->form_validation->set_rules('customfield_name', 'Nombre del Campo Personalizado', 'required');

        if ($this->form_validation->run() === FALSE){
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('customfields/create', $data);
            $this->load->view('_templates/footer');
        } else {

            $data = array(
                'custom_name' => $this->input->post('customfield_name'),
            );

            $customfield_id = $this->Customfields_model->create_customfield($data);

            if($customfield_id){
                $this->session->set_flashdata('success', 'Campo Personalizado creado exitosamente');
                redirect('customfields');
            } else {
                $this->session->set_flashdata('error', 'No se pudo crear el Campo Personalizado');
                redirect('customfields/create');
            }

        }

    }



}