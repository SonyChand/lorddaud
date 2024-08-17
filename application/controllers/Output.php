<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Output extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        check_user_access();
        $this->load->library('pdfgenerator');
    }

    public function datapengguna()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Pengguna',
            'data1' => $this->db->get('pengguna')->result(),
        ];


        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/pengguna/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }


    public function dataKurikulum()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Kurikulum',
            'data1' => $this->db->get('kurikulum')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/kurikulum/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataMataPelajaran()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan MataPelajaran',
            'data1' => $this->db->get('mata_pelajaran')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/matpel/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataKelas()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Kelas',
            'data1' => $this->db->get('kelas')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/kelas/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataguru()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Guru',
            'data1' => $this->db->get('ustadz')->result(),
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/guru/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataSiswa()
    {
        $this->db->order_by('id_kelas', 'ASC');
        if ($this->input->post('kelas', true) == 'all') {
            $data1 = $this->db->get('siswa')->result();
        } elseif ($this->input->post('kelas', true) != 'all') {
            $data1 = $this->db->get_where('siswa', ['id_kelas' => $this->input->post('kelas', true)])->result();
        } else {
            redirect('akademik/siswa');
        }

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Siswa',
            'data1' => $data1,
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Landscape';
        $html = $this->load->view('output/siswa/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataJadwal()
    {
        $this->db->order_by('id_kelas', 'ASC');
        $this->db->order_by('hari', 'ASC');
        $this->db->order_by('jam_mulai', 'ASC');
        if ($this->input->post('kelas', true) == 'all') {
            $data1 = $this->db->get('penjadwalan')->result();
        } elseif ($this->input->post('kelas', true) != 'all') {
            $data1 = $this->db->get_where('penjadwalan', ['id_kelas' => $this->input->post('kelas', true)])->result();
        } else {
            redirect('akademik/jadwal');
        }

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Penjadwalan Mata Pelajaran',
            'data1' => $data1,
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/jadwal/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    public function dataNilai()
    {
        $this->db->order_by('id_siswa', 'ASC');
        $this->db->order_by('id_matpel', 'ASC');
        $this->db->order_by('jenis_penilaian', 'ASC');
        $this->db->order_by('nilai', 'ASC');
        if ($this->input->post('id_siswa', true) == 'all' && $this->input->post('id_matpel', true) == 'all') {
            $data1 = $this->db->get('penilaian')->result();
        } elseif ($this->input->post('id_siswa', true) != 'all' && $this->input->post('id_matpel', true) == 'all') {
            $data1 = $this->db->get_where('penilaian', ['id_siswa' => $this->input->post('id_siswa', true)])->result();
        } elseif ($this->input->post('id_siswa', true) == 'all' && $this->input->post('id_matpel', true) != 'all') {
            $data1 = $this->db->get_where('penilaian', ['id_matpel' => $this->input->post('id_matpel', true)])->result();
        } elseif ($this->input->post('id_siswa', true) != 'all' && $this->input->post('id_matpel', true) != 'all') {
            $data1 = $this->db->get_where('penilaian', ['id_siswa' => $this->input->post('id_siswa', true), 'id_matpel' => $this->input->post('id_matpel', true)])->result();
        } else {
            redirect('akademik/penilaian');
        }

        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Laporan Nilai',
            'data1' => $data1,
        ];

        $file_pdf = strtolower($data['title']);
        $paper = 'A4';
        $orientation = 'Portrait';
        $html = $this->load->view('output/penilaian/data', $data, true);


        $this->print($html, $file_pdf, $paper, $orientation);
    }

    private function print($html, $filename = '', $paper = '', $orientation = '')
    {
        $this->pdfgenerator->generate($html, $filename, $paper, $orientation);
    }
}
