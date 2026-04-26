<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load library session agar bisa ngecek status login
        $this->load->library('session');
        // Load model yang digunakan di controller ini
        $this->load->model('M_Monitoring');
        
        // Proteksi: Jika belum login, balikin ke halaman login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = "Halaman Dashboard";
        
        // Ambil data statistik dari model
        $data['total']      = $this->M_Monitoring->count_total();
        $data['per_lokasi'] = $this->M_Monitoring->count_by_lokasi();
        $data['per_status'] = $this->M_Monitoring->count_by_status();

        // Gunakan view standar CodeIgniter untuk merender halaman
        $this->load->view('v_dashboard', $data);
    }

    public function tambah_laporan() {
        $this->load->view('v_tambah_laporan');
    }

    public function simpan_laporan() {
        // Konfigurasi Upload Foto
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_bukti')) {
            $file_data = $this->upload->data();
            $data = [
                'user_id'           => $this->session->userdata('user_id'), // Ambil ID dari session
                'lokasi_sungai'     => $this->input->post('lokasi_sungai'),
                'waktu_pengukuran'  => date('Y-m-d H:i:s'),
                'tinggi_air'        => $this->input->post('tinggi_air'),
                'status_banjir'     => $this->input->post('status_banjir'),
                'deskripsi'         => $this->input->post('deskripsi'),
                'foto_bukti'        => $file_data['file_name']
            ];
            $this->M_Monitoring->simpan($data);
            redirect('dashboard');
        } else {
            echo $this->upload->display_errors();
        }
    }

    public function list_data($filter = null, $nilai = null) {
        if ($filter) {
            $data['laporan'] = $this->M_Monitoring->get_by_filter($filter, urldecode($nilai));
        } else {
            $data['laporan'] = $this->M_Monitoring->get_all();
        }
        $this->load->view('v_data_laporan', $data);
    }

    public function edit_laporan($id) {
        $data['laporan'] = $this->M_Monitoring->get_by_id($id);
        if (!$data['laporan']) {
            redirect('dashboard/list_data');
        }
        $this->load->view('v_edit_laporan', $data);
    }

    public function update_laporan() {
        $id = $this->input->post('id');
        $data = [
            'lokasi_sungai'     => $this->input->post('lokasi_sungai'),
            'tinggi_air'        => $this->input->post('tinggi_air'),
            'status_banjir'     => $this->input->post('status_banjir'),
            'deskripsi'         => $this->input->post('deskripsi'),
        ];

        // Cek apakah ada file foto yang diupload
        if (!empty($_FILES['foto_bukti']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_bukti')) {
                // Hapus foto lama jika ada
                $old_data = $this->M_Monitoring->get_by_id($id);
                if ($old_data && $old_data['foto_bukti'] && file_exists('./uploads/' . $old_data['foto_bukti'])) {
                    unlink('./uploads/' . $old_data['foto_bukti']);
                }

                $file_data = $this->upload->data();
                $data['foto_bukti'] = $file_data['file_name'];
            } else {
                echo $this->upload->display_errors();
                return;
            }
        }

        $this->M_Monitoring->update($id, $data);
        redirect('dashboard/list_data');
    }

    public function hapus_laporan($id) {
        $data = $this->M_Monitoring->get_by_id($id);
        if ($data) {
            // Hapus foto
            if ($data['foto_bukti'] && file_exists('./uploads/' . $data['foto_bukti'])) {
                unlink('./uploads/' . $data['foto_bukti']);
            }
            $this->M_Monitoring->delete($id);
        }
        redirect('dashboard/list_data');
    }
}

