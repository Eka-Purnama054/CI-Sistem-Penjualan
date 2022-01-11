<?php

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->library('cart');
    }
    public function index()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $data['detail'] = $this->transaksi_model->tampilbarangtoko();
            $data['kodeunik'] = $this->transaksi_model->getNofak();
            $this->load->view('v_transaksi', $data);
        }
    }

    public function cetakstruk()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $data['cetak'] = $this->transaksi_model->cetakstruk();
            $data['t'] = $this->transaksi_model->getUser();
            $this->load->view('laporan/v_cetakstruk', $data);
        }
    }

    public function belanja()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $kode = $this->input->post('kode');
            $product = $this->transaksi_model->transaksitampil($kode);
            $i = $product->row_array();

            $data = array(
                'id' => $i['no_barang'],
                'kodebar' => $i['kode_barang'],
                'name' => $i['nama_barang'],
                'harpok' => $i['hargapokok'],
                'hargro' => $i['hargagrosir'],
                'price' => $i['hargajual'],
                'qty' => $this->input->post('qty'),
            );
            if ($i['stok_toko'] > $this->input->post('qty')) {
                $this->cart->insert($data);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Keranjang Belanja!!</div>');
                redirect('transaksi');
            } else if ($i['stok_toko'] = 0) {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Stok Anda Kurang</div>');
                redirect('transaksi');
            }
        }
    }

    public function scanwebcam()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $kode_brg = $this->input->post('kode_brg');
            $qty = 1;
            $product = $this->transaksi_model->transaksitampilcam($kode_brg);
            $i = $product->row_array();
            $data = array(
                'id' => $i['no_barang'],
                'kodebar' => $i['kode_barang'],
                'name' => $i['nama_barang'],
                'harpok' => $i['hargapokok'],
                'hargro' => $i['hargagrosir'],
                'price' => $i['hargajual'],
                'qty' => $qty,
            );
            if ($i['stok_toko'] >= $qty) {
                $this->cart->insert($data);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Keranjang Belanja!!</div>');
                redirect('transaksi');
            } else if ($i['stok_toko'] = 0) {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Stok Anda Kurang</div>');
                redirect('transaksi');
            }
            redirect('transaksi');
        }
    }

    public function removecart($row_id)
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $removed_cart = array(
                'rowid'         => $row_id,
                'qty'           => 0
            );
            $this->cart->update($removed_cart);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menghapus Keranjang Belanja!!</div>');
            redirect('transaksi', 'refresh');
        }
    }

    public function inserttransaksi()
    {
        $username = $this->session->userdata('username');

        $diskon = str_replace(",", "", $this->input->post('diskon'));
        $cash = $this->input->post('cash');
        $totalbelanja = $this->input->post('totalbelanja');
        $grandtotal = $totalbelanja - $diskon;
        $kembalian = $cash - $grandtotal;
        $ambilkode = $this->transaksi_model->getNofak();
        $this->session->set_userdata('no_faktur', $ambilkode);
        if (!empty($grandtotal) && !empty($cash)) {
            if ($cash < $grandtotal) {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> Jumlah Uang yang anda masukan Kurang</div>');
                redirect('transaksi', 'refresh');
            } else {
                $prosestransaksi = $this->transaksi_model->simpantransaksi($ambilkode, $diskon, $totalbelanja, $cash, $kembalian, $grandtotal, $username);
                if ($prosestransaksi) {
                    $this->cart->destroy();
                    redirect('transaksi/cetakstruk', 'refresh');
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Transaksi Berhasil! Terimakasih</div>');
                } else {
                    redirect('transaksi', 'refresh');
                }
            }
        } else {
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</div>');
            redirect('transaksi', 'refresh');
        }
    }
}
