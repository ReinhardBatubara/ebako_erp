<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Perbaikan: Nama class diawali huruf besar sesuai standar CodeIgniter
class Directlabour extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            redirect('home/logout'); 
        }
        $this->load->model('model_directlabour');
        $this->load->model('model_user');
        $this->load->helper('url');
        $this->load->library('pagination');
    }

    // Fungsi helper untuk mengambil data dan paginasi
    private function _get_data($offset = 0) {
        $description = $this->input->post('description');
        
        $config['base_url'] = site_url('directlabour/search');
        // PERBAIKAN: Memanggil fungsi get_count() yang baru dari model
        $config['total_rows'] = $this->model_directlabour->get_count($description);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        
        // Menyiapkan data untuk view
        // PERBAIKAN: Memanggil fungsi get_data() yang baru dari model
        $data['directlabour'] = $this->model_directlabour->get_data($description, $config['per_page'], $offset);
        $data['pagination'] = $this->pagination->create_links();
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "directlabour"));

        return $data;
    }

    public function index() {
        $data = $this->_get_data(0);
        $this->load->view('directlabour/view', $data);
    }

    public function search($offset = 0) {
        $data = $this->_get_data($offset);
        $this->load->view('directlabour/search', $data);
    }

    public function add() {
        $this->load->model('model_unit');
        $data['unit'] = $this->model_unit->selectAll(); // Pastikan model & fungsi ini ada
        $this->load->view('directlabour/add', $data);
    }

    public function save() {
        $data = [
            'description' => $this->input->post('description'),
            'unit'        => $this->input->post('unitid'), // Sesuai ID di form
            'price'       => $this->input->post('price')
        ];
        $this->model_directlabour->insert($data);
        redirect('directlabour');
    }

    public function edit($id) {
        $this->load->model('model_unit');
        $data['unit'] = $this->model_unit->selectAll();
        // PERBAIKAN: Memanggil fungsi get_by_id() yang baru dari model
        $data['directlabour'] = $this->model_directlabour->get_by_id($id);
        $this->load->view('directlabour/edit', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $data = [
            'description' => $this->input->post('description'),
            'unit'        => $this->input->post('unitid'),
            'price'       => $this->input->post('price')
        ];
        $this->model_directlabour->update($id, $data);
        redirect('directlabour');
    }

    public function delete($id) {
        $this->model_directlabour->delete($id);
        redirect('directlabour');
    }
}
?>