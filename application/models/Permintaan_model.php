<?php

class Permintaan_model extends CI_Model
{
    public function getOrderan()
    {
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_orderbarang.`no_barang`');
        $this->db->join('toko', 'toko.`id_toko`=orderbarang.`id_toko`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $query = $this->db->get_where('detail_orderbarang', array('orderbarang.`ket`' => 'gudang'));
        return $query;
    }
    public function kirimorderan($id, $kode)
    {
        $q = $this->db->query("SELECT * FROM detail_orderbarang JOIN orderbarang ON orderbarang.`kode_order`=detail_orderbarang.`kode_order`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_orderbarang.`no_barang`
        JOIN toko ON toko.`id_toko`=detail_orderbarang.`id_toko` WHERE orderbarang.`ket`='gudang' AND baranggudang.no_barang='$id' and orderbarang.kode_order='$kode'");
        return $q;
    }

    public function getOrderanakt()
    {
        $idsup = $this->session->userdata('idsup');

        $q = $this->db->query("SELECT * FROM detail_orderbarang 
        JOIN orderbarang ON orderbarang.`kode_order`=detail_orderbarang.`kode_order`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_orderbarang.`no_barang`
        JOIN suplier ON suplier.`id_suplier`=detail_orderbarang.`id_suplier`
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna`
        WHERE detail_orderbarang.`id_suplier`='$idsup'");
        return $q;
    }
    public function getOrderanaktkirm($id)
    {
        $idsup = $this->session->userdata('idsup');

        $q = $this->db->query("SELECT * FROM detail_orderbarang JOIN orderbarang ON orderbarang.`kode_order`=detail_orderbarang.`kode_order`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_orderbarang.`no_barang`
        JOIN suplier ON suplier.`id_suplier`=detail_orderbarang.`id_suplier`
        WHERE detail_orderbarang.`id_suplier`='$idsup' and baranggudang.no_barang='$id'");
        return $q;
    }
    public function baranggudangkirim()
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
    public function baranggudangkirimbaru($id)
    {
        $q = $this->db->query("SELECT * FROM baranggudang JOIN satuan ON satuan.`id_satuan`=baranggudang.`id_satuan`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna`
        WHERE baranggudang.`no_barang`='$id'");
        return $q;
    }

    public function cetaksuratjalankirimtoko()
    {
        $no_stokin = $this->session->userdata('no_stokin');
        $q = $this->db->query("SELECT * FROM detail_stokin JOIN stok_in ON stok_in.`no_stokin`=detail_stokin.`no_stokin`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokin.`no_barang`
        JOIN toko ON toko.`id_toko`=detail_stokin.`id_toko`
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna`
        WHERE stok_in.`no_stokin`='$no_stokin'");
        return $q;
    }

    public function cetaksuratjalankirimsuplier()
    {
        $kode_stokin = $this->session->userdata('kode_stokin');
        $q = $this->db->query("SELECT * FROM detail_stokingudang 
        JOIN stokingudang ON stokingudang.`kode_stokin`=detail_stokingudang.`kode_stokin`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokingudang.`no_barang`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna`
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`
        WHERE stokingudang.`kode_stokin`='$kode_stokin'");
        return $q;
    }

    public function getsuplier()
    {
        $idsup = $this->session->userdata('idsup');
        $query = $this->db->get_where('suplier', array('id_suplier' => $idsup));
        return $query;
    }

    public function cetakpoketoko()
    {
        $kodeorder = $this->session->userdata('kode_order');
        $this->db->select('*');
        $this->db->join('orderbarang', 'orderbarang.kode_order = detail_orderbarang.kode_order');
        $this->db->join('baranggudang', 'baranggudang.`no_barang`=detail_orderbarang.`no_barang`');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $query = $this->db->get_where('detail_orderbarang', array('orderbarang.kode_order' => $kodeorder));
        return $query;
    }

    public function kode()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_stokin,5)) AS no_stokin FROM stok_in WHERE DATE(tgl_stokin)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->no_stokin) + 1;
                $kd = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "00001";
        }
        return 'KRM' . date('dmy') . $kd;
    }

    public function kodekirimsup()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode_stokin,6)) AS kode_stokin FROM stokingudang WHERE DATE(tanggal)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kode_stokin) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return 'SUP' . date('dmy') . $kd;
    }

    public function simpankirimantoko($kode, $total, $namatoko, $ket)
    {
        $username = $this->session->userdata('username');
        $this->db->query("INSERT INTO stok_in(no_stokin,total,id_toko,keterangan,username) VALUES ('$kode','$total','$namatoko','$ket','$username')");
        $nama = $this->input->post('kirimke');
        $tanggal = $this->input->post('tanggal');
        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'no_stokin' => $kode,
                'no_barang' => $item['id'],
                'id_toko' => $nama,
                'kode_order' => $item['kode'],
                'stokin_hargapokok' => $item['price'],
                'jumlah' => $item['qty'],
                'sub_total' => $item['subtotal'],
            );
            // echo json_encode($datacart);
            // die;
            $this->db->insert('detail_stokin', $datacart);
            $this->db->query("UPDATE baranggudang set stok_gudang=stok_gudang - ($item[qty]) where no_barang='$item[id]'");
            if (!$item['kode']) {
                echo "";
            } else {
                $this->db->query("UPDATE detail_orderbarang set keterangan='KIRIM', tgl_kirim='$tanggal' where kode_order='$item[kode]' and no_barang='$item[id]'");
            }
        }
        return true;
    }

    public function kirimsuplier($kode, $total)
    {
        $username = $this->session->userdata('username');
        $idsup = $this->session->userdata('idsup');
        $this->db->query("INSERT INTO stokingudang(kode_stokin,total,username,id_suplier) VALUES ('$kode','$total','$username','$idsup')");
        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'kode_stokin' => $kode,
                'no_barang' => $item['id'],
                'harga' => $item['price'],
                'id_suplier' => $idsup,
                'jumlah' => $item['qty'],
                'subtotal' => $item['subtotal'],
            );

            $this->db->insert('detail_stokingudang', $datacart);
            if (!$item['kode']) {
                echo "";
            } else {
                $this->db->query("UPDATE detail_orderbarang set keterangan='KIRIM', tgl_kirim=NOW() where kode_order='$item[kode]' and no_barang='$item[id]'");
            }
        }
        return true;
    }

    public function saveorderketoko($ambilkode, $total, $idtoko, $pesan)
    {
        $username = $this->session->userdata('username');
        $tanggal = $this->input->post('tanggal');
        $this->db->query("INSERT INTO orderbarang(kode_order,total_order,id_toko,ket,pesan) VALUES ('$ambilkode','$total','$idtoko','toko','$pesan')");

        foreach ($this->cart->contents() as $item) {
            $datacart = array(
                'kode_order' => $ambilkode,
                'no_barang' => $item['id'],
                'id_suplier' => $item['idsuplier'],
                'username' => $username,
                'id_toko' => $item['tk'],
                'harga' => $item['price'],
                'jumlah' => $item['qty'],
                'sub_total' => $item['subtotal'],
            );
            $this->db->query("UPDATE detail_orderbarang set keterangan='ORDERTOKO', tgl_kirim='$tanggal' where kode_order='$item[kode]' and no_barang='$item[id]'");
            $this->db->insert('detail_orderbarang', $datacart);
        }
        return true;
    }
}
