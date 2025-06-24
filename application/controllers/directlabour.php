<?php

class Directlabour extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memuat model yang akan sering digunakan
        $this->load->model('model_directlabour');
    }

    // Fungsi ini untuk menampilkan halaman utama
    function index() {
        $this->load->model('model_user');
        // Mendapatkan hak akses (add, edit, delete) untuk ditampilkan di view
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "directlabour"));
        
        $this->load->view('directlabour/view', $data);
    }

    // Fungsi ini dipanggil oleh Datagrid untuk mengambil data (AJAX)
    function get() {
        // Ambil parameter pencarian dari datagrid
        $description = $this->input->post('description');
        $unit = $this->input->post('unit');
        $price = $this->input->post('price');

        // Bangun query dasar
        $query = "select * from directlabour where true ";

        // Tambahkan kondisi pencarian jika ada
        if (!empty($description)) {
            $query .= " and description ilike '%$description%' ";
        }
        if (!empty($unit)) {
            $query .= " and unit ilike '%$unit%' ";
        }
        if (!empty($price)) {
            $query .= " and price::text ilike '%$price%' ";
        }

        // Ambil parameter sorting dari datagrid
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        if (!empty($sort)) {
            $query .= " order by $sort $order ";
        } else {
            $query .= " order by id desc ";
        }

        // Panggil model untuk eksekusi query dan kembalikan dalam format JSON
        echo $this->model_directlabour->get($query);
    }

    // Fungsi untuk menyimpan data baru
    function save() {
        $description = $this->input->post('description');
        $unit = $this->input->post('unit');
        $price = $this->input->post('price');

        $data = array(
            "description" => $description,
            "unit" => $unit,
            "price" => $price
        );

        if ($this->model_directlabour->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    // Fungsi untuk memperbarui data
    function update($id) {

        $description = $this->input->post('description');
        $unit = $this->input->post('unit');
        $price = $this->input->post('price');

         $data = array(
            "description" => $description,
            "unit" => $unit,
            "price" => $price
        );

        if ($this->model_directlabour->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    // Fungsi untuk menghapus data
    function delete() {
        $id = $this->input->post('id');
        if ($this->model_directlabour->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }
}