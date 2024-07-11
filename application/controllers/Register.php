<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('login/register_client');
    }
    public function register_client()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[client.email]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/register_client');
        } else {
            $data = array(
                'email' => $this->input->post('email')
            );
            if ($this->Register_model->register($data)) {
                $client = $this->Register_model->get_client_by_email($data['email']);
                $this->session->set_userdata('id_client', $client->id_client);
                redirect('login/login_client_view');
            } else {
                $this->load->view('login/register_client');
            }
        }
    }
}
