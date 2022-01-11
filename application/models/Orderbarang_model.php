<?php

class Orderbarang_model extends CI_Model
{
    public function ordertampil()
    {
        $idtoko = $this->session->userdata('idtoko');
        $this->db->select('*');
        $this->db->join('baranggudang', 'baranggudang.no_barang = barangtoko.no_barang');
        $this->db->join('toko', 'toko.id_toko = barangtoko.id_toko');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('barangtoko', array('toko.id_toko' => $idtoko));
        return $query;
    }

    public function orderid($id)
    {
        $q = $this->db->query("SELECT * FROM barangtoko JOIN toko ON barangtoko.`id_toko`=toko.`id_toko` 
        JOIN baranggudang ON barangtoko.`no_barang`=baranggudang.`no_barang` WHERE baranggudang.no_barang='$id'");
        return $q;
    }

    public function tampilbarang()
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
    public function tampilbarangorder($id)
    {
        $this->db->select('*');
        $this->db->from('baranggudang');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->where('no_barang', $id);
        $query = $this->db->get();
        return $query;
    }

    public function cetakfakturpembelian()
    {
        $kode = $this->session->userdata('kode_order');
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_orderbarang.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=orderbarang.`id_toko`');
        $this->db->join('suplier', 'suplier.`id_suplier`=detail_orderbarang.`id_suplier`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $query = $this->db->get_where('detail_orderbarang', array('orderbarang.kode_order' => $kode));
        return $query;
    }

    public function cetakorderantoko()
    {
        $kode = $this->session->userdata('kode_order');
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_orderbarang.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=detail_orderbarang.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $query = $this->db->get_where('detail_orderbarang', array('orderbarang.kode_order' => $kode));
        return $query;
    }

    public function buatkode()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT MAX(RIGHT(kode_order,4)) AS kd_max FROM orderbarang WHERE YEAR(NOW()) AND id_toko='$idtoko'");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        return 'ORT' . $idtoko . $kd;
    }

    public function kodetanggal()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode_order,6)) AS kd_max FROM orderbarang WHERE DATE(tanggal_order)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }

        return 'AKT' . date('ymd') . $kd;
    }

    public function kodeordergudang()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode_order,4)) AS kd_max FROM orderbarang WHERE DATE(tanggal_order)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        return 'ORG' . date('ymd') . $kd;
    }

    public function simpanorder($ambilkode, $total, $pesan)
    {
        $idtoko = $this->session->userdata('idtoko');
        $username = $this->session->userdata('username');
        $this->db->query("INSERT INTO orderbarang(kode_order,total_order,ket,pesan) VALUES ('$ambilkode','$total','gudang','$pesan')");
        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'kode_order' => $ambilkode,
                'no_barang' => $item['id'],
                'id_toko' => $idtoko,
                'username' => $username,
                'harga' => $item['price'],
                'jumlah' => $item['qty'],
                'sub_total' => $item['subtotal'],
            );

            $this->db->insert('detail_orderbarang', $datacart);
        }
        return true;
    }

    public function simpanordergudang($ambilkode, $total, $pesan)
    {
        $username = $this->session->userdata('username');
        $this->db->query("INSERT INTO orderbarang(kode_order,total_order,ket,pesan) VALUES ('$ambilkode','$total','suplier','$pesan')");

        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'kode_order' => $ambilkode,
                'no_barang' => $item['id'],
                'id_suplier' => $item['idsuplier'],
                'username' => $username,
                'harga' => $item['price'],
                'jumlah' => $item['qty'],
                'sub_total' => $item['subtotal'],
            );
            $this->db->insert('detail_orderbarang', $datacart);
        }
        return true;
    }
}
