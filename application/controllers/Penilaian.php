<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        super();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function penilaian()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Penilaian',
            'dataTab' => $this->db->get('penilaian')->result(),
            'data1' => $this->db->get('siswa')->result(),
            'data2' => $this->db->get('mata_pelajaran')->result()
        ];

        $this->form_validation->set_rules('id_siswa', 'Siswa', 'required|trim');
        $this->form_validation->set_rules('id_matpel', 'Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim|numeric');
        $this->form_validation->set_rules('jenis_penilaian', 'Jenis Penilaian', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('penilaian/index', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataPost = [
                'id_siswa' => $this->input->post('id_siswa', true),
                'id_matpel' => $this->input->post('id_matpel', true),
                'nilai' => $this->input->post('nilai', true),
                'jenis_penilaian' => $this->input->post('jenis_penilaian', true),
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('penilaian', $dataPost);

            $siswa = $this->db->get_where('siswa', ['id' => $dataPost['id_siswa']])->row();
            $matpel = $this->db->get_where('mata_pelajaran', ['id' => $dataPost['id_matpel']])->row();

            $this->session->set_flashdata('penilaian', '<div class="alert alert-success">Nilai Siswa <strong>' . $siswa->nama . '</strong> pada Mata Pelajaran <strong>' . $matpel->nama . '</strong> berhasil ditambahkan!!</div>');
            redirect('penilaian/penilaian');
        }
    }


    public function ubahPenilaian($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Penilaian',
            'oneData' => $this->db->select('penilaian.*, siswa.nama as siswa, mata_pelajaran.nama as matpel, siswa.nisn, mata_pelajaran.kode')->join('siswa', 'penilaian.id_siswa = siswa.id', 'left')->join('mata_pelajaran', 'penilaian.id_matpel = mata_pelajaran.id', 'left')->get_where('penilaian', ['penilaian.id' => $id])->row(),
            'data1' => $this->db->get('siswa')->result(),
            'data2' => $this->db->get('mata_pelajaran')->result()
        ];

        $this->form_validation->set_rules('id_siswa', 'Siswa', 'required|trim');
        $this->form_validation->set_rules('id_matpel', 'Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim|numeric');
        $this->form_validation->set_rules('jenis_penilaian', 'Jenis Penilaian', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('penilaian/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataPost = [
                'id_siswa' => $this->input->post('id_siswa', true),
                'id_matpel' => $this->input->post('id_matpel', true),
                'nilai' => $this->input->post('nilai', true),
                'jenis_penilaian' => $this->input->post('jenis_penilaian', true),
                'tgl_dibuat' => time(),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('penilaian', $dataPost);

            $siswa = $this->db->get_where('siswa', ['id' => $dataPost['id_siswa']])->row();
            $matpel = $this->db->get_where('mata_pelajaran', ['id' => $dataPost['id_matpel']])->row();


            $this->session->set_flashdata('penilaian', '<div class="alert alert-success">Nilai Siswa <strong>' . $siswa->nama . '</strong> pada Mata Pelajaran <strong>' . $matpel->nama . '</strong> berhasil diubah!!</div>');
            redirect('penilaian/penilaian');
        }
    }

    public function hapusPenilaian($id)
    {
        $pel = $this->db->get_where('penilaian', ['id' => $id])->row();
        $siswa = $this->db->get_where('siswa', ['id' => $pel->id_siswa])->row();
        $matpel = $this->db->get_where('mata_pelajaran', ['id' => $pel->id_matpel])->row();

        $this->db->delete('penilaian', ['id' => $id]);

        $this->session->set_flashdata('penilaian', '<div class="alert alert-warning">Data Nilai Siswa <strong>' . $siswa->nama . '</strong> pada Mata Pelajaran <strong>' . $matpel->nama . '</strong> berhasil dihapus!!</div>');
        redirect('penilaian/penilaian');
    }


    public function kelas()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Kelas',
            'dataTab' => $this->db->get('kelas')->result(),
            'data1' => $this->db->get_where('pengguna', ['role' => 2])->result()
        ];

        $this->form_validation->set_rules('id_ustadz', 'Walikelas', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Kelas', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Kelas', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('akademik/kelas/index', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataPost = [
                'id_ustadz' => $this->input->post('id_ustadz', true),
                'nama' => $this->input->post('nama', true),
                'status' => $this->input->post('status', true),
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('kelas', $dataPost);

            $this->session->set_flashdata('kelas', '<div class="alert alert-success">Kelas <strong>' . $dataPost['nama'] . '</strong> berhasil ditambahkan!!</div>');
            redirect('akademik/kelas');
        }
    }


    public function ubahkelas($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Kelas',
            'oneData' => $this->db->get_where('kelas', ['id' => $id])->row(),
            'data1' => $this->db->get_where('pengguna', ['role' => 2])->result()
        ];

        $this->form_validation->set_rules('id_ustadz', 'Walikelas', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Kelas', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Kelas', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('akademik/kelas/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $dataPost = [
                'id_ustadz' => $this->input->post('id_ustadz', true),
                'nama' => $this->input->post('nama', true),
                'status' => $this->input->post('status', true),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('kelas', $dataPost);


            $this->session->set_flashdata('kelas', '<div class="alert alert-success">Kelas <strong>' . $data['oneData']->nama . '</strong> berhasil diubah!!</div>');
            redirect('akademik/kelas');
        }
    }

    public function hapuskelas($id)
    {
        $pel = $this->db->get_where('kelas', ['id' => $id])->row();

        $this->db->delete('kelas', ['id' => $id]);

        $this->session->set_flashdata('kelas', '<div class="alert alert-warning">Data Kelas <strong>' . $pel->nama . '</strong> berhasil dihapus!!</div>');
        redirect('akademik/kelas');
    }

    public function guru()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Guru',
            'dataTab' => $this->db->get('ustadz')->result(),
            'data1' => $this->db->get_where('pengguna', ['role' => 2, 'image' => 'default'])->result()
        ];

        $this->form_validation->set_rules('id_user', 'Akun Pengguna', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('tpt_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|exact_length[16]');
        $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('akademik/guru/index', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $image = $_FILES['image']['name'];

            if ($image) {

                $config['file_name'] = md5(sha1(time() . '-' . strtolower(str_replace(' ', '', $this->input->post('nama', true))) . "@gmail.com"));
                $config['encrypt_name'] = TRUE;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '5000';
                $config['upload_path'] = './assets/img/user/';

                if (is_dir($config['upload_path']) != true) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $img = $this->upload->data('file_name');
                } else {
                    $img = 'default';
                }
            }

            if ($this->input->post('id_user', true) == "buatkan") {
                $data1 = [
                    'nama' => $this->input->post('nama', true),
                    'email' => strtolower(str_replace(' ', '', $this->input->post('nama', true))) . "@gmail.com",
                    'password' => password_hash(strtolower(str_replace(' ', '', $this->input->post('nama', true))) . "@gmail.com", PASSWORD_DEFAULT),
                    'image' => $img,
                    'role' => 2,
                    'no_hp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_hp', true))),
                    'jenis_kelamin' => $this->input->post('jk', true),
                    'tgl_dibuat' => time(),
                    'status' => 1
                ];

                $this->db->insert('pengguna', $data1);
                $cariIdUser = $this->db->get_where('pengguna', ['nama' => $this->input->post('nama', true), 'email' => $data1['email'], 'image' => $data1['image']])->last_row()->id;
            } else {
                $cariIdUser = $this->input->post('id_user', true);
            }


            $dataUser = [
                'id_user' => $cariIdUser,
                'nik' => $this->input->post('nik', true),
                'nama' => $this->input->post('nama', true),
                'tpt_lahir' => $this->input->post('tpt_lahir', true),
                'tgl_lahir' => strtotime($this->input->post('tgl_lahir', true)),
                'jk' => $this->input->post('jk', true),
                'no_hp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_hp', true))),
                'agama' => $this->input->post('agama', true),
                'pendidikan' => $this->input->post('pendidikan', true),
                'alamat' => $this->input->post('alamat', true),
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('ustadz', $dataUser);

            $this->session->set_flashdata('guru', '<div class="alert alert-success">Guru <strong>' . $dataUser['nama'] . '</strong> berhasil ditambahkan!!</div>');
            redirect('akademik/guru');
        }
    }


    public function ubahGuru($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Guru',
            'oneData' => $this->db->get_where('ustadz', ['id' => $id])->row(),
            'data1' => $this->db->get_where('pengguna', ['role' => 2, 'image' => 'default'])->result()
        ];

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('tpt_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|exact_length[16]');
        $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('akademik/guru/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $upload_image = $_FILES['image']['name'];
            if ($data['oneData']->id_user) {
                $email = $this->db->get_where('pengguna', ['id' => $data['oneData']->id_user])->row()->email;
            } else {
                $email = strtolower(str_replace(' ', '', $this->input->post('nama', true))) . "@gmail.com";
            }
            $blabla = $this->db->get_where('pengguna', ['email' => $email])->row();

            if ($upload_image) {

                if ($_FILES['image']['size'] > 5120000) {
                    $isiPesan = '
            <div class="alert alert-danger alert-dismissible fade show border border-dark" role="alert">
                        <strong>Ukuran Gambar</strong> tidak bisa melebihi <strong>5 MB</strong>
            </div>';
                    $this->session->set_flashdata('guru', $isiPesan);
                    redirect('akademik/guru');
                }

                $config['file_name'] = time() . '_' . md5(sha1(base64_encode($email))) . time();
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '5012';
                $config['upload_path'] = './assets/img/user/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $blabla->image;

                    unlink(FCPATH . 'assets/img/user/' . $old_image);

                    // if (unlink(FCPATH . 'assets/img/user/' . $old_image) == false) {
                    //     redirect('ustadz');
                    // }

                    $new_image = $this->upload->data('file_name');
                    $this->db->where('id', $blabla->id);
                    $this->db->update('pengguna', ['image' => $new_image]);
                } else {
                    redirect('akademik/guru');
                }
            }

            $dataUser = [
                'nik' => $this->input->post('nik', true),
                'nama' => $this->input->post('nama', true),
                'tpt_lahir' => $this->input->post('tpt_lahir', true),
                'tgl_lahir' => strtotime($this->input->post('tgl_lahir', true)),
                'jk' => $this->input->post('jk', true),
                'no_hp' => str_replace(' ', '', str_replace('+', '', $this->input->post('no_hp', true))),
                'agama' => $this->input->post('agama', true),
                'pendidikan' => $this->input->post('pendidikan', true),
                'alamat' => $this->input->post('alamat', true),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('ustadz', $dataUser);


            $this->session->set_flashdata('guru', '<div class="alert alert-success">Ustadz dengan Nama <strong>' . $data['oneData']->nama . '</strong> berhasil diubah!!</div>');
            redirect('akademik/guru');
        }
    }

    public function hapusGuru($id)
    {
        $pel = $this->db->get_where('ustadz', ['id' => $id])->row();

        $this->db->delete('ustadz', ['id' => $id]);

        $this->session->set_flashdata('guru', '<div class="alert alert-warning">Data Guru dengan Nama <strong>' . $pel->nama . '</strong> berhasil dihapus!!</div>');
        redirect('akademik/guru');
    }

    public function matpel()
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Mata Pelajaran',
            'dataTab' => $this->db->get('mata_pelajaran')->result()
        ];

        $this->form_validation->set_rules('kode', 'Kode Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('nama', 'Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Mata Pelajaran', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('akademik/matpel/index', $data);
            $this->load->view('templates/dash/footer');
        } else {
            $silabus = $_FILES['silabus']['name'];

            if ($silabus) {

                $config['file_name'] = md5(sha1(time() . '-' . strtolower(str_replace(' ', '', $this->input->post('kode', true)))));
                $config['encrypt_name'] = TRUE;
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size']      = '5000';
                $config['upload_path'] = './assets/doc/silabus/';

                if (is_dir($config['upload_path']) != true) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('silabus')) {
                    $sila = $this->upload->data('file_name');
                } else {
                    $sila = null;
                }
            }


            $dataPost = [
                'kode' => $this->input->post('kode', true),
                'nama' => $this->input->post('nama', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'silabus' => $sila,
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('mata_pelajaran', $dataPost);

            $this->session->set_flashdata('matpel', '<div class="alert alert-success">Mata Pelajaran <strong>' . $dataPost['nama'] . '</strong> berhasil ditambahkan!!</div>');
            redirect('akademik/matpel');
        }
    }


    public function ubahMatpel($id = '')
    {
        $data = [
            'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
            'title' => 'Ubah Mata Pelajaran',
            'oneData' => $this->db->get_where('mata_pelajaran', ['id' => $id])->row()
        ];

        $this->form_validation->set_rules('kode', 'Kode Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('nama', 'Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Mata Pelajaran', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dash/header', $data);
            $this->load->view('templates/dash/sidenav', $data);
            $this->load->view('akademik/matpel/ubah', $data);
            $this->load->view('templates/dash/footer');
        } else {

            $upload_silabus = $_FILES['silabus']['name'];
            $kode = $this->db->get_where('mata_pelajaran', ['id' => $data['oneData']->id])->row()->kode;
            $blabla = $this->db->get_where('mata_pelajaran', ['kode' => $kode])->row();

            if ($upload_silabus) {

                if ($_FILES['silabus']['size'] > 5120000) {
                    $isiPesan = '
            <div class="alert alert-danger alert-dismissible fade show border border-dark" role="alert">
                        <strong>Ukuran File</strong> tidak bisa melebihi <strong>5 MB</strong>
            </div>';
                    $this->session->set_flashdata('matpel', $isiPesan);
                    redirect('akademik/matpel');
                }

                $config['file_name'] = md5(sha1(time() . '-' . strtolower(str_replace(' ', '', $this->input->post('kode', true)))));
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size']      = '5012';
                $config['upload_path'] = './assets/doc/silabus/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('silabus')) {
                    $old_silabus = $blabla->silabus;

                    unlink(FCPATH . 'assets/doc/silabus/' . $old_silabus);

                    $silabus = $this->upload->data('file_name');
                    $this->db->set('silabus', $silabus);
                } else {
                    redirect('akademik/matpel');
                }
            }

            $dataUser = [
                'kode' => $this->input->post('kode', true),
                'nama' => $this->input->post('nama', true),
                'deskripsi' => $this->input->post('deskripsi', true),
            ];

            $this->db->where('id', $data['oneData']->id);
            $this->db->update('mata_pelajaran', $dataUser);


            $this->session->set_flashdata('matpel', '<div class="alert alert-success">Mata Pelajaran <strong>' . $data['oneData']->nama . '</strong> berhasil diubah!!</div>');
            redirect('akademik/matpel');
        }
    }

    public function hapusmatpel($id)
    {
        $pel = $this->db->get_where('mata_pelajaran', ['id' => $id])->row();

        $this->db->delete('mata_pelajaran', ['id' => $id]);

        $this->session->set_flashdata('matpel', '<div class="alert alert-warning">Data Mata Pelajaran <strong>' . $pel->nama . '</strong> berhasil dihapus!!</div>');
        redirect('akademik/matpel');
    }
}
