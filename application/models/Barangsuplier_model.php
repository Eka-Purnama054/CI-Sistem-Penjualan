<?php

class Barangsuplier_model extends CI_Model
{
    public function ambilbarangsuplier()
    {
        $idsup = $this->session->userdata('idsup');
        $this->db->select('*');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('baranggudang', array('suplier.id_suplier' => $idsup));
        return $query;
    }

    public function ambilbarangsuplierid($id)
    {
        $idsup = $this->session->userdata('idsup');
        $this->db->select('*');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('baranggudang', array('suplier.id_suplier' => $idsup, 'baranggudang.no_barang' => $id));
        return $query;
    }
}
