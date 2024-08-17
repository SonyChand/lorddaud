<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function userData()
    {
        $query = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row();
        return $query;
    }

    public function allUser()
    {
        $query = $this->db->get('user')->result();
        return $query;
    }

    public function allUserExceptionSelf()
    {
        $query = $this->db
            ->get_where('user', [
                'email !=' => $this->userData()->email
            ])->result();
        return $query;
    }

    public function userById($id)
    {
        $query = $this->db->get_where('user', [
            'id_user' => $id
        ])->row();
        return $query;
    }

    public function userByEmail($email)
    {
        $query = $this->db->get_where('user', [
            'email' => $email
        ])->row();
        return $query;
    }

    public function insertUser($data)
    {
        $query = $this->db->insert('user', $data);
        return $query;
    }

    public function updateUser($data, $where)
    {
        $query = $this->db->update('user', $data, $where);
        return $query;
    }

    public function deleteUser($where)
    {
        $query = $this->db->delete('user', $where);
        return $query;
    }

    public function countAllUser()
    {
        $query = $this->db->get('user')->num_rows();
        return $query;
    }
}
