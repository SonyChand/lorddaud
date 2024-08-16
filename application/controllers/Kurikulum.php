<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        super();
        date_default_timezone_set('Asia/Jakarta');
    }



    public function kurikulum()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Kurikulum',
            'dataTab' => $this->db->get('kurikulum')->result()
        ];

        $this->form_validation->set_rules('kurikulum', 'Kurikulum', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Kurikulum', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('kurikulum/index', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataPost = [
                'kurikulum' => $this->input->post('kurikulum', true),
                'status' => $this->input->post('status', true),
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('kurikulum', $dataPost);

            $this->session->set_flashdata('kurikulum', '<div class="alert alert-success">Kurikulum <strong>' . $dataPost['kurikulum'] . '</strong> berhasil ditambahkan!!</div>');
            redirect('kurikulum/kurikulum');
        }
    }


    public function ubahKurikulum($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Kurikulum',
            'oneData' => $this->db->get_where('kurikulum', ['id' => $id])->row()
        ];

        $this->form_validation->set_rules('kurikulum', 'Kurikulum', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Kurikulum', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('kurikulum/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataUser = [
                'kurikulum' => $this->input->post('kurikulum', true),
                'status' => $this->input->post('status', true),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('kurikulum', $dataUser);


            $this->session->set_flashdata('kurikulum', '<div class="alert alert-success">Kurikulum <strong>' . $data['oneData']->kurikulum . '</strong> berhasil diubah!!</div>');
            redirect('kurikulum/kurikulum');
        }
    }

    public function hapuskurikulum($id)
    {
        $pel = $this->db->get_where('kurikulum', ['id' => $id])->row();

        $this->db->delete('kurikulum', ['id' => $id]);

        $this->session->set_flashdata('kurikulum', '<div class="alert alert-warning">Data Kurikulum <strong>' . $pel->kurikulum . '</strong> berhasil dihapus!!</div>');
        redirect('kurikulum/kurikulum');
    }
}
