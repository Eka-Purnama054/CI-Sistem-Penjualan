<?php

class Retur_model extends CI_Model
{
    public function returgudang()
    {
        $q = $this->db->query("SELECT * FROM detail_returgudang 
        JOIN returgudang ON returgudang.`no_retur`=detail_returgudang.`no_retur`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_returgudang.`no_barang`
        JOIN suplier ON suplier.`id_suplier`=detail_returgudang.`id_suplier`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna` 
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`");
        return $q;
    }

    public function cetaknomorreturgudang($id)
    {
        $q = $this->db->query("SELECT * FROM detail_returgudang 
        JOIN returgudang ON returgudang.`no_retur`=detail_returgudang.`no_retur`
        JOIN users ON users.`username`=returgudang.`username`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_returgudang.`no_barang`
        JOIN suplier ON suplier.`id_suplier`=detail_returgudang.`id_suplier`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna` 
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        WHERE returgudang.no_retur='$id'");
        return $q;
    }

    //laporan retur pertanggal
    public function cetakpertanggal($tgl, $sampai)
    {
        $q = $this->db->query("SELECT * FROM detail_returgudang 
        JOIN returgudang ON returgudang.`no_retur`=detail_returgudang.`no_retur`
        JOIN users ON users.`username`=returgudang.`username`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_returgudang.`no_barang`
        JOIN suplier ON suplier.`id_suplier`=detail_returgudang.`id_suplier`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna` 
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        WHERE returgudang.tanggal_retur BETWEEN '$tgl' AND '$sampai'");
        return $q;
    }

    public function sumtotal($tgl, $sampai)
    {
        $q = $this->db->query("SELECT SUM(total) as total FROM returgudang 
        WHERE tanggal_retur BETWEEN '$tgl' AND '$sampai'");
        return $q;
    }
}
