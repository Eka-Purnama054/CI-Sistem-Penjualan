<?php

class Lpengiriman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lpengiriman_model');
    }

    public function index()
    {
        $data['toko'] = $this->db->from('toko')->order_by('nama_toko', 'ASC')->get()->result();
        $data['nokrm'] = $this->db->from('stok_in')->order_by('no_stokin', 'ASC')->get()->result();
        $data['stokin'] = $this->lpengiriman_model->ambilstokintoko();
        $this->load->view('laporan/v_lpengirimantoko', $data);
    }

    public function cetakpertanggaltoko()
    {
        $tanggal = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $toko = $this->input->post('toko');
        $this->session->set_userdata('tanggal', $tanggal);
        $this->session->set_userdata('sampai', $sampai);
        $data['kirim'] = $this->lpengiriman_model->kirimtokopertanggal($toko, $tanggal, $sampai);
        $data['sum'] = $this->lpengiriman_model->sumtotal($tanggal, $sampai);
        $this->load->view('laporan/v_cetakkirimtokotgl', $data);
    }

    public function cetakpernomor()
    {
        $id = $this->input->post('nokirim');
        $data['nokirim'] = $this->lpengiriman_model->cetaknokirimtoko($id);
        $this->load->view('laporan/v_cetaksjkirimtoko', $data);
    }

    public function lihatdatastokingudang()
    {
        $data['suplier'] = $this->db->from('suplier')->order_by('nama_suplier', 'ASC')->get()->result();
        $data['nokrm'] = $this->db->from('stokingudang')->order_by('kode_stokin', 'ASC')->get()->result();
        $data['krmg'] = $this->lpengiriman_model->getstokingudang();
        $this->load->view('laporan/v_lpengirimangudang', $data);
    }

    public function cetakdarisuplier()
    {
        $tanggal = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $suplier = $this->input->post('suplier');
        $this->session->set_userdata('tanggal', $tanggal);
        $this->session->set_userdata('sampai', $sampai);
        $data['sum'] = $this->lpengiriman_model->sumtotalgudang($tanggal, $sampai);
        $data['kirim'] = $this->lpengiriman_model->pertanggalkirimsuplier($suplier, $tanggal, $sampai);
        $this->load->view('laporan/v_cetakkirimdarisupliertgl', $data);
    }

    public function cetaksjsuplier()
    {
        $id = $this->input->post('nokirim');
        $data['nokirim'] = $this->lpengiriman_model->cetaksjsuplier($id);
        $this->load->view('laporan/v_cetaksjsuplier', $data);
    }
}
