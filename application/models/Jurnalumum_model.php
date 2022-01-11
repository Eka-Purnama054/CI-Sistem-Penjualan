<?php

class Jurnalumum_model extends CI_Model
{
    public function getjurnal()
    {
        $this->db->select('*');
        $this->db->from('jurnalumum');
        $this->db->join('coa', 'coa.kode_akun = jurnalumum.kode_akun');
        $query = $this->db->get();
        return $query;
    }

    public function kode()
    {
        $this->db->select('RIGHT(id_jurnalumum,2) as id_jurnalumum', FALSE);
        $this->db->order_by('jurnalumum.id_jurnalumum', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('jurnalumum');      //cek dulu apakah sudah ada kode di tabel.    
        if ($query->num_rows() > 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->id_jurnalumum) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = $kodemax;
        return $kodejadi;
    }

    public function lihatdata($akun, $tgl)
    {
        $query = $this->db->query("SELECT * FROM jurnalumum JOIN coa ON coa.`kode_akun`=jurnalumum.`kode_akun`
        JOIN saldo_awal ON saldo_awal.kode_akun=coa.kode_akun
        WHERE DATE_FORMAT(jurnalumum.tanggal,'%m-%Y')='$tgl' AND coa.`kode_akun`='$akun'");
        return $query;
    }

    public function sumdebit($akun, $tgl)
    {
        $query = $this->db->query("SELECT sum(total) as debit FROM jurnalumum
        WHERE DATE_FORMAT(tanggal,'%m-%Y')='$tgl' AND `kode_akun`='$akun' and d_c='Debit'");
        return $query->result();
    }

    public function sumcredit($akun, $tgl)
    {
        $query = $this->db->query("SELECT sum(total) as credit FROM jurnalumum
        WHERE DATE_FORMAT(tanggal,'%m-%Y')='$tgl' AND `kode_akun`='$akun' and d_c='Credit'");
        return $query->result();
    }

    public function getsaldoawal()
    {
        $this->db->join('coa', 'coa.kode_akun = saldo_awal.kode_akun');
        $query = $this->db->get('saldo_awal');
        return $query;
    }

    public function getcoaakun()
    {
        $query = $this->db->get_where('coa', array('is_kode_akun' => '1'));
        return $query->result();
    }

    public function getakun()
    {
        $query = $this->db->get_where('coa', array('is_kode_akun !=' => '2'));
        return $query->result();
    }
}
