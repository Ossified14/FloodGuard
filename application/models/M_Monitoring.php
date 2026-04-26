<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Monitoring extends CI_Model {

    public function get_all() {
        return $this->db->get('monitoring')->result_array();
    }

    public function get_by_filter($kolom, $nilai) {
        return $this->db->get_where('monitoring', [$kolom => $nilai])->result_array();
    }

    public function simpan($data) {
        return $this->db->insert('monitoring', $data);
    }

    public function get_by_id($id) {
        return $this->db->get_where('monitoring', ['id' => $id])->row_array();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('monitoring', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('monitoring');
    }

    // Statistik untuk Dashboard
    public function count_total() {
        return $this->db->count_all('monitoring');
    }

    public function count_by_lokasi() {
        $this->db->select('lokasi_sungai, COUNT(*) as jumlah');
        $this->db->group_by('lokasi_sungai');
        return $this->db->get('monitoring')->result_array();
    }

    public function count_by_status() {
        $this->db->select('status_banjir, COUNT(*) as jumlah');
        $this->db->group_by('status_banjir');
        return $this->db->get('monitoring')->result_array();
    }
}

