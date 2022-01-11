<?php

class Transaksi_model extends CI_Model
{
    public function transaksitampil($id)
    {
        $q = $this->db->query("SELECT * FROM barangtoko JOIN toko ON barangtoko.`id_toko`=toko.`id_toko` 
        JOIN baranggudang ON barangtoko.`no_barang`=baranggudang.`no_barang` 
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna` 
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        WHERE baranggudang.no_barang='$id'");
        return $q;
    }
    public function transaksitampilcam($id)
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM barangtoko JOIN toko ON barangtoko.`id_toko`=toko.`id_toko` 
        JOIN baranggudang ON barangtoko.`no_barang`=baranggudang.`no_barang` WHERE baranggudang.kode_barang='$id' and toko.id_toko='$idtoko'");
        return $q;
    }
    public function tampilbarangtoko()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM barangtoko JOIN toko ON barangtoko.`id_toko`=toko.`id_toko` 
        JOIN baranggudang ON barangtoko.`no_barang`=baranggudang.`no_barang` 
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna` 
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        WHERE toko.id_toko='$idtoko'");
        return $q;
    }
    public function cetakstruk()
    {
        $nofak = $this->session->userdata('no_faktur');
        $q = $this->db->query("SELECT * FROM detail_transaksi JOIN transaksi ON transaksi.no_faktur=detail_transaksi.no_faktur 
        JOIN baranggudang ON baranggudang.no_barang=detail_transaksi.no_barang
        JOIN toko ON toko.id_toko=detail_transaksi.id_toko WHERE transaksi.no_faktur='$nofak'");
        return $q;
    }

    public function getUser()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM toko where id_toko='$idtoko'");
        return $q->Result();
    }

    public function getNofak()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT MAX(RIGHT(no_faktur,6)) AS kd_max FROM transaksi WHERE id_toko=$idtoko AND DATE(tanggal)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        return $idtoko . date('dmy') . $kd;
    }

    public function simpantransaksi($no_faktur, $diskon, $total, $cash, $kembalian, $grandtotal)
    {
        $idtoko = $this->session->userdata('idtoko');
        $username = $this->session->userdata('username');
        $this->db->query("INSERT INTO transaksi(no_faktur,diskon,total,jml_uang,kembalian,grandtotal,username,id_toko) VALUES ('$no_faktur','$diskon','$total','$cash','$kembalian','$grandtotal','$username','$idtoko')");

        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'no_faktur' => $no_faktur,
                'no_barang' => $item['id'],
                'id_toko' => $idtoko,
                'hargapokok' => $item['harpok'],
                'hargagrosir' => $item['hargro'],
                'hargajual' => $item['price'],
                'jumlah' => $item['qty'],
                'subtotal' => $item['subtotal'],
            );
            $this->db->query("UPDATE barangtoko set stok_toko=stok_toko -($item[qty]) where no_barang='$item[id]' and id_toko='$idtoko'");
            $this->db->insert('detail_transaksi', $datacart);
        }
        return true;
    }
}
