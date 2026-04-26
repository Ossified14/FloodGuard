<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {

    public function cek_user($username) {
        return $this->db->get_where('data_user', ['username' => $username])->row_array();
    }

    public function simpan_user($data) {
        return $this->db->insert('data_user', $data);
    }
}

