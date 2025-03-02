<?php 

class Ajaxmessages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
    }

    public function submit()
    {
        // Check if this is an AJAX request
        if (!$this->input->is_ajax_request()) {
            $response = array('success' => false, 'message' => 'No direct script access allowed');
            echo json_encode($response);
            return;
        }
        
        // Get POST data directly
        $post_data = $this->input->post(null, true);
        
        // If no POST data, try getting raw input (for fetch API)
        if (empty($post_data)) {
            $raw_data = file_get_contents('php://input');
            $post_data = json_decode($raw_data, true);
        }
        
        // Validate required fields
        $required_fields = ['name', 'email', 'phone', 'message'];
        foreach ($required_fields as $field) {
            if (empty($post_data[$field])) {
                $response = array('success' => false, 'message' => 'Todos los campos son obligatorios');
                echo json_encode($response);
                return;
            }
        }
        
        // Validate email
        if (!filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)) {
            $response = array('success' => false, 'message' => 'Por favor, ingresa un correo electrónico válido');
            echo json_encode($response);
            return;
        }
        
        // Prepare data for saving
        $message_data = array(
            'name' => $post_data['name'],
            'email' => $post_data['email'],
            'phone' => $post_data['phone'],
            'message' => $post_data['message'],
            'created_at' => date('Y-m-d H:i:s')
        );
        
        // Save to database
        $result = $this->Message_model->save_message($message_data);
        
        if ($result) {
            $response = array('success' => true, 'message' => '¡Gracias! Tu mensaje ha sido enviado correctamente.');
        } else {
            $response = array('success' => false, 'message' => 'Ha ocurrido un error al enviar el mensaje. Por favor, intenta nuevamente.');
        }
        
        echo json_encode($response);
    }
}