<?php

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('barang_model');
    }

    public function index()
    {
        $data['bar'] = $this->barang_model->getbarangtoko();
        $data['tk'] = $this->barang_model->toko();
        $this->load->view('v_barang', $data);
    }

    public function detail($id)
    {
        $data['day'] = $this->barang_model->day($id);
        $data['month'] = $this->barang_model->Month($id);
        $data['year'] = $this->barang_model->year($id);
        $data['laku'] = $this->barang_model->baranglaku($id);
        $data['det'] = $this->barang_model->detail($id);
        $data['stok'] = $this->barang_model->grafikstok($id);
        $this->load->view('v_detailbarangall', $data);
    }
}
