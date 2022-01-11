<?php

class Kategoriwarna_model extends CI_Model
{
    public function GetKategoriWarna()
    {
        $query = $this->db->get('kategori_warna');
        return $query;
    }

    public function updatekategori($id, $kategori)
    {
        $data = array(
            'nama_warna' => $kategori,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->db->update('kategori_warna', $data, array('id_warna' => $id));
        return true;
    }
}
