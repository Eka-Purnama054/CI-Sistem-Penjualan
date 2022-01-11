<?php

class Lpengiriman_model extends CI_Model
{
    public function ambilstokintoko()
    {
        $this->db->select('*');
        $this->db->join('stok_in', 'stok_in.no_stokin = detail_stokin.no_stokin');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokin.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_stokin.id_toko');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get('detail_stokin');
        return $query;
    }

    public function kirimtokopertanggal($idtoko, $tgl, $sampai)
    {
        $where = "stok_in.id_toko='$idtoko' AND tgl_stokin BETWEEN '$tgl' AND '$sampai'";
        $this->db->select('*');
        $this->db->join('stok_in', 'stok_in.no_stokin = detail_stokin.no_stokin');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokin.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_stokin.id_toko');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_stokin', $where);
        return $query;
    }

    public function sumtotal($tgl, $sampai)
    {
        $where = "tgl_stokin BETWEEN '$tgl' AND '$sampai'";
        $this->db->select_sum('total');
        $query = $this->db->get_where('stok_in', $where);
        return $query;
    }

    public function cetaknokirimtoko($id)
    {
        $where = "detail_stokin.no_stokin='$id'";
        $this->db->select('*');
        $this->db->join('stok_in', 'stok_in.no_stokin = detail_stokin.no_stokin');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokin.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_stokin.id_toko');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('users', 'users.username = stok_in.username');
        $query = $this->db->get_where('detail_stokin', $where);
        return $query;
    }

    public function getstokingudang()
    {
        $this->db->select('*');
        $this->db->join('stokingudang', 'stokingudang.kode_stokin = detail_stokingudang.kode_stokin');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokingudang.no_barang');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('users', 'users.username = stokingudang.username');
        $query = $this->db->get_where('detail_stokingudang');
        return $query;
    }

    public function pertanggalkirimsuplier($idsup, $tgl, $sampai)
    {
        $where = "suplier.id_suplier='$idsup' AND tanggal BETWEEN '$tgl' AND '$sampai'";
        $this->db->select('*');
        $this->db->join('stokingudang', 'stokingudang.kode_stokin = detail_stokingudang.kode_stokin');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokingudang.no_barang');
        $this->db->join('suplier', 'suplier.id_suplier = detail_stokingudang.id_suplier');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('users', 'users.username = stokingudang.username');
        $query = $this->db->get_where('detail_stokingudang', $where);
        return $query;
    }

    public function sumtotalgudang($tgl, $sampai)
    {
        $where = "tanggal BETWEEN '$tgl' AND '$sampai'";
        $this->db->select_sum('total');
        $query = $this->db->get_where('stokingudang', $where);
        return $query;
    }

    public function cetaksjsuplier($id)
    {
        $where = "stokingudang.kode_stokin='$id'";
        $this->db->select('*');
        $this->db->join('stokingudang', 'stokingudang.kode_stokin = detail_stokingudang.kode_stokin');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokingudang.no_barang');
        $this->db->join('suplier', 'suplier.id_suplier = detail_stokingudang.id_suplier');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('users', 'users.username = stokingudang.username');
        $query = $this->db->get_where('detail_stokingudang', $where);
        return $query;
    }
}
