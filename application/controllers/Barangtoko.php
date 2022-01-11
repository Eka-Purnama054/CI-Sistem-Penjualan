<?php

class Barangtoko extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barangtoko_model');
    }
    public function index()
    {
        $data['bartok'] = $this->barangtoko_model->bartoko();
        $data['toko'] = $this->db->from('toko')->order_by('nama_toko', 'ASC')->get()->result();
        $data['bargud'] = $this->db->from('baranggudang')->order_by('nama_barang', 'ASC')->get()->result();
        $this->load->view('v_barangtoko', $data);
    }

    public function ambiltokoid($id)
    {
        $data['toko'] = $this->db->from('toko')->order_by('nama_toko', 'ASC')->get()->result();
        $data['bargud'] = $this->db->from('baranggudang')->order_by('nama_barang', 'ASC')->get()->result();
        $data['tampil'] = $this->barangtoko_model->GetBarangtoko($id);
        $this->load->view('v_barangtoko', $data);
    }

    public function insert()
    {
        $data = array(
            'no_barang' => $this->input->post('bargud'),
            'stok_toko' => $this->input->post('stok'),
            'id_toko' => $this->input->post('toko'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('barangtoko', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
        redirect('barangtoko', 'refresh');
    }

    public function update()
    {
        $data = array(
            'no_barang' => $this->input->post('bargud'),
            'stok_toko' => $this->input->post('stok'),
            'id_toko' => $this->input->post('toko'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->update('barangtoko', $data, array('id_barangtoko' => $this->input->post('id')));
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
        redirect('barangtoko', 'refresh');
    }

    public function delete()
    {
        $this->db->delete('barangtoko', array('id_barangtoko' => $this->input->post('id')));
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Hapus data</div>');
        redirect('barangtoko', 'refresh');
    }
}
