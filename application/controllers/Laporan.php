<?php

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('laporan_model');
        $this->load->model('toko_model');
    }
    public function index()
    {
        $data['t'] = $this->toko_model->getToko();
        $data['toko'] = $this->db->from('toko')->order_by('nama_toko', 'ASC')->get()->result();
        $data['trans'] = $this->laporan_model->dttransaksiadmin();
        $this->load->view('laporan/v_laporantoko', $data);
    }

    public function lappentokoadmin()
    {
        $tanggal = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $toko = $this->input->post('toko');
        $this->session->set_userdata('tanggal', $tanggal);
        $this->session->set_userdata('sampai', $sampai);
        $data['t'] = $this->laporan_model->getUser();
        $data['laptoko'] = $this->laporan_model->laptokopertgladmin($tanggal, $sampai, $toko);
        $data['tlaptoko'] = $this->laporan_model->totpenadmin($tanggal, $sampai, $toko);
        $data['n'] = $this->laporan_model->nama($tanggal, $sampai, $toko);
        $this->load->view('laporan/v_laporantokoprint', $data);
    }

    public function laptokoperkasir()
    {
        $data['trans'] = $this->laporan_model->dttransaksiadmin();
        $data['user'] = $this->db->from('users')->where('id_toko !=', '(NULL)')->order_by('username', 'ASC')->get()->result();
        $this->load->view('laporan/v_penjualankasir', $data);
    }

    public function lpenjkasir()
    {
        $tanggal = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $kasir = $this->input->post('kasir');
        $this->session->set_userdata('tanggal', $tanggal);
        $this->session->set_userdata('sampai', $sampai);
        $this->session->set_userdata('kasir', $kasir);
        $data['kasir'] = $this->laporan_model->laptokoperkasir($tanggal, $sampai, $kasir);
        $data['total'] = $this->laporan_model->totpentokoperkasir($tanggal, $sampai, $kasir);
        $this->load->view('laporan/v_printpenkasir', $data);
    }

    public function tampiltokolap()
    {
        $data['t'] = $this->toko_model->getToko();
        $this->load->view('laporan/v_tampiltoko', $data);
    }
    public function lapbarangtoko($id)
    {
        $data['n'] = $this->laporan_model->lbarangtokon($id);
        $data['bar'] = $this->laporan_model->lbarangtoko($id);
        $this->load->view('laporan/v_laporanbarangtoko', $data);
    }
    public function lbaranggudang()
    {
        $data['g'] = $this->laporan_model->lapbaranggudang();
        $this->load->view('laporan/v_laporanbaranggudang', $data);
    }

    public function lorderbarangt()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $data['t'] = $this->laporan_model->getUser();
            $data['or'] = $this->laporan_model->lapOrdertoko();
            $this->load->view('laporan/v_ldataordertoko', $data);
        }
    }
    public function lreturtoko()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $data['t'] = $this->laporan_model->getUser();
            $data['rt'] = $this->laporan_model->lreturtoko();
            $this->load->view('laporan/v_ldatareturtoko', $data);
        }
    }
    public function lpertglreturtoko()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $tanggal = $this->input->post('tanggal');
            $sampai = $this->input->post('sampai');
            $data['t'] = $this->laporan_model->getUser();
            $data['rt'] = $this->laporan_model->lpertglreturtoko($tanggal, $sampai);
            $this->load->view('laporan/v_lreturtoko', $data);
        }
    }

    public function lpenjualantoko()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $idtoko = $this->session->userdata('idtoko');
            $data['nomor'] = $this->db->from('transaksi')->where('id_toko =', $idtoko)->order_by('no_faktur', 'ASC')->get()->result();
            $data['trans'] = $this->laporan_model->datatransaksi();
            $this->load->view('laporan/v_lappenjualan', $data);
        }
    }

    public function cetak_struk()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $nofaktur = $this->input->post('nofaktur');
            $data['trans'] = $this->laporan_model->cetakstruktoko($nofaktur);
            $this->load->view('laporan/v_cetak_struk', $data);
        }
    }

    public function lappentanggal()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $tanggal = $this->input->post('tanggal');
            $sampai = $this->input->post('sampai');
            $data['t'] = $this->laporan_model->getUser();
            $data['pertgl'] = $this->laporan_model->laptokopertgl($tanggal, $sampai);
            $data['totpertgl'] = $this->laporan_model->totpentokopertgl($tanggal, $sampai);
            $this->load->view('laporan/v_lappertglprint', $data);
        }
    }

    public function lpertanggalorder()
    {
        if ($this->session->userdata('lvl') != 'Kasir') {
            echo "halaman kosong";
        } else if ($this->session->userdata('lvl') == 'Kasir') {
            $tanggal = $this->input->post('tanggal');
            $sampai = $this->input->post('sampai');
            $data['t'] = $this->laporan_model->getUser();
            $data['op'] = $this->laporan_model->lapOrdertokoprint($tanggal, $sampai);
            $this->load->view('laporan/v_lorderbarangtoko', $data);
        }
    }

    public function lretursuplier()
    {
        $data['retur'] = $this->laporan_model->lretursuplier();
        $this->load->view('laporan/v_lretursuplier', $data);
    }

    public function lretursupliertgl()
    {
        $tanggal = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $data['retur'] = $this->laporan_model->lretursupliertgl($tanggal, $sampai);
        $this->load->view('laporan/v_lretursupprint', $data);
    }

    public function datareturtoko()
    {
        $data['detail'] = $this->laporan_model->datareturtoko();
        $data['toko'] = $this->db->from('toko')->order_by('nama_toko', 'ASC')->get()->result();
        $data['noretur'] = $this->db->from('stok_out')->order_by('kode_stokout', 'ASC')->get()->result();
        $this->load->view('laporan/v_cetakreturtoko', $data);
    }

    public function cetakdatareturtoko()
    {
        $tanggal = $this->input->post('tanggal');
        $sampai = $this->input->post('sampai');
        $toko = $this->input->post('toko');
        $data['retur'] = $this->laporan_model->cetakdatareturtoko($tanggal, $sampai, $toko);
        $data['tot'] = $this->laporan_model->cetakgrandtotal($tanggal, $sampai);
        $this->load->view('laporan/v_printreturtoko', $data);
    }

    public function cetaknoreturtoko()
    {
        $id = $this->input->post('noretur');
        $data['norttk'] = $this->laporan_model->cetaknoreturtoko($id);
        $this->load->view('laporan/v_cetaknoreturtoko', $data);
    }

    public function datakirimbarang()
    {
        $this->load->view('laporan/v_kirimbarangketoko');
    }
}
