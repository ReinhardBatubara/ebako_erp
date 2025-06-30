<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_item
 *
 * @author hp
 */
class model_item extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    // function get($query) {

    //     $page = $this->input->post('page');
    //     $rows = $this->input->post('rows');
    //     $data = "";
    //     if (!empty($page) && !empty($rows)) {
    //         $offset = ($page - 1) * $rows;
    //         $result = array();
    //         $result['total'] = $this->db->query($query)->num_rows();
    //         $row = array();
    //         $query .= " limit $rows offset $offset";
    //         $criteria = $this->db->query($query)->result();
    //         foreach ($criteria as $data) {
    //             $row[] = array(
    //                 'id' => $data->id,
    //                 'groupsid' => $data->groupid,
    //                 'groups' => $data->groups,
    //                 'partnumber' => $data->partnumber,
    //                 'description' => $data->description,
    //                 'images' => $data->images,
    //                 'reorderpoint' => $data->reorderpoint,
    //                 'isstock' => ($data->isstock == 't') ? "Yes" : "No",
    //                 'qccheck' => ($data->qccheck == 't') ? "Yes" : "No",
    //                 'yield' => $data->yield,
    //                 'category' => $data->category,
    //                 'category_f' => $data->category_f,
    //                 'unitcode' => $data->unitcode,
    //                 'stock' => $data->stock,
    //                 'moq' => $data->moq,
    //                 'lt' => $data->lt,
    //                 'active' => $data->active
    //             );
    //         }
    //         $result = array_merge($result, array('rows' => $row));
    //         $data = json_encode($result);
    //     } else {
    //         $criteria = $this->db->query($query)->result();
    //         foreach ($criteria as $data) {
    //             $row[] = array(
    //                 'id' => $data->id,
    //                 'groupid' => $data->groupid,
    //                 'groups' => $data->groups,
    //                 'partnumber' => $data->partnumber,
    //                 'description' => $data->description,
    //                 'images' => $data->images,
    //                 'reorderpoint' => $data->reorderpoint,
    //                 'isstock' => ($data->isstock == 't') ? "Yes" : "No",
    //                 'qccheck' => ($data->qccheck == 't') ? "Yes" : "No",
    //                 'yield' => $data->yield,
    //                 'category' => $data->category,
    //                 'category_f' => $data->category_f,
    //                 'unitcode' => $data->unitcode,
    //                 'stock' => $data->stock,
    //                 'moq' => $data->moq,
    //                 'lt' => $data->lt,
    //                 'active' => $data->active
    //             );
    //         }
    //         $data = json_encode($row);
    //     }
    //     return $data;
    // }

    function get($query) {
    $page = $this->input->post('page');
    $rows = $this->input->post('rows');
    $data = "";
    if (!empty($page) && !empty($rows)) {
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $query .= " LIMIT $rows OFFSET $offset";
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'partnumber' => $data->partnumber, 
                'description' => $data->descriptions,
                'rack' => $data->rack,
                'images' => $data->images,
                'reorderpoint' => $data->reorderpoint,
                'names' => $data->names,
                'isstock' => ($data->isstock == 't' || $data->isstock == true) ? "Yes" : "No",
                'price' => $data->price,
                'curr' => $data->curr,
                'moq' => $data->moq,
                'lt' => $data->lt,
                'expdate' => $data->expdate,
                'qccheck' => ($data->qccheck == 't' || $data->qccheck == true) ? "Yes" : "No",
                'woodid' => $data->woodid,
                'yield' => $data->yield,
                'costing_price' => $data->costing_price,
                'curr_costing_price' => $data->curr_costing_price,
                'price_in_base_unit' => $data->price_in_base_unit,
                'currency_price_base_unit' => $data->currency_price_base_unit,
                'updated_by' => $data->updated_by,
                'updated_time' => $data->updated_time,
                'available_status' => ($data->available_status == 't') ? "Yes" : "No",
                'smallestunit' => $data->smallestunit,
                'category' => $data->category
            );
        }
        $result = array_merge($result, array('rows' => $row));
        $data = json_encode($result);
    } else {
        $criteria = $this->db->query($query)->result();
        $row = array();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'partnumber' => $data->partnumber, 
                'description' => $data->descriptions,
                'rack' => $data->rack,
                'images' => $data->images,
                'reorderpoint' => $data->reorderpoint,
                'names' => $data->names,
                'isstock' => ($data->isstock == 't' || $data->isstock == true) ? "Yes" : "No",
                'price' => $data->price,
                'curr' => $data->curr,
                'moq' => $data->moq,
                'lt' => $data->lt,
                'expdate' => $data->expdate,
                'qccheck' => ($data->qccheck == 't' || $data->qccheck == true) ? "Yes" : "No",
                'woodid' => $data->woodid,
                'yield' => $data->yield,
                'costing_price' => $data->costing_price,
                'curr_costing_price' => $data->curr_costing_price,
                'price_in_base_unit' => $data->price_in_base_unit,
                'currency_price_base_unit' => $data->currency_price_base_unit,
                'updated_by' => $data->updated_by,
                'updated_time' => $data->updated_time,
                'available_status' => ($data->available_status == 't') ? "Yes" : "No",
                'smallestunit' => $data->smallestunit,
                'category' => $data->category
            );
        }
        $data = json_encode($row);
    }
    return $data;
}


    function get_base_unit() {
        
    }

    function getfordialog($page, $rows, $query) {
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $query .= " limit $rows offset $offset";
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'partnumber' => $data->partnumber,
                'description' => $data->description,
                'unitcode' => $data->unitcode,
                'group' => $data->groups,
                'category' => $data->category,
                'category_f' => $data->category_f,
            );
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function get_for_combo($query) {
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
        return $this->db->get('item')->result();
    }

    function getLastId() {
        $query = "select id from item order by id desc limit 1";
        $dt = $this->db->query($query)->row();
        return $dt->id;
    }

    function getNextId() {
        $query = "SELECT nextval('item_id_seq') as id";
        $dt = $this->db->query($query)->row();
        return $dt->id;
    }

    function insert($data) {
        return $this->db->insert('item', $data);
    }

    function update($data, $where) {
        return $this->db->update('item', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('item', $where);
    }

    function get_warehouse_combo($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'warehouseid' => $data->warehouseid,
                'warehousename' => $data->warehousename
            );
        }
        return json_encode($row);
    }

}
