<?php
class HomeAdmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('charts_model');
    }
    public function index()
    {
        if ($this->session->userdata('lvl') != 'Admin') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Admin') {
            $data['c'] = $this->charts_model->penjualantoko();
            $data['d'] = $this->charts_model->totpenjualantoko();
            $this->load->view('v_dashboard', $data);
        }
    }
}
