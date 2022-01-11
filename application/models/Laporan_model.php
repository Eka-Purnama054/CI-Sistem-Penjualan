<?php

class Laporan_model extends CI_Model
{
    //laporan Barangtoko
    public function lbarangtoko($idtoko)
    {
        $this->db->select('*');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=barangtoko.`no_barang`');
        $this->db->join('toko', 'toko.id_toko=barangtoko.id_toko');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $query = $this->db->get_where('barangtoko', array('toko.id_toko' => $idtoko));
        return $query;
    }
    public function lbarangtokon($idtoko)
    {
        $q = $this->db->query("SELECT toko.nama_toko, toko.alamat_toko FROM barangtoko JOIN toko ON barangtoko.`id_toko`=toko.`id_toko` 
        JOIN baranggudang ON barangtoko.`no_barang`=baranggudang.`no_barang` WHERE toko.id_toko='$idtoko' group by toko.nama_toko");
        return $q->result();
    }

    //laporan baranggudang
    public function lapbaranggudang()
    {
        $this->db->select('*');
        $this->db->from('baranggudang');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get();
        return $query;
    }

    public function lapOrdertoko()
    {
        $idtoko = $this->session->userdata('idtoko');
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_orderbarang.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_orderbarang.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_orderbarang', array('toko.id_toko' => $idtoko));
        return $query;
    }
    public function lapOrdertokoprint($tgl, $sampai)
    {
        $idtoko = $this->session->userdata('idtoko');
        $where = "detail_orderbarang.id_toko='$idtoko' AND orderbarang.ket='gudang' AND orderbarang.tanggal_order BETWEEN '$tgl' AND '$sampai'";
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_orderbarang.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_orderbarang.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_orderbarang', $where);
        return $query;
    }

    public function getUser()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM toko where id_toko='$idtoko'");
        return $q->Result();
    }

