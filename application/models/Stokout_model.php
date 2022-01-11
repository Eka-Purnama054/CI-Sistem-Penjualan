<?php

class Stokout_model extends CI_Model
{
    public function ambilstok()
    {
        $idtoko = $this->session->userdata('idtoko');
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('toko', 'toko.id_toko = orderbarang.id_toko');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_orderbarang.`no_barang`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $query = $this->db->get_where('detail_orderbarang', array('orderbarang.id_toko' => $idtoko, 'orderbarang.ket' => 'toko'));
        return $query;
    }

    public function returketoko($kodebar, $kodeorder)
    {
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('toko', 'toko.id_toko = orderbarang.id_toko');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_orderbarang.`no_barang`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $query = $this->db->get_where('detail_orderbarang', array('baranggudang.no_barang' => $kodebar, 'orderbarang.kode_order' => $kodeorder));
        return $query;
    }

    public function returgudang($id)
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM barangtoko JOIN toko ON barangtoko.`id_toko`=toko.`id_toko` 
        JOIN baranggudang ON barangtoko.`no_barang`=baranggudang.`no_barang` WHERE toko.id_toko='$idtoko' and barangtoko.no_barang='$id' ");
        return $q;
    }
    public function databar()
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

    public function dataretur()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM detail_stokout JOIN stok_out ON stok_out.`kode_stokout`=detail_stokout.`kode_stokout`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokout.`no_barang`
        JOIN toko ON toko.`id_toko`=detail_stokout.`id_toko`
        WHERE stok_out.`id_toko`='$idtoko' AND keterangan != 'Toko'");
        return $q;
    }
    public function dtreturantoko()
    {
        $this->db->select('*');
        $this->db->join('stok_out', 'stok_out.kode_stokout = detail_stokout.kode_stokout');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokout.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_stokout.id_toko');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_stokout', array('stok_out.keterangan' => 'Retur Ke Gudang'));
        return $query;
    }

    public function getUser()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT * FROM toko where id_toko='$idtoko'");
        return $q->Result();
    }

    public function cetakfakturreturtoko()
    {
        $noretur = $this->session->userdata('no_retur');
        $this->db->select('*');
        $this->db->join('stok_out', 'stok_out.kode_stokout = detail_stokout.kode_stokout');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokout.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_stokout.id_toko');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_stokout', array('stok_out.kode_stokout' => $noretur));
        return $query;
    }

    public function koderetursuplier()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_retur,4)) AS no_retur FROM returgudang WHERE DATE(tanggal_retur)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->no_retur) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'RTS' . date('dmy') . $kd;
    }

    public function kodeunik()
    {
        $idtoko = $this->session->userdata('idtoko');
        $q = $this->db->query("SELECT MAX(RIGHT(kode_stokout,4)) AS kode_stokout FROM stok_out WHERE YEAR(NOW()) AND id_toko= $idtoko ");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kode_stokout) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'RET' . $idtoko . $kd;
    }

    public function simpanretur($kode, $total, $namatoko, $pesan)
    {
        $idtoko = $this->session->userdata('idtoko');
        $username = $this->session->userdata('username');
        $tanggal = $this->input->post('tanggal');
        $this->db->query("INSERT INTO stok_out(kode_stokout,total,keterangan,pesan,username) VALUES ('$kode','$total','Retur Ke Toko','$pesan','$username')");

        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'kode_stokout' => $kode,
                'no_barang' => $item['id'],
                'id_toko' => $namatoko,
                'hargapokok' => $item['price'],
                'jumlah' => $item['qty'],
                'sub_total' => $item['subtotal'],
            );
            $this->db->insert('detail_stokout', $datacart);
            $this->db->query("UPDATE barangtoko set stok_toko=stok_toko -$item[qty] where no_barang='$item[id]' and id_toko='$idtoko'");
        }
        foreach ($this->cart->contents() as $item) {
            $this->db->query("UPDATE detail_orderbarang set keterangan='KIRIM', tgl_kirim='$tanggal' where kode_order='$item[kode]' and no_barang='$item[id]'");
        }
        return true;
    }

    public function simpankirimantoko($kode, $total, $namatoko, $ket)
    {
        $username = $this->session->userdata('username');
        $this->db->query("INSERT INTO stok_in(no_stokin,total,id_toko,keterangan,username) VALUES ('$kode','$total','$namatoko','$ket','$username')");
        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'no_stokin' => $kode,
                'no_barang' => $item['id'],
                'id_toko' => $namatoko,
                'kode_order' => $item['kode'],
                'stokin_hargapokok' => $item['price'],
                'jumlah' => $item['qty'],
                'sub_total' => $item['subtotal'],
            );
            $this->db->insert('detail_stokin', $datacart);
        }
        return true;
    }

    public function simpanreturan($kode, $total, $pesan)
    {
        $idtoko = $this->session->userdata('idtoko');
        $username = $this->session->userdata('username');
        $this->db->query("INSERT INTO stok_out(kode_stokout,total,keterangan,pesan,username) VALUES ('$kode','$total','Retur Ke Gudang','$pesan','$username')");

        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'kode_stokout' => $kode,
                'no_barang' => $item['id'],
                'id_toko' => $idtoko,
                'hargapokok' => $item['price'],
                'jumlah' => $item['qty'],
                'sub_total' => $item['subtotal'],
            );
            $this->db->insert('detail_stokout', $datacart);
            $this->db->query("UPDATE barangtoko set stok_toko=stok_toko -($item[qty]) where no_barang='$item[id]' and id_toko='$idtoko'");
        }
        return true;
    }


    public function insertreturdarigudang($noretur, $total, $ket)
    {
        $username = $this->session->userdata('username');
        $this->db->query("INSERT INTO returgudang(no_retur,total,keterangan,username) VALUES ('$noretur','$total','$ket','$username')");

        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'no_retur' => $noretur,
                'id_suplier' => $item['idsup'],
                'no_barang' => $item['id'],
                'hargapokok' => $item['price'],
                'jumlah' => $item['qty'],
                'subtotal' => $item['subtotal'],
            );
            $this->db->insert('detail_returgudang', $datacart);
            $this->db->query("UPDATE baranggudang SET stok_gudang=stok_gudang -($item[qty]) WHERE no_barang='$item[id]'");
        }
        return true;
    }

    public function getcetakreturkesuplier()
    {
        $koderetur = $this->session->userdata('koderetur');
        $this->db->select('*');
        $this->db->join('returgudang', 'returgudang.no_retur = detail_returgudang.no_retur');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_returgudang.no_barang');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = detail_returgudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_returgudang', array('returgudang.no_retur' => $koderetur));
        return $query;
    }
}
