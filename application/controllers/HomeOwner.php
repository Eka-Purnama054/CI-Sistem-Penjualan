<?php

class HomeOwner extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('charts_model');
    }

    public function index()
    {
        if ($this->session->userdata('lvl') != 'Owner') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Owner') {
            $data['c'] = $this->charts_model->penjualantoko();
            $data['d'] = $this->charts_model->totpenjualantoko();
            $data['t'] = $this->charts_model->totalpenjhariini();
            $this->load->view('v_dashboard', $data);
        }
    }
}
