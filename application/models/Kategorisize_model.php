<?php

class Kategorisize_model extends CI_Model
{
    public function getkategorisize()
    {
        $query = $this->db->get('kategori_size');
        return $query;
    }

    public function updatesize($idsize, $namasize)
    {
        $data = array(
            'nama_size' => $namasize,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->db->update('kategori_size', $data, array('id_size' => $idsize));
        return true;
    }

    public function kodesize()
    {
        $this->db->select('RIGHT(id_size,1) as id_size', FALSE);
        $this->db->order_by('kategori_size.id_size', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('kategori_size');      //cek dulu apakah sudah ada kode di tabel.    
        if ($query->num_rows() > 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->id_size) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 1, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = $kodemax;
        return $kodejadi;
    }
}
