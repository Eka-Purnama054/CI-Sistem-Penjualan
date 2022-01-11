<?php

class Coa_model extends CI_Model
{
    public function coa()
    {
        $query = $this->db->get('coa');
        return $query;
    }

    public function kode_coa($kode, $kodeakun)
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode_akun,2)) AS kode_akun FROM coa WHERE kode_akun='$kode'");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kode_akun) + 1;
                $kd = sprintf("%02s", $tmp);
            }
        } else {
            $kd = "01";
        }
        return $kodeakun . $kd;
    }

    public function updatecoa($kode, $nama)
    {
        $data = array(
            'nama_akun' => $nama,
        );
        $this->db->update('coa', $data, array('kode_akun' => $kode));
        return true;
    }

    public function hapuscoa($kode)
    {
        $this->db->delete('coa', array('kode_akun' => $kode));
        return true;
    }
}
