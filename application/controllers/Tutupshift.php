<?php

class Tutupshift extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tutup_model');
    }
    public function index()
    {
        $data['tutup'] = $this->tutup_model->tutupshift();
        $data['barang'] = $this->tutup_model->barang();
        $data['toko'] = $this->tutup_model->getuser();
        $this->load->view('v_tutupshift', $data);
    }
}
