<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_builder extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('form_model');
        $this->load->library('form_validation');
    }

    // List all forms
    public function index() 
    {

        $data['title'] = 'Forms';
        $data['active'] = 'forms';
        $data['forms'] = $this->form_model->get_all_forms();
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav', $data);
        $this->load->view('_templates/sidebar', $data);
        $this->load->view('forms/index', $data);
        $this->load->view('_templates/footer', $data);
    }

    // Create new form
    public function create() {
        $data['title'] = 'Create Form';
        $data['active'] = 'forms';
        if ($this->input->post()) {
            $form_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description')
            );
            
            $form_id = $this->form_model->create_form($form_data);
            redirect('form_builder/edit/' . $form_id);
        }
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav', $data);
        $this->load->view('_templates/sidebar', $data);
        $this->load->view('forms/create');
        $this->load->view('_templates/footer', $data);

    }

    // Edit form and manage fields
    public function edit($form_id) {

        $data['title'] = 'Create Form';
        $data['active'] = 'forms';

        if ($this->input->post()) {
            // Handle field updates via AJAX
            $field_data = $this->input->post();
            $this->form_model->update_field($field_data);
            echo json_encode(['status' => 'success']);
            return;
        }

        $data['form'] = $this->form_model->get_form($form_id);
        $data['fields'] = $this->form_model->get_form_fields($form_id);
        $data['field_types'] = $this->get_field_types();
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav', $data);
        $this->load->view('_templates/sidebar', $data);
        $this->load->view('forms/edit', $data);
        $this->load->view('_templates/footer', $data);

    }

    // Add new field to form
    /*
    public function add_field($form_id) {
        if ($this->input->post()) {
            $field_data = array(
                'form_id' => $form_id,
                'field_type' => $this->input->post('field_type'),
                'label' => $this->input->post('label'),
                'placeholder' => $this->input->post('placeholder'),
                'help_text' => $this->input->post('help_text'),
                'required' => $this->input->post('required'),
                'field_order' => $this->input->post('field_order'),
                'options' => $this->input->post('options'),
                'validation_rules' => $this->input->post('validation_rules')
            );
            
            $this->form_model->add_field($field_data);
            echo json_encode(['status' => 'success']);
        }
    }
    */

    public function add_field($form_id) {
        if ($this->input->post()) {
            // Get the next available field order
            $next_order = $this->form_model->get_next_field_order($form_id);
            
            $field_data = array(
                'form_id' => $form_id,
                'field_type' => $this->input->post('field_type'),
                'label' => $this->input->post('label'),
                'placeholder' => $this->input->post('placeholder'),
                'help_text' => $this->input->post('help_text'),
                'required' => $this->input->post('required') ? 1 : 0,
                'field_order' => $next_order,  // Set the field order
                'options' => $this->input->post('options'),
                'validation_rules' => $this->input->post('validation_rules')
            );
            
            $this->form_model->add_field($field_data);
            echo json_encode(['status' => 'success']);
        }
    }

    // Generate form preview
    public function preview($form_id) {
        $data['form'] = $this->form_model->get_form($form_id);
        $data['fields'] = $this->form_model->get_form_fields($form_id);
        $this->load->view('forms/preview', $data);
    }

    // Handle form submission
    public function submit($form_id) {
        $form = $this->form_model->get_form($form_id);
        $fields = $this->form_model->get_form_fields($form_id);
        
        // Set validation rules
        foreach ($fields as $field) {
            if ($field->required) {
                $this->form_validation->set_rules(
                    'field_' . $field->id,
                    $field->label,
                    'required'
                );
            }
        }

        if ($this->form_validation->run() === FALSE) {
            $data['form'] = $form;
            $data['fields'] = $fields;
            $data['errors'] = validation_errors();
            $this->load->view('forms/preview', $data);
        } else {
            // Save submission
            $submission_id = $this->form_model->create_submission($form_id);
            
            // Save field values
            foreach ($fields as $field) {
                $value = $this->input->post('field_' . $field->id);
                $this->form_model->save_submission_value($submission_id, $field->id, $value);
            }
            
            redirect('form_builder/success');
        }
    }

    private function get_field_types() {
        return [
            'text' => 'Text Input',
            'textarea' => 'Text Area',
            'select' => 'Dropdown',
            'radio' => 'Radio Buttons',
            'checkbox' => 'Checkboxes',
            'email' => 'Email',
            'number' => 'Number',
            'date' => 'Date',
            'file' => 'File Upload'
        ];
    }


    public function get_field($field_id) {
        $field = $this->form_model->get_field($field_id);
        echo json_encode($field);
    }

    public function delete_field($field_id) {
        $this->form_model->delete_field($field_id);
        echo json_encode(['status' => 'success']);
    }
    
    public function update_field_order() {
        $fields = $this->input->post('fields');
        foreach ($fields as $field) {
            $this->form_model->update_field_order($field['id'], $field['field_order']);
        }
        echo json_encode(['status' => 'success']);
    }
}