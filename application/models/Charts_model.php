<?php
class Charts_model extends CI_Model
{
    public function penjualantoko()
    {
        $q = $this->db->query("SELECT toko.nama_toko,SUM(transaksi.grandtotal) AS grandtotal FROM transaksi
        JOIN toko ON transaksi.id_toko=toko.id_toko WHERE DATE(transaksi.`tanggal`)=DATE(NOW()) GROUP BY toko.id_toko");
        return $q->Result();
    }

    public function cbaranggudang()
    {
        $query = $this->db->get('baranggudang');
        return $query->Result();
    }
    public function totpenjualantoko()
    {
        $q = $this->db->query("SELECT SUM(grandtotal) AS grandtotal FROM transaksi");
        return $q->Result();
    }
    public function totpenjualantokoo()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT SUM(grandtotal) AS grandtotal FROM transaksi where id_toko='$idtoko'");
        return $q->Result();
    }

    public function totalproduct()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT COUNT(no_barang) AS no_barang FROM barangtoko WHERE id_toko='$idtoko'");
        return $q->Result();
    }

    public function datareturtoko()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT COUNT(kode_stokout) AS kode_stokout 
        FROM stok_out WHERE id_toko='$idtoko' AND keterangan='Retur Ke Toko' OR keterangan='Retur Ke Gudang'");
        return $q->Result();
    }

    public function penjhariini()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT SUM(grandtotal) AS grandtotal FROM transaksi where id_toko='$idtoko' and DATE(tanggal)=DATE(NOW())");
        return $q->Result();
    }

    public function totalpenjhariini()
    {
        $q = $this->db->query("SELECT SUM(grandtotal) AS grandtotal FROM transaksi WHERE DATE(tanggal)=DATE(NOW())");
        return $q->Result();
    }

    public function totordert()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT COUNT(orderbarang.kode_order) as kode_order FROM detail_orderbarang JOIN orderbarang ON orderbarang.`kode_order`=detail_orderbarang.`kode_order`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_orderbarang.`no_barang`
        JOIN toko ON toko.`id_toko`=detail_orderbarang.`id_toko`
        WHERE detail_orderbarang.`id_toko`='$idtoko' AND detail_orderbarang.`keterangan`='KIRIM'");
        return $q->Result();
    }
    public function baranglaku()
    {
        $q = $this->db->query("SELECT nama_toko, nama_barang,SUM(jumlah) AS jumlah FROM detail_transaksi
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang` 
        JOIN toko ON toko.`id_toko`=detail_transaksi.`id_toko`
        GROUP BY nama_barang ORDER BY jumlah DESC");
        return $q->Result();
    }
    public function baranglakutoko()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT nama_barang,SUM(jumlah) AS jumlah FROM detail_transaksi
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang` WHERE id_toko='$idtoko' 
        GROUP BY nama_barang ORDER BY jumlah DESC");
        return $q->Result();
    }
    public function penjpalingbanyak($idtoko)
    {
        $q = $this->db->query("SELECT toko.`nama_toko`, baranggudang.nama_barang,SUM(detail_transaksi.jumlah) AS jumlah FROM detail_transaksi
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang`
        JOIN toko ON toko.id_toko=detail_transaksi.`id_toko`
        WHERE toko.id_toko='$idtoko' GROUP BY baranggudang.nama_barang ORDER BY detail_transaksi.jumlah DESC");
        return $q->Result();
    }

    public function ambilnama($idtoko)
    {
        $q = $this->db->query("SELECT toko.`nama_toko` FROM detail_transaksi
        JOIN baranggudang ON baranggudang.`no_barang`=detail_transaksi.`no_barang`
        JOIN toko ON toko.id_toko=detail_transaksi.`id_toko`
        WHERE toko.id_toko='$idtoko' GROUP BY toko.id_toko='$idtoko'");
        return $q->Result();
    }

    public function stoktoko($idtoko)
    {
        $q = $this->db->query("SELECT * FROM barangtoko
        JOIN baranggudang ON baranggudang.`no_barang`=barangtoko.`no_barang`
        JOIN toko ON toko.id_toko=barangtoko.`id_toko`
        WHERE toko.id_toko='$idtoko'");
        return $q->Result();
    }

    public function perbulanpenj($idtoko)
    {
        $q = $this->db->query("SELECT MONTH(tanggal) AS bulan,SUM(grandtotal) AS grandtotal FROM detail_transaksi 
        JOIN transaksi ON transaksi.no_faktur=detail_transaksi.no_faktur 
        WHERE detail_transaksi.id_toko='$idtoko' GROUP BY MONTH(tanggal)");
        return $q->Result();
    }

    public function pertahunpenj($id)
    {
        $q = $this->db->query("SELECT YEAR(tanggal) AS tahun,SUM(grandtotal) AS grandtotal FROM detail_transaksi 
        JOIN transaksi ON transaksi.no_faktur=detail_transaksi.no_faktur 
        WHERE detail_transaksi.id_toko='$id' GROUP BY YEAR(tanggal)");
        return $q->Result();
    }

    public function perbulantransaksi()
    {
        $q = $this->db->query("SELECT MONTH(tanggal) AS bulan,SUM(grandtotal) AS grandtotal FROM detail_transaksi 
        JOIN transaksi ON transaksi.no_faktur=detail_transaksi.no_faktur GROUP BY MONTH(tanggal)");
        return $q->Result();
    }
}
