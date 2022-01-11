<?php
class HomeKasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('charts_model');
    }
    public function index()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $data['c'] = $this->charts_model->penjualantoko();
            $data['d'] = $this->charts_model->totpenjualantokoo();
            $data['p'] = $this->charts_model->totalproduct();
            $data['r'] = $this->charts_model->datareturtoko();
            $data['h'] = $this->charts_model->penjhariini();
            $data['l'] = $this->charts_model->baranglakutoko();
            $data['t'] = $this->charts_model->totordert();
            $this->load->view('v_dashboard', $data);
        }
    }
}
