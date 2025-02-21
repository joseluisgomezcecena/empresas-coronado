<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_model extends CI_Model {
    
    public function get_all_forms() {
        return $this->db->get('forms')->result();
    }
    
    public function create_form($data) {
        $this->db->insert('forms', $data);
        return $this->db->insert_id();
    }
    
    public function get_form($form_id) {
        return $this->db->get_where('forms', ['id' => $form_id])->row();
    }
    
    public function get_form_fields($form_id) {
        $this->db->where('form_id', $form_id);
        $this->db->order_by('field_order', 'ASC');
        return $this->db->get('form_fields')->result();
    }
    
    public function add_field($data) {
        $this->db->insert('form_fields', $data);
        return $this->db->insert_id();
    }
    
    public function update_field($data) {
        $this->db->where('id', $data['id']);
        $this->db->update('form_fields', $data);
    }
    
    public function create_submission($form_id) {
        $data = array(
            'form_id' => $form_id,
            'ip_address' => $this->input->ip_address()
        );
        $this->db->insert('form_submissions', $data);
        return $this->db->insert_id();
    }
    
    public function save_submission_value($submission_id, $field_id, $value) {
        $data = array(
            'submission_id' => $submission_id,
            'field_id' => $field_id,
            'field_value' => $value
        );
        $this->db->insert('submission_values', $data);
    }

    public function get_field($field_id) {
        return $this->db->get_where('form_fields', ['id' => $field_id])->row();
    }

    public function delete_field($field_id) {
        $this->db->delete('form_fields', ['id' => $field_id]);
    }
    
    public function update_field_order($field_id, $order) {
        $this->db->where('id', $field_id);
        $this->db->update('form_fields', ['field_order' => $order]);
    }

    public function get_next_field_order($form_id) {
        $this->db->select_max('field_order');
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('form_fields');
        $result = $query->row();
        return ($result->field_order ?? 0) + 1;
    }
}