<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends CI_Model {
    //SELECT `tb_id`, `tb_image`, `tb_title`, `tb_desc`, `tb_url` FROM `tbl_bank` WHERE 1
    private $table = "tbl_bank";

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */
    function get_row($id)
    {
        $query = $this->db->get_where($this->table, array('tb_id' => $id));
        return $query->result();
    }
    
    function get_rows($per_page, $offset)
    {
        $query = $this->db->get($this->table, $per_page, $offset);

        return $query->result();
    }

    function get_search_rows($search, $per_page, $offset)
    {
        $sql = "SELECT * FROM `tbl_bank` WHERE ";
        $sql .= " tb_title LIKE '%" . $search . "%' ";
        $sql .= " OR tb_desc LIKE '%" . $search . "%' ";
        $sql .= " OR tb_url LIKE '%" . $search . "%' ";
        $sql .= " OR tb_image LIKE '%" . $search . "%' ";
        $sql .= " LIMIT " . $offset .", " . $per_page;
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    function get_search_count($search)
    {
        $sql = "SELECT count(*) AS total FROM `tbl_bank` WHERE ";
        $sql .= " tb_title LIKE '%" . $search . "%' ";
        $sql .= " OR tb_desc LIKE '%" . $search . "%' ";
        $sql .= " OR tb_url LIKE '%" . $search . "%' ";
        $sql .= " OR tb_image LIKE '%" . $search . "%' ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->{'total'};
    }

    function insert($data) {
        // Inserting into your table
        $this->db->insert($this->table, $data);
        $idOfInsertedData = $this->db->insert_id();
        return $idOfInsertedData;
    }

    function update($data) {
        $update_data = array(
                'tb_id' => $_POST['id'],
                'tb_title' => $_POST['title'], 
                'tb_desc' => $_POST['description'], 
                'tb_url' => $_POST['link']
            );
        // Inserting into your table
        $sql = "UPDATE tbl_bank SET ";
        $sql .= " tb_title=" . $this->db->escape($data['tb_title']);
        $sql .= ", tb_desc=" . $this->db->escape($data['tb_desc']);
        $sql .= ", tb_url=" . $this->db->escape($data['tb_url']);
        $sql .= " WHERE tb_id=" . $this->db->escape($data['tb_id']);

        $this->db->query($sql);
    }

    function delete($id){
        $this->db->where('tb_id', $id);
        $this->db->delete($this->table); 
    }

    function get_total_count()
    {
        $sql = "SELECT count(*) AS total FROM tbl_bank";
        $res = $this->db->query($sql);
        $row = $res->row();
        return $row->{'total'};
    }

    function get_images_info($quote_names) {
	if (count($quote_names) == 0)
		return null;

        $sql = "SELECT * FROM tbl_bank";
        $sql .= " WHERE tb_image IN (" . implode(",",$quote_names) . ");";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function is_existing($data) {
        // $data = array(
        //     'tb_image' => $filename,
        //     'tb_title' => $title, 
        //     'tb_desc' => $description, 
        //     'tb_url' => $link
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('tb_title', $this->db->escape($data['tb_title']));
        $this->db->where('tb_desc', $this->db->escape($data['tb_desc']));
        $this->db->where('tb_url', $this->db->escape($data['tb_url']));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else
            return false;
    }
}
