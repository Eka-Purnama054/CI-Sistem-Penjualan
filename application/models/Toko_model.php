<?php

class Toko_model extends CI_Model
{
    public function getToko()
    {
        $query = $this->db->get('toko');
        return $query;
    }

    public function updatetoko($id, $namatoko, $alamat, $notelp)
    {
        $data = array(
            'nama_toko' => $namatoko,
            'alamat_toko' => $alamat,
            'no_telp' => $notelp,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->update('toko', $data, array('id_toko' => $id));

        return true;
    }
}
