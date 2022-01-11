<?php

class Barang_model extends CI_Model
{
    public function getbarangtoko()
    {
        $q = $this->db->query("SELECT * FROM baranggudang");
        return $q;
    }

    public function toko()
    {
        $q = $this->db->query("SELECT * FROM toko");
        return $q;
    }

    public function detail($id)
    {
        $q = $this->db->query("SELECT * FROM baranggudang 
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna`
        JOIN satuan ON satuan.`id_satuan`=baranggudang.`id_satuan` 
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        WHERE baranggudang.no_barang='$id'");
        return $q;
    }

    public function grafikstok($id)
    {
        $q = $this->db->query("SELECT toko.nama_toko, barangtoko.stok_toko FROM barangtoko JOIN baranggudang ON baranggudang.`no_barang`=barangtoko.`no_barang`
        JOIN toko ON toko.`id_toko`=barangtoko.`id_toko` WHERE baranggudang.no_barang='$id'");
        return $q->result();
    }

    //penjualan
    public function day($id)
    {
        $q = $this->db->query("SELECT toko.nama_toko, SUM(detail_transaksi.`jumlah`) AS jumlah FROM detail_transaksi
        JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN toko ON toko.id_toko=detail_transaksi.`id_toko`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang`
        WHERE DATE(transaksi.`tanggal`)=DATE(NOW()) AND baranggudang.`no_barang`='$id'");
        return $q->result();
    }

    public function Month($id)
    {
        $q = $this->db->query("SELECT DATE_FORMAT(transaksi.`tanggal`,'%M') AS tanggal,toko.nama_toko, SUM(detail_transaksi.`jumlah`) AS jumlah FROM detail_transaksi
        JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN toko ON toko.id_toko=detail_transaksi.`id_toko`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang`
        WHERE YEAR(transaksi.`tanggal`)=YEAR(NOW()) AND baranggudang.`no_barang`='$id' GROUP BY MONTH(transaksi.`tanggal`)");
        return $q->result();
    }

    public function year($id)
    {
        $q = $this->db->query("SELECT YEAR(transaksi.`tanggal`) AS tanggal,toko.nama_toko, SUM(detail_transaksi.`jumlah`) AS jumlah FROM detail_transaksi
        JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN toko ON toko.id_toko=detail_transaksi.`id_toko`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang`
        WHERE baranggudang.`no_barang`='$id' GROUP BY YEAR(transaksi.`tanggal`)");
        return $q->result();
    }

    //baranglaku
    public function baranglaku($id)
    {
        $q = $this->db->query("SELECT toko.nama_toko, baranggudang.nama_barang,SUM(detail_transaksi.jumlah) AS jumlah FROM detail_transaksi
        JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang` 
        JOIN toko ON toko.`id_toko`=detail_transaksi.`id_toko` WHERE baranggudang.`no_barang`='$id'
        GROUP BY baranggudang.no_barang, toko.`id_toko` ORDER BY jumlah DESC");
        return $q->result();
    }
}
