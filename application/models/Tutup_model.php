<?php

class Tutup_model extends CI_Model
{
    public function getuser()
    {
        $idtoko = $this->session->userdata('idtoko');
        $this->db->join('toko', 'toko.id_toko = users.id_toko');
        $q = $this->db->get_where('users', array('toko.id_toko' => $idtoko));
        return $q;
    }

    public function tutupshift()
    {
        $idtoko = $this->session->userdata('idtoko');
        $where = "transaksi.id_toko='$idtoko' AND tanggal BETWEEN CONCAT(CURDATE(), ' 00:00:00') AND TIME(NOW()) ";
        $this->db->select_sum('grandtotal');
        $query = $this->db->get_where('transaksi', $where);
        return $query->result();
    }
    public function barang()
    {
        $idtoko = $this->session->userdata('idtoko');
        $username = $this->session->userdata('username');
        $where = "transaksi.id_toko='$idtoko' AND username='$username' AND tanggal BETWEEN CONCAT(CURDATE(), ' 00:00:00') AND TIME(NOW()) ";
        $this->db->select('*');
        $this->db->join('transaksi', 'transaksi.`no_faktur`=detail_transaksi.`no_faktur`');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_transaksi.`no_barang`');
        $query = $this->db->get_where('detail_transaksi', $where);
        return $query;
    }
}
