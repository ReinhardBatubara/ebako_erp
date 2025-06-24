<?php

class Model_directlabour extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi generik untuk mengambil data dengan paginasi untuk EasyUI Datagrid
    function get($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            return json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function selectAllResult() {
        return $this->db->get('direct_labour')->result();
    }

    // Fungsi untuk memasukkan data baru ke tabel 'direct_labour'
    function insert($data) {
        return $this->db->insert('direct_labour', $data);
    }

    // Fungsi untuk memperbarui data di tabel 'direct_labour'
    function update($data, $where) {
        return $this->db->update('direct_labour', $data, $where);
    }

    // Fungsi untuk menghapus data dari tabel 'direct_labour'
    function delete($where) {
        return $this->db->delete('direct_labour', $where);
    }
}