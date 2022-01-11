<?php

class Barangtoko_model extends CI_Model
{
    public function GetBarangtoko($idtoko)
    {
        $q = $this->db->query("SELECT * FROM barangtoko JOIN toko ON toko.id_toko=barangtoko.id_toko 
        JOIN baranggudang ON baranggudang.`no_barang`=barangtoko.`no_barang` 
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna` 
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        where toko.id_toko='$idtoko'");
        return $q;
    }
    public function bartoko()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM barangtoko JOIN toko ON toko.id_toko=barangtoko.id_toko 
        JOIN baranggudang ON baranggudang.`no_barang`=barangtoko.`no_barang`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna` 
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        WHERE toko.id_toko='$idtoko'");
        return $q;
    }
}
