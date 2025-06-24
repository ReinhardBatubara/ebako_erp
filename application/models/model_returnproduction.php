<?php

class Model_returnproduction extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi dasar CRUD
    public function insert($data) {
        return $this->db->insert('returnproduction', $data);
    }

    public function update($data, $where) {
        return $this->db->update('returnproduction', $data, $where);
    }

    public function delete($where) {
        return $this->db->delete('returnproduction', $where);
    }
    
    public function insert_receive($data) {
        // Ini adalah contoh, sesuaikan dengan nama tabel receive Anda
        return $this->db->insert('returnproduction_receive', $data);
    }

    // Fungsi untuk mendapatkan detail data untuk keperluan Edit, Receive, dan Print
    public function select_by_id($id) {
        $this->db->select("
            rp.*, 
            emp.name as name_return_by, 
            dept.name as department_name, 
            item.partnumber as item_code, 
            item.descriptions as item_description, 
            unit.codes as unit_code
        ");
        $this->db->from("returnproduction rp");
        $this->db->join("employee emp", "rp.return_by = emp.id", "left");
        $this->db->join("item", "rp.itemid = item.id", "left");
        $this->db->join("unit", "rp.unitid = unit.id", "left");
        $this->db->join("department dept", "rp.departmentid = dept.id", "left");
        $this->db->where('rp.id', $id);
        return $this->db->get()->row();
    }

    // Fungsi untuk membuat nomor otomatis
    public function get_number() {
        $time = strtotime("now");
        $y = date('y', $time);
        $m = date('m', $time);
        $d = date('d', $time);
        $this->db->select("right(returnproduction_no,4) as counter");
        $this->db->where("date_part('month',date) = '$m' and date_part('year',date) = '" . date('Y', $time) . "'");
        $this->db->order_by("id", "desc");
        $q = $this->db->get("returnproduction");
        $counter = "0001";
        if ($q->num_rows() > 0) {
            $row = $q->row();
            $counter = str_pad($row->counter + 1, 4, '0', STR_PAD_LEFT);
        }
        return "RTP" . $y . $m . $d . $counter;
    }
}
