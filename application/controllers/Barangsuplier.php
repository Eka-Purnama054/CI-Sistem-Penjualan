<?php

class Barangsuplier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('barangsuplier_model');
    }
    public function index()
    {
        $data['kate'] = $this->db->from('kategori_warna')->order_by('nama_warna', 'ASC')->get()->result();
        $data['supp'] = $this->db->from('suplier')->order_by('nama_suplier', 'ASC')->get()->result();
        $data['satu'] = $this->db->from('satuan')->order_by('nama_satuan', 'ASC')->get()->result();
        $data['barsup'] = $this->barangsuplier_model->ambilbarangsuplier();
        $this->load->view('v_barangsuplier', $data);
    }

    public function insert()
    {
        $idsup = $this->session->userdata('idsup');
        $data = array(
            'kode_barang' => $this->input->post('kode'),
            'nama_barang' => $this->input->post('nama'),
            'hargapokok' => $this->input->post('harpok'),
            'size_barang' => $this->input->post('size'),
            'stok_gudang' => 0,
            'id_satuan' => $this->input->post('satuan'),
            'id_warna' => $this->input->post('kategori'),
            'id_suplier' => $idsup,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('baranggudang', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
        redirect('barangsuplier', 'refresh');
    }

    public function update()
    {
        $data = array(
            'kode_barang' => $this->input->post('kode'),
            'nama_barang' => $this->input->post('nama'),
            'hargapokok' => $this->input->post('harpok'),
            'size_barang' => $this->input->post('size'),
            'id_satuan' => $this->input->post('satuan'),
            'id_warna' => $this->input->post('kategori'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->update('baranggudang', $data, array('id_barang' => $this->input->post('id')));
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
        redirect('barangsuplier', 'refresh');
    }
}
