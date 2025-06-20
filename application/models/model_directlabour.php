<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Perbaikan: Nama class diawali huruf besar sesuai standar CodeIgniter
class Model_directlabour extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk menghitung total baris (pengganti getNumRows)
    public function get_count($description = '') {
        if (!empty($description)) {
            $this->db->like('description', $description, 'both', FALSE);
        }
        return $this->db->count_all_results('directlabour');
    }

    // Fungsi untuk mengambil data dengan paginasi (pengganti search)
    public function get_data($description = '', $limit, $offset) {
        if (!empty($description)) {
            $this->db->like('description', $description, 'both', FALSE);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get('directlabour')->result();
    }

    // Fungsi untuk mengambil data by ID (pengganti selectById)
    public function get_by_id($id) {
        return $this->db->get_where('directlabour', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('directlabour', $data);
    }

    public function update($id, $data) {
        return $this->db->update('directlabour', $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('directlabour', ['id' => $id]);
    }
}
?>