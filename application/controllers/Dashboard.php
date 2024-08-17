<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_user_access();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Dashboard',
        ];

        $this->load->view('templates/dash/header', $data);
        $this->load->view('templates/dash/sidenav', $data);
        $this->load->view('dash/index', $data);
        $this->load->view('templates/dash/footer');
    }

    public function uwu()
    {
        echo 'kewk';
    }
}
