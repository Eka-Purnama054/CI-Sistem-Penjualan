<?php

class Stokout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('permintaan_model');
        $this->load->model('stokout_model');
        $this->load->library('cart');
    }

    public function index()
    {
        $data['stok'] = $this->stokout_model->ambilstok();
        $data['kodestokout'] = $this->stokout_model->kodeunik();
        $data['toko'] = $this->db->from('toko')->where('id_toko !=', $this->session->userdata('idtoko'))->order_by('nama_toko', 'ASC')->get()->result();
        $this->load->view('v_kirimtoko', $data);
    }

    public function returkegudang()
    {
        $data['db'] = $this->stokout_model->databar();
        $data['kodestokout'] = $this->stokout_model->kodeunik();
        $data['toko'] = $this->db->from('toko')->where('id_toko !=', $this->session->userdata('idtoko'))->order_by('nama_toko', 'ASC')->get()->result();
        $this->load->view('v_kirimgudang', $data);
    }

    public function dataretur()
    {
        $data['dretur'] = $this->stokout_model->dataretur();
        $this->load->view('v_datareturtoko', $data);
    }
    public function datareturtoko()
    {
        $data['rstoko'] = $this->stokout_model->dataretur();
        $this->load->view('v_datareturtoko', $data);
    }

    public function returdarigudang()
    {
        $data['bk'] = $this->permintaan_model->baranggudangkirim();
        $data['supp'] = $this->db->from('suplier')->order_by('nama_suplier', 'ASC')->get()->result();
        $this->load->view('v_returdarigudang', $data);
    }

    public function cetakfakturreturtoko()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $data['ctk'] = $this->stokout_model->cetakfakturreturtoko();
            $data['us'] = $this->stokout_model->getUser();
            $this->load->view('laporan/v_cetakfaktureturtoko', $data);
        }
    }

    public function addretur()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $idbar = $this->input->post('idbar');
            $kode = $this->input->post('id');
            $product = $this->stokout_model->returketoko($idbar, $kode);
            $i = $product->row_array();
            $data = array(
                'id' => $i['no_barang'],
                'kode' => $i['kode_order'],
                'kodebar' => $i['kode_barang'],
                'name' => $i['nama_barang'],
                'price' => $i['hargapokok'],
                'qty' => $i['jumlah'],
            );

            if ($i['stok_toko'] >= $this->input->post('qty')) {
                $this->cart->insert($data);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Retur!!</div>');
                redirect('stokout');
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Stok Anda Kurang</div>');
                redirect('stokout');
            }
        }
    }
    public function addreturr()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $kode = $this->input->post('kode');
            $product = $this->stokout_model->returgudang($kode);
            $i = $product->row_array();

            $data = array(
                'id' => $i['no_barang'],
                'kodebar' => $i['kode_barang'],
                'name' => $i['nama_barang'],
                'price' => $i['hargapokok'],
                'qty' => $this->input->post('qty'),
                'amount' => str_replace(",", "", $this->input->post('harjul')),
            );
            if ($i['stok_toko'] >= $this->input->post('qty')) {
                $this->cart->insert($data);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Retur!!</div>');
                redirect('stokout/returkegudang');
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Stok Anda Kurang</div>');
                redirect('stokout/returkegudang');
            }
        }
    }

    public function removeretur($rowid)
    {

        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $removed_order = array(
                'rowid'         => $rowid,
                'qty'           => 0
            );
            $this->cart->update($removed_order);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menghapus Data Retur!!</div>');
            redirect('stokout', 'refresh');
        }
    }

    public function removereturr($rowid)
    {

        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $removed_order = array(
                'rowid'         => $rowid,
                'qty'           => 0
            );
            $this->cart->update($removed_order);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menghapus Data Retur!!</div>');
            redirect('stokout/returkegudang', 'refresh');
        }
    }

    public function simpanstokout()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $namatoko = $this->input->post('tempatretur');
            $kode = $this->stokout_model->kodeunik();
            $total = $this->input->post('total');
            $username = $this->session->userdata('username');
            $pesan = $this->input->post('pesan');
            $this->session->set_userdata('no_retur', $kode);
            $simpanstokin = $this->stokout_model->simpankirimantoko($kode, $total, $namatoko, $pesan, $username);
            $simpanretur = $this->stokout_model->simpanretur($kode, $total, $namatoko, $pesan, $username);
            if ($simpanstokin) {
                if ($simpanretur) {
                    $this->cart->destroy();
                    redirect('stokout/cetakfakturreturtoko', 'refresh');
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Retur Barang!</div>');
                }
            }
        }
    }

    public function simpanstokoutt()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $kode = $this->stokout_model->kodeunik();
            $total = $this->input->post('total');
            $username = $this->session->userdata('username');
            $pesan = $this->input->post('pesan');
            $this->session->set_userdata('no_retur', $kode);
            $simpanretur = $this->stokout_model->simpanreturan($kode, $total, $pesan, $username);
            if ($simpanretur) {
                $this->cart->destroy();
                redirect('stokout/cetakfakturreturtoko', 'refresh');
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Retur Barang!!</div>');
            }
        }
    }

    public function removegudang($rowid)
    {
        if ($this->session->userdata('lvl') != 'Gudang') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Gudang') {
            $removed_order = array(
                'rowid'         => $rowid,
                'qty'           => 0
            );
            $this->cart->update($removed_order);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menghapus Data Retur!!</div>');
            redirect('stokout/returdarigudang', 'refresh');
        }
    }

    public function addreturdarigudang()
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
                'idsup' => $i['id_suplier'],
                'name' => $i['nama_barang'],
                'price' => $i['hargajual'],
                'qty' => $this->input->post('qty'),
            );

            if ($i['stok_gudang'] >= $this->input->post('qty')) {
                $this->cart->insert($data);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Retur!!</div>');
                redirect('stokout/returdarigudang', 'refresh');
            } else if ($i['stok_gudang'] <= $this->input->post('qty')) {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Stok Anda Kurang!</div>');
                redirect('stokout/returdarigudang', 'refresh');
            }
        }
    }

    public function simpanreturdarigudang()
    {
        if ($this->session->userdata('lvl') != 'Gudang') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Gudang') {
            $kode = $this->stokout_model->koderetursuplier();
            $total = $this->cart->total();
            $ket = $this->input->post('coment');
            $this->session->set_userdata('koderetur', $kode);

            $simpan = $this->stokout_model->insertreturdarigudang($kode, $total, $ket);

            if ($simpan) {
                $this->cart->destroy();
                redirect('stokout/cetakreturkesuplier', 'refresh');
                $this->session->unset_userdata('koderetur');
                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Retur Barang!!</div>');
            }
        }
    }

    public function cetakreturkesuplier()
    {
        $data['ret'] = $this->stokout_model->getcetakreturkesuplier();
        $this->load->view('laporan/v_cetakreturkesuplier', $data);
    }
}
