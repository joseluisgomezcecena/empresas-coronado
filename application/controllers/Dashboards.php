<?php

class Dashboards extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chart_model');
        $this->load->model('Projects_model');
    }

    public function index()
    {
        $data['active'] = 'home';

        $data['title'] = 'Dashboard';

        /*
        $data['controller'] = $this;
        $data['properties'] = $this->Property_model->get_property(NULL, 1);//null for all properties, 1 for published properties
        
        $data['property_count'] = $this->Property_model->count_property();
        $data['property_sold'] = $this->Property_model->count_property(2);
        $data['property_sold_percent'] = round($data['property_sold'] / $data['property_count'] * 100, 2);
        $data['messages_count_month'] = $this->Message_model->count_message();
    */
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav', $data);
        $this->load->view('_templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('_templates/footer', $data);
        
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