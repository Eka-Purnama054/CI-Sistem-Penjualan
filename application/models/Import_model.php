<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model
{

    public function insert($data)
    {
        $insert = $this->db->insert_batch('baranggudang', $data);
        if ($insert) {
            return true;
        }
    }
}
