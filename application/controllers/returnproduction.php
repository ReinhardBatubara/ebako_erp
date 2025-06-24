<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returnproduction extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Muat model-model yang diperlukan di awal
        $this->load->model('model_returnproduction');
        $this->load->model('model_user');
        $this->load->model('model_item');
        $this->load->model('model_unit');
        $this->load->model('model_department');
        $this->load->model('model_employee');
    }

    /**
     * Menampilkan halaman utama Return Production.
     * Fungsi ini memuat kerangka view utama dan data awal.
     */
    public function index() {
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "returnproduction"));
        $this->load->view('returnproduction/view', $data);
    }

    /**
     * Menyediakan data dalam format JSON untuk EasyUI Datagrid.
     * Fungsi ini menangani pencarian, sorting, dan paginasi.
     */
    public function get() {
        // Ambil parameter dari datagrid
        $returnproduction_no = $this->input->post('returnproduction_no');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $item_desc = $this->input->post('item_description');
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        // Gunakan Query Builder untuk keamanan dan kemudahan
        $this->db->select("
            rp.id,
            rp.returnproduction_no,
            rp.date,
            emp.name as name_return_by,
            dept.name as department_name,
            item.partnumber as item_code,
            item.descriptions as item_description,
            unit.codes as unit_code,
            rp.qty,
            rp.remark,
            rp.is_received
        ", FALSE);
        $this->db->from("returnproduction rp");
        $this->db->join("employee emp", "rp.return_by = emp.id", "left");
        $this->db->join("item", "rp.itemid = item.id", "left");
        $this->db->join("unit", "rp.unitid = unit.id", "left");
        $this->db->join("department dept", "rp.departmentid = dept.id", "left");

        // Terapkan filter pencarian
        if (!empty($returnproduction_no)) {
            $this->db->like('rp.returnproduction_no', $returnproduction_no);
        }
        if (!empty($start_date)) {
            $this->db->where('rp.date >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('rp.date <=', $end_date);
        }
        if (!empty($item_desc)) {
            $this->db->group_start();
            $this->db->like('item.partnumber', $item_desc);
            $this->db->or_like('item.descriptions', $item_desc);
            $this->db->group_end();
        }

        // Duplikasi query untuk menghitung total baris
        $total_query = clone $this->db;
        $total = $total_query->count_all_results();

        // Terapkan sorting dengan aman
        $allowed_sorts = ['id', 'returnproduction_no', 'date', 'name_return_by', 'item_code'];
        if (in_array($sort, $allowed_sorts) && in_array(strtolower($order), ['asc', 'desc'])) {
            $this->db->order_by($sort, $order);
        } else {
            $this->db->order_by('rp.id', 'desc');
        }
        
        // Terapkan paginasi
        $page = $this->input->post('page', TRUE) ? (int)$this->input->post('page', TRUE) : 1;
        $rows = $this->input->post('rows', TRUE) ? (int)$this->input->post('rows', TRUE) : 50;
        $offset = ($page - 1) * $rows;
        $this->db->limit($rows, $offset);

        // Eksekusi query final
        $query = $this->db->get();

        // Format hasil ke dalam format yang dibutuhkan EasyUI
        echo json_encode(['total' => $total, 'rows' => $query->result()]);
    }

    /**
     * Menyimpan data Return Production baru.
     */
    public function save() {
        $data = [
            "returnproduction_no" => $this->model_returnproduction->get_number(),
            "date" => $this->input->post('date'),
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "qty" => $this->input->post('qty'),
            "remark" => $this->input->post('remark'),
            "return_by" => $this->session->userdata('id'),
            "departmentid" => $this->session->userdata('department')
        ];
        if ($this->model_returnproduction->insert($data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['msg' => 'Failed to save data.']);
        }
    }

    /**
     * Memperbarui data Return Production.
     */
    public function update($id) {
        $data = [
            "date" => $this->input->post('date'),
            "itemid" => $this->input->post('itemid'),
            "unitid" => $this->input->post('unitid'),
            "qty" => $this->input->post('qty'),
            "remark" => $this->input->post('remark')
        ];
        if ($this->model_returnproduction->update($data, ["id" => $id])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['msg' => 'Failed to update data.']);
        }
    }

    /**
     * Menghapus data Return Production.
     */
    public function delete() {
        $id = $this->input->post('id');
        if ($this->model_returnproduction->delete(["id" => $id])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['msg' => 'Failed to delete data.']);
        }
    }

    /**
     * Menampilkan view untuk dialog "Receive".
     */
    public function receive($id) {
        $data['returnproduction'] = $this->model_returnproduction->select_by_id($id);
        $this->load->view('returnproduction/receive', $data);
    }
    
    /**
     * Menyimpan data penerimaan (receive).
     */
    public function save_receive() {
        $data = [
            'returnproductionid' => $this->input->post('returnproductionid'),
            'date' => $this->input->post('date'),
            'qty' => $this->input->post('qty'),
            'remark' => $this->input->post('remark'),
            'receive_by' => $this->session->userdata('id')
        ];

        if ($this->model_returnproduction->insert_receive($data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['msg' => 'Failed to save receive data.']);
        }
    }

    /**
     * Menampilkan halaman print.
     */
    public function prints($id) {
        $data['returnproduction'] = $this->model_returnproduction->select_by_id($id);
        $data['company'] = $this->model_company->getDetail(); // Asumsi ada model company
        $this->load->view('returnproduction/print', $data);
    }
}
