<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Halaman Login',
		];

		if ($data['user']) {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
			'required' => 'Email tidak boleh kosong!!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'required' => 'Password tidak boleh kosong!!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth/header', $data);
			$this->load->view('auth/index', $data);
			$this->load->view('templates/auth/footer');
		} else {
			$this->_login();
			redirect('dashboard');
		}
	}

	public function forgotpassword()
	{
		$data = [
			'user' => $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row(),
			'title' => 'Halaman Lupa Password',
		];

		if ($data['user']) {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
			'required' => 'Email tidak boleh kosong!!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth/header', $data);
			$this->load->view('auth/forgot-password', $data);
			$this->load->view('templates/auth/footer');
		} else {
			$email = $this->input->post('email', true);
			$this->db->where('email', $email);
			$query = $this->db->get('pengguna');

			if ($query->num_rows() > 0) {
				$user = $query->row();
			}

			if ($user) {
				$this->session->set_userdata('forgotEmail', $user->email);
				$this->_send_password_reset_email($user);
				$this->session->set_flashdata('forgot', '<div class="alert alert-success" role="alert">Link pemulihan password berhasil dikirim ke email</div>');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('forgot', '<div class="alert alert-danger" role="alert">Email tidak ada!</div>');
				redirect('auth/forgotpassword');
			}
		}
	}

	public function reset_password($token)
	{
		// Verify the token
		$this->db->where('token', $token);
		$query = $this->db->get('token_pengguna');

		if ($query->num_rows() > 0) {
			$user = $query->row();

			// Handle form submission
			if ($this->input->post('password', true) && $this->input->post('confirm_password', true)) {
				$password = $this->input->post('password', true);
				$confirm_password = $this->input->post('confirm_password', true);

				if ($password == $confirm_password) {
					// Update the user's password
					$this->db->where('email', $user->email);
					$this->db->update('pengguna', ['password' => password_hash($password, PASSWORD_DEFAULT)]);

					// Remove the token
					$this->db->where('email', $user->email);
					$this->db->delete('token_pengguna');

					$this->session->unset_userdata('forgotEmail');
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah!!</div>');
					redirect('auth');
				} else {
					$this->session->set_flashdata('reset', '<div class="alert alert-warning" role="alert">Password tidak sama!!</div>');
					redirect('auth/reset_password/' . $token);
				}
			} else {
				// Load the password reset form view
				$data['title'] = 'Reset Password';
				$this->load->view('templates/auth/header', $data);
				$this->load->view('auth/reset-password', $data);
				$this->load->view('templates/auth/footer');
			}
		} else {
			// Token is invalid or expired
			$this->session->unset_userdata('forgotEmail');
			$this->session->set_flashdata('forgot', '<div class="alert alert-danger" role="alert">Token salah atau kadaluarsa</div>');
			redirect('auth/forgotpassword');
		}
	}

	private function _send_password_reset_email($user)
	{
		$token = token($user->email, time());
		$this->db->delete('token_pengguna', ['email' => $user->email]);
		$this->db->insert('token_pengguna', ['email' => $user->email, 'token' => $token, 'tgl_dibuat' => time()]);

		$email_data = array(
			'name' => $user->nama,
			'email' => $user->email,
			'token' => $token
		);

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'sonychandmaulana@gmail.com';
		$config['smtp_pass'] = 'tjjx etbz vvoe rxyc'; // Make sure this is your actual password
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE;

		$this->email->initialize($config);

		$this->email->from('sonychandmaulana@gmail.com', 'Sony Chandra Maulana');
		$this->email->to($user->email);
		$this->email->subject('Pemulihan Password');

		// Inline critical CSS for basic styling
		$inline_css = '
<style>
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

h2 {
    color: #333;
}

p {
    line-height: 1.6;
}

a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff !important;
    text-decoration: none !important;
    border-radius: 5px;
}
</style>
';

		// Create HTML email template with inline styles
		$message = '
<html>
<head>
    ' . $inline_css . '
</head>
<body>
    <div class="container">
        <h2>Pemulihan Password</h2>
        <p>Halo <strong>' . $user->nama . '</strong>,</p>
        <p>Untuk memulihkan password, silahkan klik tombol dibawah:</p>
        <a href="' . base_url('auth/reset_password/')  . $token . '">Pulihkan Password</a>
        <p>Abaikan pesan ini jika anda tidak meminta pemulihan password!</p>
    </div>
</body>
</html>
';

		$this->email->message($message);

		if ($this->email->send()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}



	private function _login()
	{

		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$user = $this->db->get_where('pengguna', ['email' => $email])->row_array();

		// jika usernya ada
		if ($user) {
			// jika usernya aktif
			if ($user['status'] == 1) {
				// cek password
				if (password_verify($password, $user['password'])) {

					$data = [
						'nama' => $user['nama'],
						'email' => $user['email'],
						'role' => $user['role']
					];
					$this->session->set_userdata($data);

					$last_login = [
						'terakhir_login' => time(),
					];

					$this->db->set($last_login);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('pengguna');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum diaktivasi!!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!!</div>');
			redirect('auth');
		}
	}



	public function logout()
	{
		$user = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
		$last_login = [
			'terakhir_login' => time(),
		];

		$this->db->set($last_login);
		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('pengguna');

		$this->session->unset_userdata('nik');
		$this->session->unset_userdata('id_pasien');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah logout!</div>');
		redirect('auth');
	}
}
