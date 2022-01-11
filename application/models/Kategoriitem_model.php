<?php

class Kategoriitem_model extends CI_Model
{
    public function getkategoriitem()
    {
        $query = $this->db->get('kategori_item');
        return $query;
    }

    public function updateitem($iditem, $namaitem)
    {
        $data = array(
            'nama_item' => $namaitem,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->db->update('kategori_item', $data, array('kode_item' => $iditem));
        return true;
    }

    public function kodeitem()
    {
        $this->db->select('RIGHT(kode_item,1) as kode_item', FALSE);
        $this->db->order_by('kategori_item.kode_item', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('kategori_item');      //cek dulu apakah sudah ada kode di tabel.    
        if ($query->num_rows() > 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode_item) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 1, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = $kodemax;
        return $kodejadi;
    }
}
