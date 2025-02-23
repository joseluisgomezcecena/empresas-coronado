<?php

class Inventory extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inventory_model');
        $this->load->model('Products_model');
    }

    public function movements($product_id)
    {
        // Check if product exists
        if(!$this->Products_model->get_product($product_id)){
            $this->session->set_flashdata('error', 'El producto no existe');
            redirect(base_url().'products');
        }

        $data['active'] = 'products';
        $data['title'] = 'Movimientos de Inventario';
        $data['product'] = $this->Products_model->get_product($product_id);
        $data['inventory'] = $this->Inventory_model->get_product_inventory($product_id);
        $data['movements'] = $this->Inventory_model->get_product_movements($product_id);
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('inventory/movements', $data);
        $this->load->view('_templates/footer');
    }

    public function add_movement($product_id)
    {
        // Check if product exists
        if(!$this->Products_model->get_product($product_id)){
            $this->session->set_flashdata('error', 'El producto no existe');
            redirect(base_url().'products');
        }

        $data['active'] = 'products';
        $data['title'] = 'Agregar Movimiento';
        $data['product'] = $this->Products_model->get_product($product_id);
        $data['entrada_reasons'] = $this->Inventory_model->get_inventory_reasons('entrada');
        $data['salida_reasons'] = $this->Inventory_model->get_inventory_reasons('salida');
        
        $this->form_validation->set_rules('movement_type', 'Tipo de Movimiento', 'required');
        $this->form_validation->set_rules('quantity', 'Cantidad', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('reason', 'Motivo', 'required');
        $this->form_validation->set_rules('description', 'Descripción', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('inventory/add_movement', $data);
            $this->load->view('_templates/footer');
        } else {
            $movement_type = $this->input->post('movement_type');
            $quantity = $this->input->post('quantity');

            // Validate stock for outgoing movements
            if ($movement_type === 'salida' && !$this->Inventory_model->validate_stock($product_id, $quantity)) {
                $this->session->set_flashdata('error', 'No hay suficiente stock disponible');
                redirect(base_url().'inventory/add_movement/'.$product_id);
            }

            $movement_data = array(
                'product_id' => $product_id,
                'movement_type' => $movement_type,
                'quantity' => $quantity,
                'reason' => $this->input->post('reason'),
                'description' => $this->input->post('description'),
                'created_by' => $this->session->userdata('user_id')
            );

            $this->Inventory_model->add_movement($movement_data);
            $this->session->set_flashdata('success', 'Movimiento registrado exitosamente');
            redirect(base_url().'inventory/movements/'.$product_id);
        }
    }
}