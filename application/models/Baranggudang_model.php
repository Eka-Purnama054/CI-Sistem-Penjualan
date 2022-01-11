<?php

class Baranggudang_model extends CI_Model
{
    public function GetBaranggudang()
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
    public function updatebarang($nobarang, $kode, $nama, $harpok, $hargro, $harjul, $size, $stok, $satuan, $kategori, $suplier, $qrcode)
    {
        $data = array(
            'kode_barang' => $kode,
            'nama_barang' => $nama,
            'hargajual' => $harjul,
            'hargagrosir' => $hargro,
            'hargapokok' => $harpok,
            'size_barang' => $size,
            'stok_gudang' => $stok,
            'qr_code' => $qrcode,
            'id_satuan' => $satuan,
            'id_kategori' => $kategori,
            'id_suplier' => $suplier,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->update('baranggudang', $data, array('no_barang' => $nobarang));
        return true;
    }

    public function kodebarang($kodeitem, $idsize, $idwarna)
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode_barang,6)) AS kode_barang FROM baranggudang WHERE kode_item='$kodeitem'");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kode_barang) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        return $kodeitem . $idsize . $idwarna . $kd;
    }

    public function nobarang()
    {
        $this->db->select('RIGHT(no_barang,6) as no_barang', FALSE);
        $this->db->order_by('baranggudang.no_barang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('baranggudang');      //cek dulu apakah sudah ada kode di tabel.    
        if ($query->num_rows() > 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->no_barang) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = $kodemax;
        return $kodejadi;
    }

    public function getKirimsup()
    {
        $q = $this->db->query("SELECT * FROM detail_stokingudang 
        JOIN stokingudang ON stokingudang.`kode_stokin`=detail_stokingudang.`kode_stokin`
        JOIN suplier ON suplier.`id_suplier`=detail_stokingudang.`id_suplier`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokingudang.`no_barang`
        JOIN kategori_warna ON kategori_warna.`id_warna`=baranggudang.`id_warna`
        JOIN kategori_size ON kategori_size.`id_size`=baranggudang.`id_size`
        JOIN kategori_item ON kategori_item.`kode_item`=baranggudang.`kode_item`");
        return $q;
    }

    public function getKirimsupp($idbar, $id)
    {
        $q = $this->db->query("SELECT * FROM detail_stokingudang 
        JOIN stokingudang ON stokingudang.`kode_stokin`=detail_stokingudang.`kode_stokin`
        JOIN suplier ON suplier.`id_suplier`=detail_stokingudang.`id_suplier`
        JOIN baranggudang ON baranggudang.`no_barang`=detail_stokingudang.`no_barang` 
        WHERE baranggudang.no_barang='$idbar' and stokingudang.kode_stokin='$id'");
        return $q;
    }

    public function updatedetailstokin($tgl, $idbar, $id)
    {
        $q = $this->db->query("UPDATE detail_stokingudang SET keterangan='TERIMA',tgl_terima='$tgl' where no_barang='$idbar' and kode_stokin='$id'");
        return $q;
    }

    public function terimaretur($id, $nobar)
    {
        $where = "stok_out.kode_stokout='$id' AND baranggudang.no_barang='$nobar'";
        $this->db->select('*');
        $this->db->join('stok_out', 'stok_out.kode_stokout = detail_stokout.kode_stokout');
        $this->db->join('baranggudang', 'baranggudang.no_barang = detail_stokout.no_barang');
        $this->db->join('toko', 'toko.id_toko = detail_stokout.id_toko');
        $this->db->join('kategori_warna', 'kategori_warna.id_warna = baranggudang.id_warna');
        $this->db->join('satuan', 'satuan.id_satuan = baranggudang.id_satuan');
        $this->db->join('suplier', 'suplier.id_suplier = baranggudang.id_suplier');
        $this->db->join('kategori_size', 'kategori_size.id_size = baranggudang.id_size');
        $this->db->join('kategori_item', 'kategori_item.kode_item = baranggudang.kode_item');
        $query = $this->db->get_where('detail_stokout', $where);
        return $query;
    }

    public function updatestokout($id, $idbar)
    {
        $data = array(
            'ket' => 'TERIMA',
            'tgl_terima' => date('Y-m-d H:i:s')
        );
        $this->db->update('detail_stokout', $data, array('kode_stokout' => $id, 'no_barang' => $idbar));
    }
}
