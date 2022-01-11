<?php

class Stokin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('stokin_model');
    }
    public function index()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $data['t'] = $this->stokin_model->lihatkiriman();
            $this->load->view('v_stokin', $data);
        }
    }

    public function terimakiriman()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $idtoko = $this->session->userdata('idtoko');
            $idbar = $this->input->post('idbar');
            $kode = $this->input->post('id');
            $tgl = $this->input->post('tanggal');
            $qty_terima = $this->input->post('qty');
            $this->stokin_model->updatedetail($tgl, $idbar, $kode);
            $product = $this->stokin_model->terimatoko($idbar, $kode, $idtoko);
            $i = $product->row_array();
            $cek = $this->db->get_where('barangtoko', ['no_barang' => $i['no_barang'], 'id_toko' => $idtoko])->row_array();

            if (!$cek) {
                $tambahstokk = array(
                    'no_barang' => $i['no_barang'],
                    'stok_toko' => $i['jumlah'],
                    'id_toko' => $idtoko,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                $this->db->insert('barangtoko', $tambahstokk);

                echo $this->session->set_flashdata('msg', "<div class='alert alert-primary' role='alert'> Berhasil Tambah Data Barang '<b>$i[nama_barang]</b>' Dari Pengiriman!!Silakan Cek Barang Toko!</div>");
                redirect('stokin', 'refresh');
            } else {
                $qty = $i['jumlah'];
                $stok = $cek['stok_toko'];
                $tot = $qty + $stok;

                $data = array(
                    'stok_toko' => $tot,
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->update('barangtoko', $data, array('id_barangtoko' => $cek['id_barangtoko'], 'no_barang' => $cek['no_barang'], 'id_toko' => $cek['id_toko']));

                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Stok Pengiriman!! Silakan Cek Barang Toko!</div>');
                redirect('stokin', 'refresh');
            }
        }
    }
}
