<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_position
 *
 * @author hp
 */
class model_position extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

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
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function selectAllResult() {
        return $this->db->get('position')->result();
    }

    function insert($data) {
        return $this->db->insert('position', $data);
    }

    function update($data, $where) {
        return $this->db->update('position', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('position', $where);
    }

}

?>
