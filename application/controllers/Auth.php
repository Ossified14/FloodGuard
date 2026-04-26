<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Auth');
        $this->load->library('session'); // Pastikan library session aktif
    }

    // Menampilkan halaman login
    public function index() {
        $this->load->view('v_login');
    }

    // Menampilkan halaman registrasi
    public function register() {
        $this->load->view('v_register');
    }

    // Proses registrasi
    public function proses_register() {
        $data = [
            'username' => $this->input->post('username'),
            'sandi'    => password_hash($this->input->post('sandi'), PASSWORD_DEFAULT) // Enkripsi password
        ];

        if ($this->M_Auth->simpan_user($data)) {
            $this->session->set_flashdata('pesan', 'Registrasi Berhasil! Silakan Login.');
            redirect('auth');
        }
    }

    // Proses login
    public function proses_login() {
        $username = $this->input->post('username');
        $sandi    = $this->input->post('sandi');

        $user = $this->M_Auth->cek_user($username);

        if ($user) {
            // PAKAI INI untuk mengecek sandi yang "aneh" tadi
            if (password_verify($sandi, $user['sandi']) || $sandi === $user['sandi']) {
                
                // Simpan data ke session
                $session_data = [
                    'user_id'   => isset($user['id']) ? $user['id'] : 0, // Hindari error jika id tidak ada
                    'username'  => $user['username'],
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($session_data);

                // Cek apakah redirect ini benar
                redirect(base_url('dashboard')); 
            } else {
                $this->session->set_flashdata('error', 'Sandi Salah!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Username Tidak Ditemukan!');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}


