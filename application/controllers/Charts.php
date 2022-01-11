<?php

class Charts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('charts_model');
    }

    public function index()
    {
        $data['p'] = $this->charts_model->penjualantoko();
        $data['b'] = $this->charts_model->cbaranggudang();
        $data['l'] = $this->charts_model->baranglaku();
        $data['f'] = $this->charts_model->perbulantransaksi();
        $this->load->view('v_charts', $data);
    }

    public function penjualanpalingbanyak($id)
    {
        $data['tahun'] = $this->charts_model->pertahunpenj($id);
        $data['bulan'] = $this->charts_model->perbulanpenj($id);
        $data['bartoko'] = $this->charts_model->stoktoko($id);
        $data['nama'] = $this->charts_model->ambilnama($id);
        $data['toko'] = $this->charts_model->penjpalingbanyak($id);
        $this->load->view('v_chartstoko', $data);
    }
}
