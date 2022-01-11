<?php

class Dataretur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('retur_model');
    }
    public function index()
    {
        $data['rtg'] = $this->retur_model->returgudang();
        $data['nort'] = $this->db->from('returgudang')->order_by('no_retur', 'ASC')->get()->result();
        $this->load->view('v_datareturgudang', $data);
    }

    public function cetaknomorretur()
    {
        $id = $this->input->post('noretur');
        $data['nomor'] = $this->retur_model->cetaknomorreturgudang($id);
        $this->load->view('laporan/v_cetaknomorreturgudang', $data);
    }

    public function laporanreturtgl()
    {
        $tgl = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $this->session->set_userdata('tanggal', $tgl);
        $this->session->set_userdata('sampai', $sampai);
        $data['ttl'] = $this->retur_model->sumtotal($tgl, $sampai);
        $data['retur'] = $this->retur_model->cetakpertanggal($tgl, $sampai);
        $this->load->view('laporan/v_cetakdatareturgudangtanggal', $data);
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $noretur = $this->input->post('returno');
        $jumlah = $this->input->post('jumlah');
        $dataretur = $this->db->get_where('detail_returgudang', array('no_retur' => $noretur))->row();
        echo json_encode($dataretur);
        die;
    }
}
