<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_user_access();
		$this->load->model('User_model', 'user');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function user()
	{
		$data = [
			'user' => $this->user->userData(),
			'title' => uriSubtitle(),
			'dataSelectRole' => $this->db->get('user_role')->result(),
			'dataTab' => $this->db->get_where('user', ['email !=' => $this->user->userData()->email])->result()
		];

		$this->load->view('templates/dash/header', $data);
		$this->load->view('templates/dash/sidenav', $data);
		$this->load->view('admin/user/index', $data);
		$this->load->view('templates/dash/footer');
	}

	public function listUser()
	{
		$user = $this->user->allUserExceptionSelf();
		$result = array();
		$i = 1;

		$menu = $this->db->get_where('user_menu', ['uri' => uri1()])->row();
		$roleAccess = $this->db->get_where('user_crud_access', [
			'user_id' => $this->user->userData()->id_user,
			'menu_id' => $menu->id_menu,
			'uri' => 'roleUser'
		])->num_rows();

		$editAccess = $this->db->get_where('user_crud_access', [
			'user_id' => $this->user->userData()->id_user,
			'menu_id' => $menu->id_menu,
			'uri' => 'editUser'
		])->num_rows();

		$deleteAccess = $this->db->get_where('user_crud_access', [
			'user_id' => $this->user->userData()->id_user,
			'menu_id' => $menu->id_menu,
			'uri' => 'deleteUser'
		])->num_rows();

		$html = '';

		foreach ($user as $row) {
			if ($roleAccess != 0) {
				$html .= '<button type="button" style="text-decoration: none !important;" class="btn btn-icon btn-link link-primary" onclick="window.location.href=\'' . base_url('kekw') . '\';"><i class="fas fa-key"></i></button> ';
			}
			if ($editAccess != 0) {
				$html .= '<button type="button" style="text-decoration: none !important;" class="btn btn-icon btn-link link-warning" onclick="editUser(' . $row->id_user . ')"><i class="fas fa-edit"></i></button> ';
			}
			if ($deleteAccess != 0) {
				$html .= '<button type="button" style="text-decoration: none !important;" class="btn btn-icon btn-link link-danger" onclick="deleteUser(' . $row->id_user . ')"><i class="fas fa-trash"></i></button>';
			}
			$role = $this->db->get_where('user_role', ['id_role' => $row->role_id])->row();
			$result['data'][] = array(
				$i++,
				$row->email,
				$row->name,
				$role->role,
				$row->is_active,
				$html
			);

			$html = '';
		}
		echo json_encode($result);
	}

	public function addUser()
	{
		$data = [
			'email' => $this->input->post('email', true),
			'name' => $this->input->post('name', true),
			'password' => password_hash($this->input->post('email', true), PASSWORD_DEFAULT),
			'image' => 'default',
			'role_id' => $this->input->post('role_id', true),
			'is_active' => $this->input->post('is_active', true),
			'date_created' => time(),
		];

		$insert = $this->user->insertUser($data);
		echo json_encode($insert);
	}

	public function getUser()
	{
		$id = $this->input->post('id_user', true);
		$result = $this->user->userById($id);
		echo json_encode($result);
	}

	public function editUser()
	{
		$id = $this->input->post('id_user', true);
		$data = [
			'name' => $this->input->post('name', true),
			'email' => $this->input->post('email', true),
			'role_id' => $this->input->post('role_id', true),
			'is_active' => $this->input->post('is_active', true),
			'last_updated' => time(),
		];

		$where = [
			'id_user' => $id
		];

		$this->user->updateUser($data, $where);

		echo 1;
	}

	public function deleteUser()
	{
		$id = $this->input->post('id_user', true);
		$where = [
			'id_user' => $id
		];
		$delete = $this->user->deleteUser($where);
		$count = $this->user->countAllUser();
		if ($delete == true) {
			$status = 1;
		} else {
			$status = 2;
		}
		$data = [
			'success' => $status,
			'count' => $count - 1
		];
		echo json_encode($data);
	}
}
