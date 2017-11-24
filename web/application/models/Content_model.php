<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Content_model extends CI_Model {

    private $table = "tbl_contents";

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */
    function get_row($id)
    {
        $query = $this->db->get_where($this->table, array('tc_id' => $id));
        return $query->result();
    }
    
    function get_rows()
    {
        $query = $this->db->get_where($this->table);
        return $query->result();
    }

    function insert($data) {
        // Inserting into your table
        $this->db->insert($this->table, $data);
        $idOfInsertedData = $this->db->insert_id();
        return $idOfInsertedData;
    }

    function delete($id){
        $this->db->where('tc_id', $id);
        $this->db->delete($this->table); 
    }

    function update($data) {
        $this->db->where('tc_id',$data['tc_id']);
        $this->db->update($this->table, $data);
    }
    function get_content($type)
    {
        $sql = "SELECT tc_title, tc_content FROM tbl_contents WHERE tc_type=" . $this->db->escape($type);
        $query = $this->db->query($sql);
        $result = $query->result();

        if (@$result[0])
            return array('title' => $result[0]->{'tc_title'}, 'content' => $result[0]->{'tc_content'});
        else 
            return array('title' => '', 'content' => '');
    }

    function is_existing_type($type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('tc_type', $type);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    function update_by_type($data) {
        $this->db->where('tc_type',$data['tc_type']);
        $this->db->update($this->table, $data);
    }

    function save($item) {
        // $item = array(
        //     'tc_type'   => $type,
        //     'tc_title'  => $title,
        //     'tc_content'=> $content
        // );
        if ($this->is_existing_type($item['tc_type'])) {
            $this->update_by_type($item);
        } else {
            $this->insert($item);
        }
    }
}