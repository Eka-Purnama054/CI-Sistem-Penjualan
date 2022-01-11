<?php

class Orderbarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('orderbarang_model');
        $this->load->library('cart');
    }
    public function index()
    {
        $data['order'] = $this->orderbarang_model->ordertampil();
        $data['kodeorder'] = $this->orderbarang_model->buatkode();
        $data['kodeakt'] = $this->orderbarang_model->kodetanggal();
        $data['tmp'] = $this->orderbarang_model->tampilbarang();
        $data['supl'] = $this->db->from('suplier')->order_by('nama_suplier', 'ASC')->get()->result();
        $this->load->view('v_orderbarang', $data);
    }

    public function order()
    {
        if ($this->session->userdata('lvl') == 'Kasir') {
            $kode = $this->input->post('kode');
            $product = $this->orderbarang_model->orderid($kode);
            $i = $product->row_array();

            $data = array(
                'id' => $i['no_barang'],
                'kodebar' => $i['kode_barang'],
                'name' => $i['nama_barang'],
                'price' => $i['hargapokok'],
                'qty' => $this->input->post('qty'),
            );
            $this->cart->insert($data);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Order!!</div>');
            redirect('orderbarang');
        } else if ($this->session->userdata('lvl') == 'Admin') {
            $kode = $this->input->post('kode');
            $product = $this->orderbarang_model->tampilbarangorder($kode);
            $i = $product->row_array();

            $data = array(
                'id' => $i['no_barang'],
                'kodebar' => $i['kode_barang'],
                'name' => $i['nama_barang'],
                'suplier' => $i['nama_suplier'],
                'idsuplier' => $i['id_suplier'],
                'price' => $i['hargapokok'],
                'qty' => $this->input->post('qty'),
            );
            $this->cart->insert($data);
            $product = $data['qty'];
            // $this->db->query("UPDATE baranggudang set stok_gudang=stok_gudang - $product where no_barang='$i[no_barang]'");
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Order!!</div>');
            redirect('orderbarang');
        }
    }
    public function removeorder($rowid)
    {
        if ($this->session->userdata('lvl') == 'Kasir') {
            $removed_order = array(
                'rowid'         => $rowid,
                'qty'           => 0
            );
            $this->cart->update($removed_order);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menghapus Data Order!!</div>');
            redirect('orderbarang', 'refresh');
        } else if ($this->session->userdata('lvl') == 'Admin') {
            $removed_order = array(
                'rowid'         => $rowid,
                'qty'           => 0,
            );
            $this->cart->update($removed_order);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menghapus Data Order!!</div>');
            redirect('orderbarang', 'refresh');
        }
    }

    public function simpanorder()
    {
        if ($this->session->userdata('lvl') == 'Kasir') {
            $idtoko = $this->session->userdata('idtoko');
            $username = $this->session->userdata('username');
            $ambilkode = $this->orderbarang_model->buatkode();
            $total = $this->input->post('total');
            $pesan = $this->input->post('pesan');
            $this->session->set_userdata('kode_order', $ambilkode);

            $simpanorder = $this->orderbarang_model->simpanorder($ambilkode, $total, $pesan, $idtoko, $username);
            if ($simpanorder) {
                $this->cart->destroy();
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Order, Tunggu Ya Barang Datang!!</div>');
                redirect('orderbarang/cetakordertoko');
            }
            redirect('orderbarang', 'refresh');
        } else if ($this->session->userdata('lvl') == 'Admin') {
            $username = $this->session->userdata('username');
            $ambilkode = $this->orderbarang_model->kodetanggal();
            $total = $this->cart->total();;
            $pesan = $this->input->post('pesan');
            $this->session->set_userdata('kode_order', $ambilkode);
            $simpanorder = $this->orderbarang_model->simpanordergudang($ambilkode, $total, $pesan, $username);

            if ($simpanorder) {
                $this->cart->destroy();
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Order, Tunggu Ya Barang Datang!!</div>');
                redirect('orderbarang/cetakfakturpemberlian');
            }
            redirect('orderbarang', 'refresh');
        }
    }

    public function cetakfakturpemberlian()
    {
        $data['ctp'] = $this->orderbarang_model->cetakfakturpembelian();
        $this->load->view('laporan/v_cetakfakturpembelian', $data);
    }

    public function cetakordertoko()
    {
        $data['ctp'] = $this->orderbarang_model->cetakorderantoko();
        $this->load->view('laporan/v_cetakordertoko', $data);
    }
}
