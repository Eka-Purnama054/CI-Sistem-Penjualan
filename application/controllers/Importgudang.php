<?php
class Importgudang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library(array('excel', 'session'));
        $this->load->model('import_model');
    }

    public function index()
    {
    }
}
