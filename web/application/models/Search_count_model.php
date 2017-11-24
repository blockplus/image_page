<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search_count_model extends CI_Model {

    private $table = "tbl_search_count";

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */
    
    function get_row()
    {
        $query = $this->db->get_where($this->table);
        $result = $query->result();
        if (count(@$result) > 0) {
            return $result[0];
        }
        else 
            return null;
    }

    function increase_count() {
        $row = $this->get_row();
        if (!$row) {
            $this->db->insert($this->table, array('tsc_count'=>1));
        }
        else {
            $count = $row->{'tsc_count'}+1;
            // Inserting into your table
            $sql = "UPDATE tbl_search_count SET ";
            $sql .= " tsc_count=" . $this->db->escape($count);
            $sql .= " WHERE tsc_id=" . $this->db->escape($row->{'tsc_id'});

            $this->db->query($sql);
        }
    }

    function get_count()
    {
        $row = $this->get_row();
        if (!$row) {
            $this->db->insert($this->table, array('tsc_count'=>0));
            return 0;
        } else {
            return $row->{'tsc_count'};
        }
    }
}