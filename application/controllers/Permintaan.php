<?php

class Permintaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('permintaan_model');
        $this->load->model('orderbarang_model');
        $this->load->model('barangsuplier_model');
        $this->load->library('cart');
    }
    public function index()
    {
        if ($this->session->userdata('lvl') == 'Gudang') {
            $data['r'] = $this->permintaan_model->getOrderan();
            $data['bk'] = $this->permintaan_model->baranggudangkirim();
            $data['toko'] = $this->db->from('toko')->order_by('nama_toko', 'ASC')->get()->result();
            $this->load->view('v_permintaan', $data);
        } else if ($this->session->userdata('lvl') == 'Suplier') {
            $data['bk'] = $this->permintaan_model->baranggudangkirim();
            $data['suppp'] = $this->permintaan_model->getOrderanakt();
            $data['barsup'] = $this->barangsuplier_model->ambilbarangsuplier();
            $this->load->view('v_permintaan', $data);
        }
    }

    public function kirimordertoko()
    {
        if ($this->session->userdata('lvl') == 'Gudang') {
            $idbar = $this->input->post('idbar');
            $kode = $this->input->post('id');
            $product = $this->permintaan_model->kirimorderan($idbar, $kode);
            $i = $product->row_array();

            $data = array(
                'id' => $i['no_barang'],
                'kodebar' => $i['kode_barang'],
                'kode' => $i['kode_order'],
                'tk' => $i['id_toko'],
                'name' => $i['nama_barang'],
                'price' => $i['hargapokok'],
                'qty' => $this->input->post('qty'),
                'toko' => $i['id_toko']
            );
            if ($i['stok_gudang'] >= $this->input->post('qty')) {
                $this->cart->insert($data);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Untuk Dikirim Ketoko!!</div>');
                redirect('permintaan');
            } else if ($i['stok_gudang'] <= 0) {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Stok Anda Kurang! Silakan Pesan Kesuplier</div>');
                redirect('permintaan');
            }
        } else if ($this->session->userdata('lvl') == 'Suplier') {
            $idbar = $this->input->post('idbar');
            $product = $this->permintaan_model->getOrderanaktkirm($idbar);
            $i = $product->row_array();

            $data = array(
                'id' => $i['no_barang'],
                'kode' => $i['kode_order'],
                'kodebar' => $i['kode_barang'],
                'name' => $i['nama_barang'],
                'price' => $i['hargapokok'],
                'qty' => $i['jumlah'],
                'toko' => $i['id_toko']
            );

            $this->cart->insert($data);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Untuk Dikirim Ketoko!!</div>');
            redirect('permintaan');
        }
    }

    public function removeorderan($rowid)
    {
        if ($this->session->userdata('lvl') == 'Gudang') {
            $removed_order = array(
                'rowid'         => $rowid,
                'qty'           => 0
            );
            $this->cart->update($removed_order);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menghapus Data Yang Dikirim!!</div>');
            redirect('permintaan', 'refresh');
        } else if ($this->session->userdata('lvl') == 'Suplier') {
            $removed_order = array(
                'rowid'         => $rowid,
                'qty'           => 0
            );
            $this->cart->update($removed_order);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menghapus Data Yang Dikirim!!</div>');
            redirect('permintaan', 'refresh');
        }
    }

    public function kirimketoko()
    {
        if ($this->session->userdata('lvl') != 'Gudang') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Gudang') {
            $idbar = $this->input->post('id');
            $product = $this->permintaan_model->baranggudangkirimbaru($idbar);
            $i = $product->row_array();

            $data = array(
                'id' => $i['no_barang'],
                'kodebar' => $i['kode_barang'],
                'name' => $i['nama_barang'],
                'price' => $i['hargapokok'],
                'qty' => $this->input->post('qty'),
            );

            if ($i['stok_gudang'] >= $i['jumlah']) {
                $this->cart->insert($data);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Untuk Dikirim Ketoko!!</div>');
                redirect('permintaan');
            } else if ($i['stok_gudang'] <= 0) {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Stok Anda Kurang! Silakan Pesan Kesuplier</div>');
                redirect('permintaan');
            }
        }
    }

    public function cetaksuratjalankirimtoko()
    {
        $data['sj'] = $this->permintaan_model->cetaksuratjalankirimtoko();
        $this->load->view('laporan/v_cetaksuratjalantoko', $data);
    }

    public function insertpermintaan()
    {
        if ($this->session->userdata('lvl') == 'Gudang') {
            $namatoko = $this->input->post('kirimke');
            $kode = $this->permintaan_model->kode();
            $total = $this->input->post('total');
            $username = $this->session->userdata('username');
            $pesan = $this->input->post('pesan');
            $this->session->set_userdata('no_stokin', $kode);
            $simpan = $this->permintaan_model->simpankirimantoko($kode, $total, $namatoko, $pesan, $username);
            if ($simpan) {
                $this->cart->destroy();
                redirect('permintaan/cetaksuratjalankirimtoko', 'refresh');
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Kirim Data Barang !!</div>');
            }
        } else if ($this->session->userdata('lvl') == 'Suplier') {
            $kode = $this->permintaan_model->kodekirimsup();
            $total = $this->cart->total();
            $username = $this->session->userdata('username');
            $idsup = $this->session->userdata('idsup');
            $this->session->set_userdata('kode_stokin', $kode);

            $simpan = $this->permintaan_model->kirimsuplier($kode, $total, $username, $idsup);
            if ($simpan) {
                $this->cart->destroy();
                redirect('permintaan/cetakdatakirimsuplier', 'refresh');
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Kirim Data Barang !!</div>');
            }
        }
    }

    //saat gudang tidak ada stok maka akan melakukan order ketoko yang stoknya ada dan banyak karna penjualan sedikit
    public function cetakpoketoko()
    {
        $data['po'] = $this->permintaan_model->cetakpoketoko();
        $this->load->view('laporan/v_cetakpoketoko', $data);
    }

    public function orderketoko()
    {
        $username = $this->session->userdata('username');
        $ambilkode = $this->orderbarang_model->kodeordergudang();
        $namatoko = $this->input->post('orderke');
        $total = $this->input->post('total');
        $pesan = $this->input->post('pesan');
        $this->session->set_userdata('kode_order', $ambilkode);
        $simpanorder = $this->permintaan_model->saveorderketoko($ambilkode, $total, $namatoko, $pesan, $username);

        if ($simpanorder) {
            $this->cart->destroy();
            redirect('permintaan/cetakpoketoko', 'refresh');
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Order Ketoko!!</div>');
        }
    }

    public function krmbarusuplier()
    {
        $idbar = $this->input->post('id');
        $product = $this->barangsuplier_model->ambilbarangsuplierid($idbar);
        $i = $product->row_array();
        $data = array(
            'id' => $i['no_barang'],
            'kodebar' => $i['kode_barang'],
            'name' => $i['nama_barang'],
            'price' => $this->input->post('harga'),
            'qty' => $this->input->post('qty'),
        );
        // echo json_encode($data);
        // die;
        $this->cart->insert($data);
        echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Untuk Dikirim!!</div>');
        redirect('permintaan');
    }

    //cetakdatakirimansuplierkegudang
    public function cetakdatakirimsuplier()
    {
        $data['s'] = $this->permintaan_model->getsuplier();
        $data['krs'] = $this->permintaan_model->cetaksuratjalankirimsuplier();
        $this->load->view('laporan/v_cetakkirimsuplier', $data);
    }
}
