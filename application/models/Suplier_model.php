<?php

class Suplier_model extends CI_Model
{
    public function getSuplier()
    {
        $q = $this->db->query("SELECT * FROM suplier");
        return $q;
    }

    public function updatesuplier($id, $nama, $alamat, $telp)
    {
        $data = array(
            'nama_suplier' => $nama,
            'alamat_suplier' => $alamat,
            'no_telp' => $telp,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->update('suplier', $data, array('id_suplier' => $id));
        return true;
    }
}
