<?php

class Satuan_model extends CI_Model
{
    public function getSatuan()
    {
        $query = $this->db->get('satuan');
        return $query;
    }

    public function update($namasatuan, $id)
    {
        $data = array(
            'nama_satuan' => $namasatuan,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->update('satuan', $data, array('id_satuan' => $id));
        return true;
    }
}
