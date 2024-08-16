<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tahun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        super();
        date_default_timezone_set('Asia/Jakarta');
    }



    public function tahun()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Tahun Pelajaran',
            'dataTab' => $this->db->get('tahun')->result()
        ];

        $this->form_validation->set_rules('tahun', 'Tahun Pelajaran', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Tahun Pelajaran', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('tahun/index', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataPost = [
                'tahun' => $this->input->post('tahun', true),
                'status' => $this->input->post('status', true),
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('tahun', $dataPost);

            $this->session->set_flashdata('tahun', '<div class="alert alert-success">Tahun Pelajaran <strong>' . $dataPost['tahun'] . '</strong> berhasil ditambahkan!!</div>');
            redirect('tahun/tahun');
        }
    }


    public function ubahTahun($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Tahun Pelajaran',
            'oneData' => $this->db->get_where('tahun', ['id' => $id])->row()
        ];

        $this->form_validation->set_rules('tahun', 'Tahun Pelajaran', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Tahun Pelajaran', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('tahun/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataUser = [
                'tahun' => $this->input->post('tahun', true),
                'status' => $this->input->post('status', true),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('tahun', $dataUser);


            $this->session->set_flashdata('tahun', '<div class="alert alert-success">Tahun Pelajaran <strong>' . $data['oneData']->tahun . '</strong> berhasil diubah!!</div>');
            redirect('tahun/tahun');
        }
    }

    public function hapustahun($id)
    {
        $pel = $this->db->get_where('tahun', ['id' => $id])->row();

        $this->db->delete('tahun', ['id' => $id]);

        $this->session->set_flashdata('tahun', '<div class="alert alert-warning">Data Tahun Pelajaran <strong>' . $pel->tahun . '</strong> berhasil dihapus!!</div>');
        redirect('tahun/tahun');
    }
}
