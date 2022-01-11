<?php

class Lorderbarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lorderbarang_model');
    }

    public function index()
    {
        $data['nopo'] = $this->db->from('orderbarang')->where('ket=', 'suplier')->order_by('kode_order', 'ASC')->get()->result();
        $data['order'] = $this->lorderbarang_model->getordergudang();
        $this->load->view('laporan/v_lorderbarang', $data);
    }

    public function lordergudang()
    {
        $tanggal = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $this->session->set_userdata('tanggal', $tanggal);
        $this->session->set_userdata('sampai', $sampai);
        $data['sum'] = $this->lorderbarang_model->sumordergudang($tanggal, $sampai);
        $data['order'] = $this->lorderbarang_model->getlordergudang($tanggal, $sampai);
        $this->load->view('laporan/v_ctkordergudangtgl', $data);
    }

    public function cetakpogudang()
    {
        $id = $this->input->post('nopo');
        $data['po'] = $this->lorderbarang_model->cetakpogudang($id);
        $this->load->view('laporan/v_cetakpogudang', $data);
    }

    public function ldatapotoko()
    {
        $data['toko'] = $this->db->from('toko')->order_by('nama_toko', 'ASC')->get()->result();
        $data['nopo'] = $this->db->from('orderbarang')->where('ket=', 'gudang')->order_by('kode_order', 'ASC')->get()->result();
        $data['order'] = $this->lorderbarang_model->lordertoko();
        $this->load->view('laporan/v_dataordertoko', $data);
    }

    public function cetakordertokotgl()
    {
        $tanggal = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $idtoko = $this->input->post('toko');
        $this->session->set_userdata('tanggal', $tanggal);
        $this->session->set_userdata('sampai', $sampai);

        $data['sum'] = $this->lorderbarang_model->sumordertoko($idtoko, $tanggal, $sampai);
        $data['order'] = $this->lorderbarang_model->lordertokotgl($idtoko, $tanggal, $sampai);
        $this->load->view('laporan/v_ctklordertoko', $data);
    }

    public function cetakpotoko()
    {
        $id = $this->input->post('nopo');
        $data['po'] = $this->lorderbarang_model->cetakpotoko($id);
        $this->load->view('laporan/v_cetakpotoko', $data);
    }
}
