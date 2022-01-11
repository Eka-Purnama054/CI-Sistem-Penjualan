<?php

class HomeSuplier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function index()
    {
        if ($this->session->userdata('lvl') != 'Suplier') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Suplier') {
            $this->load->view('v_dashboard');
        }
    }
}