    public function lreturtoko()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM detail_stokout JOIN stok_out ON stok_out.`kode_stokout`=detail_stokout.`kode_stokout`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokout.`no_barang`
        JOIN toko ON toko.`id_toko`=detail_stokout.`id_toko`
        WHERE stok_out.`id_toko`='$idtoko' AND stok_out.keterangan !='Toko'");
        return $q;
    }
    public function lpertglreturtoko($tgl, $sampai)
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM detail_stokout JOIN stok_out ON stok_out.`kode_stokout`=detail_stokout.`kode_stokout`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokout.`no_barang`
        JOIN toko ON toko.`id_toko`=detail_stokout.`id_toko`
        WHERE stok_out.`id_toko`='$idtoko' AND stok_out.keterangan !='Toko' AND stok_out.tgl_stokout BETWEEN '$tgl' AND '$sampai'");
        return $q;
    }

    public function laptokopertgl($tgl, $sampai)
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM detail_transaksi JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang`
        JOIN toko ON toko.`id_toko` = detail_transaksi.`id_toko`
         WHERE detail_transaksi.id_toko='$idtoko' AND tanggal BETWEEN '$tgl' AND '$sampai'");
        return $q;
    }

    public function totpentokopertgl($tgl, $sampai)
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT SUM(grandtotal) AS grandtotal, SUM(diskon) AS diskon FROM detail_transaksi
        JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN toko ON toko.`id_toko`=detail_transaksi.`id_toko`
        WHERE toko.`id_toko`='$idtoko' AND tanggal BETWEEN '$tgl' AND '$sampai'");
        return $q->result();
    }

    public function laptokoperkasir($tgl, $sampai, $user)
    {
        $q = $this->db->query("SELECT * FROM detail_transaksi JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang`
        JOIN toko ON toko.`id_toko` = detail_transaksi.`id_toko`
         WHERE transaksi.username='$user' AND transaksi.tanggal BETWEEN '$tgl' AND '$sampai'");
        return $q;
    }

    public function totpentokoperkasir($tgl, $sampai, $user)
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT SUM(grandtotal) AS grandtotal, SUM(diskon) AS diskon FROM detail_transaksi
        JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN toko ON toko.`id_toko`=detail_transaksi.`id_toko`
        WHERE transaksi.username='$user' AND tanggal BETWEEN '$tgl' AND '$sampai'");
        return $q->result();
    }

    //data transaksi /toko
    public function datatransaksi()
    {
        $idtoko = $this->session->userdata('idtoko');
        $this->db->select('*');
        $this->db->join('transaksi', 'transaksi.`no_faktur`=detail_transaksi.`no_faktur`');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_transaksi.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_transaksi.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_transaksi', array('toko.id_toko' => $idtoko));
        return $query;
    }

    //laporan transaksi penjualan
    public function dttransaksiadmin()
    {
        $this->db->select('*');
        $this->db->from('detail_transaksi');
        $this->db->join('transaksi', 'transaksi.`no_faktur`=detail_transaksi.`no_faktur`');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_transaksi.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_transaksi.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get();
        return $query;
    }
    public function laptokopertgladmin($tgl, $sampai, $idtoko)
    {
        $where = "detail_transaksi.id_toko='$idtoko' AND tanggal BETWEEN '$tgl' AND '$sampai'";
        $this->db->select('*');
        $this->db->join('transaksi', 'transaksi.`no_faktur`=detail_transaksi.`no_faktur`');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_transaksi.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_transaksi.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_transaksi', $where);
        return $query;
    }
    public function totpenadmin($tgl, $sampai, $idtoko)
    {
        $q = $this->db->query("SELECT SUM(grandtotal) AS grandtotal, SUM(diskon) AS diskon FROM detail_transaksi
        JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN toko ON toko.`id_toko`=detail_transaksi.`id_toko`
        WHERE toko.`id_toko`='$idtoko' AND tanggal BETWEEN '$tgl' AND '$sampai'");
        return $q->result();
    }

    //Laporan
    public function nama($tgl, $sampai, $idtoko)
    {
        $q = $this->db->query("SELECT toko.nama_toko, toko.alamat_toko FROM detail_transaksi
        JOIN transaksi ON transaksi.`no_faktur`=detail_transaksi.`no_faktur`
        JOIN toko ON toko.`id_toko`=detail_transaksi.`id_toko`
        WHERE toko.`id_toko`='$idtoko' AND tanggal BETWEEN '$tgl' AND '$sampai' group by toko.nama_toko");
        return $q->result();
    }

    public function lretursuplier()
    {
        $q = $this->db->query("SELECT * FROM detail_returgudang JOIN returgudang ON returgudang.`no_retur`=detail_returgudang.`no_retur`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_returgudang.`no_barang`
        JOIN suplier ON suplier.`id_suplier`=detail_returgudang.`id_suplier`");
        return $q;
    }

    public function lretursupliertgl($tgl, $sampai)
    {
        $q = $this->db->query("SELECT * FROM detail_returgudang JOIN returgudang ON returgudang.`no_retur`=detail_returgudang.`no_retur`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_returgudang.`no_barang`
        JOIN suplier ON suplier.`id_suplier`=detail_returgudang.`id_suplier` WHERE returgudang.tanggal_retur BETWEEN '$tgl' AND '$sampai'");
        return $q;
    }

    //returtoko
    public function datareturtoko()
    {
        $this->db->select('*');
        $this->db->join('stok_out', 'stok_out.`kode_stokout`=detail_stokout.`kode_stokout`');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_stokout.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_stokout.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get('detail_stokout');
        return $query;
    }

    public function cetakdatareturtoko($tgl, $sampai, $idtoko)
    {
        $where = "stok_out.tgl_stokout BETWEEN '$tgl' AND '$sampai' AND toko.id_toko='$idtoko'";
        $this->db->select('*');
        $this->db->join('stok_out', 'stok_out.`kode_stokout`=detail_stokout.`kode_stokout`');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_stokout.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_stokout.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_stokout', $where);
        return $query;
    }

    public function cetakgrandtotal($tgl, $sampai)
    {
        $where = "stok_out.tgl_stokout BETWEEN '$tgl' AND '$sampai'";
        $this->db->select_sum('total');
        $query = $this->db->get_where('stok_out', $where);
        return $query->result();
    }

    public function cetaknoreturtoko($id)
    {
        $where = "stok_out.kode_stokout='$id'";
        $this->db->select('*');
        $this->db->join('stok_out', 'stok_out.`kode_stokout`=detail_stokout.`kode_stokout`');
        $this->db->join('users', 'users.`username`=stok_out.`username`');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_stokout.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_stokout.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_stokout', $where);
        return $query;
    }

    //cetakstruk
    public function cetakstruktoko($nofaktur)
    {
        $this->db->select('*');
        $this->db->join('transaksi', 'transaksi.`no_faktur`=detail_transaksi.`no_faktur`');
        $this->db->join('users', 'users.`username`=transaksi.`username`');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_transaksi.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_transaksi.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $query = $this->db->get_where('detail_transaksi', array('transaksi.`no_faktur`' => $nofaktur));
        return $query;
    }
}
