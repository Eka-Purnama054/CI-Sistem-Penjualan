<?php

class Jurnalumum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jurnalumum_model');
    }

    public function index()
    {
        $data['coa'] = $this->db->from('coa')->get()->result();
        $data['akun'] = $this->jurnalumum_model->getcoaakun();
        $data['jurnal'] = $this->jurnalumum_model->getjurnal();
        $data['saldo'] = $this->jurnalumum_model->getsaldoawal();
        $this->load->view('v_jurnalumum', $data);
    }

    public function getsubakun()
    {
        $kodecoa = $this->input->post('kode');
        $data = $this->db->from('coa')->where('is_kode_akun =', $kodecoa)->order_by('kode_akun', 'DESC')->get()->result();
        echo json_encode($data);
    }

    public function getakun()
    {
        $kodecoa = $this->input->post('namaakun');
        $data = $this->db->from('coa')->where('is_kode_akun =', $kodecoa)->order_by('kode_akun', 'DESC')->get()->result();
        echo json_encode($data);
    }

    public function getakunsub()
    {
        $kodecoa = $this->input->post('coa');
        $data = $this->db->from('coa')->where('is_kode_akun =', $kodecoa)->order_by('kode_akun', 'DESC')->get()->result();
        echo json_encode($data);
    }

    public function insert()
    {
        $datet = $this->input->post('tanggal');
        $date = date_create($datet);
        $printtgl = date_format($date, "Y-m-d");
        $kode = $this->jurnalumum_model->kode();
        $coa = $this->input->post('coa');
        $namacoa = $this->input->post('namacoa');
        if (empty($namacoa)) {
            $data = array(
                'id_jurnalumum' => $kode,
                'kode_akun' => $coa,
                'tanggal' => $printtgl,
                'uraian' => $this->input->post('uraian'),
                'c_t' => $this->input->post('pembayaran'),
                'no_dc' => $this->input->post('nomor'),
                'd_c' => $this->input->post('dc'),
                'total' => $this->input->post('rupiah2'),
                'code' => $this->input->post('code'),
            );
            $c = $data['kode_akun'];
            $d = $data['total'];
            $cek = $this->db->get_where('saldo_awal', ['kode_akun' => $c])->row_array();
            if (!$cek) {
                $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Belum Ada Saldo, Silakan lakukan pengisian saldo ya, Terimakasih.</div>');
                redirect('jurnalumum', 'refresh');
            } else if ($cek) {
                if ($cek['saldo_akhir'] <= 0) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Saldo Anda Kurang, Silakan lakukan pengisian saldo ya, Terimakasih.</div>');
                    redirect('jurnalumum', 'refresh');
                } else if ($cek['saldo_akhir'] < $d) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Saldo Anda Kurang, Silakan lakukan pengisian saldo ya, Terimakasih.</div>');
                    redirect('jurnalumum', 'refresh');
                } else if ($cek['saldo_akhir'] >= $d) {
                    $up = array(
                        'saldo_akhir' => ($cek['saldo_akhir'] - $d),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'username' => $this->session->userdata('username'),
                    );
                    $this->db->update('saldo_awal', $up, array('id_saldo' => $cek['id_saldo']));
                    $this->db->insert('jurnalumum', $data);
                    $this->db->set('awal_saldo', $cek['saldo_awal']);
                    $this->db->set('akhir_saldo', $cek['saldo_akhir'] - $d);
                    $this->db->where('id_jurnalumum', $kode);
                    $this->db->update('jurnalumum');
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Data Berhasil ditambah, Terimakasih.</div>');
                    redirect('jurnalumum', 'refresh');
                    return true;
                }
            }
        } elseif (!empty($namacoa)) {
            $data = array(
                'id_jurnalumum' => $kode,
                'kode_akun' => $namacoa,
                'tanggal' => $printtgl,
                'uraian' => $this->input->post('uraian'),
                'c_t' => $this->input->post('pembayaran'),
                'no_dc' => $this->input->post('nomor'),
                'd_c' => $this->input->post('dc'),
                'total' => $this->input->post('rupiah2'),
                'code' => $this->input->post('code'),
            );
            $c = $data['kode_akun'];
            $d = $data['total'];
            $cek = $this->db->get_where('saldo_awal', ['kode_akun' => $c])->row_array();
            if (!$cek) {
                $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Belum Ada Saldo, Silakan lakukan pengisian saldo ya, Terimakasih.</div>');
                redirect('jurnalumum', 'refresh');
            } else if ($cek) {
                if ($cek['saldo_akhir'] <= 0) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Saldo Anda Kurang, Silakan lakukan pengisian saldo ya, Terimakasih.</div>');
                    redirect('jurnalumum', 'refresh');
                } else if ($cek['saldo_akhir'] < $d) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Saldo Anda Kurang, Silakan lakukan pengisian saldo ya, Terimakasih.</div>');
                    redirect('jurnalumum', 'refresh');
                } else if ($cek['saldo_akhir'] >= $d) {
                    $up = array(
                        'saldo_akhir' => ($cek['saldo_akhir'] - $d),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'username' => $this->session->userdata('username'),
                    );
                    $this->db->update('saldo_awal', $up, array('id_saldo' => $cek['id_saldo']));
                    $this->db->insert('jurnalumum', $data);
                    $this->db->set('awal_saldo', $cek['saldo_awal']);
                    $this->db->set('akhir_saldo', $cek['saldo_akhir'] - $d);
                    $this->db->where('id_jurnalumum', $kode);
                    $this->db->update('jurnalumum');
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Data Berhasil ditambah, Terimakasih.</div>');
                    redirect('jurnalumum', 'refresh');
                    return true;
                }
            }
        }
    }

    public function validasi()
    {
    }

    public function lihat()
    {
        $datet = $this->input->post('tanggal');
        $date = date_create($datet);
        $printtgl = date_format($date, "m-Y");
        $akun = $this->input->post('namaakun');
        $subakun = $this->input->post('subakun');
        if (empty($subakun)) {
            $data['debit'] = $this->jurnalumum_model->sumdebit($akun, $printtgl);
            $data['credit'] = $this->jurnalumum_model->sumcredit($akun, $printtgl);
            $data['lihatjurnal'] = $this->jurnalumum_model->lihatdata($akun, $printtgl);
            $data['akun'] = $this->jurnalumum_model->getcoaakun();
            $data['coa'] = $this->db->from('coa')->where('is_kode_akun =', '1')->get()->result();
            $data['coa2'] = $this->db->from('coa')->where('is_kode_akun =', '2')->get()->result();
            $data['coa3'] = $this->db->from('coa')->where('is_kode_akun =', '3')->get()->result();
            $data['coa4'] = $this->db->from('coa')->where('is_kode_akun =', '4')->get()->result();
            $data['coa5'] = $this->db->from('coa')->where('is_kode_akun =', '5')->get()->result();
            $data['coa7'] = $this->db->from('coa')->where('is_kode_akun =', '7')->get()->result();
            $data['coa6'] = $this->db->from('coa')->where('is_kode_akun =', '6')->get()->result();
            $this->load->view('v_jurnal', $data);
        } elseif (!empty($subakun)) {
            $data['debit'] = $this->jurnalumum_model->sumdebit($subakun, $printtgl);
            $data['credit'] = $this->jurnalumum_model->sumcredit($subakun, $printtgl);
            $data['lihatjurnal'] = $this->jurnalumum_model->lihatdata($subakun, $printtgl);
            $data['akun'] = $this->jurnalumum_model->getcoaakun();
            $data['coa'] = $this->db->from('coa')->where('is_kode_akun =', '1')->get()->result();
            $data['coa2'] = $this->db->from('coa')->where('is_kode_akun =', '2')->get()->result();
            $data['coa3'] = $this->db->from('coa')->where('is_kode_akun =', '3')->get()->result();
            $data['coa4'] = $this->db->from('coa')->where('is_kode_akun =', '4')->get()->result();
            $data['coa5'] = $this->db->from('coa')->where('is_kode_akun =', '5')->get()->result();
            $data['coa6'] = $this->db->from('coa')->where('is_kode_akun =', '6')->get()->result();
            $data['coa7'] = $this->db->from('coa')->where('is_kode_akun =', '7')->get()->result();
            $this->load->view('v_jurnal', $data);
        }
    }

    public function tambahsaldo()
    {
        $kode = $this->input->post('subakun');
        $kodeakun = $this->input->post('coa');
        if (empty($kode)) {
            $cek = $this->db->get_where('saldo_awal', ['kode_akun' => $kodeakun])->row_array();
            if (!$cek) {
                $data = array(
                    'kode_akun' => $kodeakun,
                    'saldo_awal' => $this->input->post('saldo2'),
                    'saldo_akhir' => $this->input->post('saldo2'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'username' => $this->session->userdata('username'),
                );
                $this->db->insert('saldo_awal', $data);
                $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Data Berhasil ditambah, Terimakasih.</div>');
                redirect('jurnalumum', 'refresh');
                return true;
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Sudah Ada Saldo, Tidak Bisa Ditambah Lagi, Terimakasih.</div>');
                redirect('jurnalumum', 'refresh');
            }
        } else {
            $cek = $this->db->get_where('saldo_awal', ['kode_akun' => $kode])->row_array();
            if (!$cek) {
                $data = array(
                    'kode_akun' => $kode,
                    'saldo_awal' => $this->input->post('saldo2'),
                    'saldo_akhir' => $this->input->post('saldo2'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'username' => $this->session->userdata('username'),
                );
                $this->db->insert('saldo_awal', $data);
                $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Data Berhasil ditambah, Terimakasih.</div>');
                redirect('jurnalumum', 'refresh');
                return true;
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Sudah Ada Saldo, Tidak Bisa Ditambah Lagi,Terimakasih.</div>');
                redirect('jurnalumum', 'refresh');
            }
        }
    }
}
