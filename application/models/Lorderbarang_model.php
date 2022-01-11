<?php

class Lorderbarang_model extends CI_Model
{
    //gudang
    public function getordergudang()
    {
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_orderbarang.no_barang');
        $this->db->join('suplier', 'suplier.id_suplier = detail_orderbarang.id_suplier');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $query = $this->db->get('detail_orderbarang');
        return $query;
    }

    public function getlordergudang($tgl, $sampai)
    {
        $where = "orderbarang.ket='suplier' AND orderbarang.tanggal_order BETWEEN '$tgl' AND '$sampai'";
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_orderbarang.no_barang');
        $this->db->join('suplier', 'suplier.id_suplier = detail_orderbarang.id_suplier');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $query = $this->db->get_where('detail_orderbarang', $where);
        return $query;
    }

    public function sumordergudang($tgl, $sampai)
    {
        $where = "orderbarang.ket='suplier' AND orderbarang.tanggal_order BETWEEN '$tgl' AND '$sampai'";
        $this->db->select_sum('total_order');
        $query = $this->db->get_where('orderbarang', $where);
        return $query;
    }

    public function cetakpogudang($id)
    {
        $where = "orderbarang.kode_order='$id'";
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_orderbarang.no_barang');
        $this->db->join('suplier', 'suplier.id_suplier = detail_orderbarang.id_suplier');
        $this->db->join('users', 'users.username = detail_orderbarang.username');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $query = $this->db->get_where('detail_orderbarang', $where);
        return $query;
    }

    //toko
    public function lordertoko()
    {
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_orderbarang.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_orderbarang.id_toko');
        $this->db->join('users', 'users.username = detail_orderbarang.username');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $query = $this->db->get('detail_orderbarang');
        return $query;
    }

    public function lordertokotgl($idtoko, $tgl, $sampai)
    {
        $where = "detail_orderbarang.id_toko='$idtoko' AND orderbarang.tanggal_order BETWEEN '$tgl' AND '$sampai'";
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_orderbarang.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_orderbarang.id_toko');
        $this->db->join('users', 'users.username = detail_orderbarang.username');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $query = $this->db->get_where('detail_orderbarang', $where);
        return $query;
    }

    public function sumordertoko($idtoko, $tgl, $sampai)
    {
        $where = "orderbarang.tanggal_order BETWEEN '$tgl' AND '$sampai'";
        $this->db->select_sum('total_order');
        $query = $this->db->get_where('orderbarang', $where);
        return $query;
    }

    public function cetakpotoko($idtoko)
    {
        $where = "detail_orderbarang.kode_order='$idtoko'";
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_orderbarang.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_orderbarang.id_toko');
        $this->db->join('users', 'users.username = detail_orderbarang.username');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $query = $this->db->get_where('detail_orderbarang', $where);
        return $query;
    }
}
