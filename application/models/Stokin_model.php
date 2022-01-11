<?php

class Stokin_model extends CI_Model
{
    public function lihatkiriman()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM detail_stokin JOIN stok_in ON stok_in.`no_stokin`=detail_stokin.`no_stokin`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokin.`no_barang`
        JOIN toko ON toko.`id_toko`=detail_stokin.`id_toko`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna`
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        WHERE detail_stokin.id_toko='$idtoko'");
        return $q;
    }

    public function terimatoko($idbar, $id)
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM detail_stokin JOIN stok_in ON stok_in.`no_stokin`=detail_stokin.`no_stokin`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokin.`no_barang`
        JOIN toko ON toko.`id_toko`=detail_stokin.`id_toko`
        WHERE detail_stokin.id_toko='$idtoko' and stok_in.no_stokin='$id' and detail_stokin.no_barang='$idbar'");
        return $q;
    }
    public function updatedetail($tgl, $id, $kode)
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("UPDATE detail_stokin SET stokin_ket='TERIMA',tgl_terima='$tgl' where no_stokin='$kode' and no_barang='$id' and id_toko='$idtoko'");
        return $q;
    }
}
