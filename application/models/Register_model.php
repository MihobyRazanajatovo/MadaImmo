<?php
class Register_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function register($data) {
        return $this->db->insert('client', $data);
    }

    public function get_client_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('client');
        return $query->row();
    }
}
