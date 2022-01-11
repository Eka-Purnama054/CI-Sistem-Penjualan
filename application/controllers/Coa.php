<?php

class Coa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('coa_model');
        $this->load->helper('string');
    }

    public function index()
    {
        $data['c'] = $this->db->from('coa')->order_by('nama_akun', 'ASC')->get()->result();
        $data['coa'] = $this->coa_model->coa();
        $this->load->view('v_coa', $data);
    }
    public function halamantambahcoa()
    {
        $data['c'] = $this->db->from('coa')->order_by('kode_akun', 'ASC')->get()->result();
        $this->load->view('v_tambahcoa', $data);
    }

    public function getsubakun()
    {
        $kodecoa = $this->input->post('kode');
        $data = $this->db->from('coa')->where('is_kode_akun =', $kodecoa)->order_by('kode_akun', 'DESC')->get()->result();
        echo json_encode($data);
    }

    public function insert()
    {
        $kodecoa = $this->input->post('subkodeakun');
        $kode = $this->input->post('kode');
        $data = array(
            'kode_akun' => $this->coa_model->kode_coa($kodecoa, $kode),
            'nama_akun' => $this->input->post('namaakun'),
            'is_kode_akun' => $this->input->post('iskodeakun'),
        );
        $this->db->insert('coa', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
        redirect('coa/halamantambahcoa', 'refresh');
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $kode = $this->input->post('kodeakun');
        $nama = $this->input->post('namaakun');
        $datacoa = $this->db->get_where('coa', array('kode_akun' => $kode))->row();

        $datases = array(
            'kodeakun' => $datacoa->kode_akun,
            'namaakun' => $nama,
        );

        $this->session->set_userdata($datases);

        //random kode otp sejumlah 4 digit, jika teman-teman ingin 6 digit silahkan ubah 4 menjadi 6
        $kodeOtp =  random_string('numeric', 4);                 //menentukan lama kode otp berlaku, disini saya set menjadi 10 menit, jika ingin mengubah menjadi 5 menit ubah +10 menjadi +5
        $tanggalSekarang = date('Y-m-d H:i:s');
        $datetime = new DateTime($tanggalSekarang);
        $datetime->modify('+1 hour,+15 minutes');
        $tanggalKadaluarsa = $datetime->format('Y-m-d H:i:s');

        $data = array(
            'email'         => $this->session->userdata('username'),
            'kode'             => $kodeOtp,
            'tanggal_buat' => $tanggalSekarang,
            'tanggal_kadaluarsa'     => $tanggalKadaluarsa,
            'status'         => 'Y'
        );

        //memasukkan kode otp kedalam tabel kodeotp
        $this->db->insert('kodeotp', $data);
        //mengirim sms kode otp ke nomor yang terdaftar pada tabel akunuser, pastikan nomor aktif
        $email_api = urlencode("ekapurnama054@gmail.com"); //ubah dengan email medan sms kalian
        $passkey_api = urlencode("Hm123123"); //ubah dengan api key medan sms kalian
        $no_hp_tujuan = urlencode("081339362968");
        $isi_pesan = urlencode("Kode OTP : " . $kodeOtp);

        $url = "https://reguler.medansms.co.id/sms_api.php?action=kirim_sms&email=" . $email_api . "&passkey=" . $passkey_api . "&no_tujuan=" . $no_hp_tujuan . "&pesan=" . $isi_pesan;
        $result = file_get_contents($url);
        $data = explode("~~~", $result);
        //jika sms terkirim maka akan mengarah ke halaman validasi
        if ($data[0] == 1) {
            redirect('coa/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->update('kodeotp');
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> kode otp gagal dikirim, silahkan coba kembali</div>');
        }
    }

    public function validasi()
    {
        $this->load->view('validasidata/v_validasicoa');
    }

    public function updatedata()
    {
        date_default_timezone_set('Asia/Jakarta');
        $kode = $this->input->post('kodeotp');
        $waktuSekarang = date('Y-m-d H:i:s');
        //cek kode otp berdasarkan email, kode dan status
        $cek = $this->db->get_where('kodeotp', array('kode' => $kode, 'status' => 'Y'));

        if ($cek->num_rows() > 0) {
            $cek = $cek->row();
            if ($waktuSekarang > $cek->tanggal_kadaluarsa) {
                $this->session->set_flashdata('gagal', "Kode OTP tidak valid");
                redirect('coa/validasi');
            } else { //jika otp sudah benar maka session akan berubah menjadi sukseslogin
                $kode = $this->session->userdata('kodeakun');
                $nama = $this->session->userdata('namaakun');
                $updatecoa = $this->coa_model->updatecoa($kode, $nama);
                if ($updatecoa) {
                    $this->session->unset_userdata('kodeakun');
                    $this->session->unset_userdata('namaakun');
                    $this->db->set('status', 'N');
                    $this->db->where('email', $this->session->userdata('username'));
                    $this->db->update('kodeotp');
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
                    redirect('coa');
                    return true;
                }
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Kode OTP tidak valid</div>');
            redirect('coa');
        }
    }

    public function kirimulang()
    {
        date_default_timezone_set('Asia/Jakarta');
        $kodeOtp =  random_string('numeric', 4);                 //menentukan lama kode otp berlaku, disini saya set menjadi 10 menit, jika ingin mengubah menjadi 5 menit ubah +10 menjadi +5
        $tanggalSekarang = date('Y-m-d H:i:s');
        $datetime = new DateTime($tanggalSekarang);
        $datetime->modify('+1 hour,+15 minutes');
        $tanggalKadaluarsa = $datetime->format('Y-m-d H:i:s');

        $this->db->set('status', 'N');
        $this->db->where('email', $this->session->userdata('username'));
        $this->db->update('kodeotp');

        $data = array(
            'email'         => $this->session->userdata('username'),
            'kode'             => $kodeOtp,
            'tanggal_buat' => $tanggalSekarang,
            'tanggal_kadaluarsa'     => $tanggalKadaluarsa,
            'status'         => 'Y'
        );

        //memasukkan kode otp kedalam tabel kodeotp
        $query = $this->db->get_where('users', array('username' => $this->session->userdata('username')));
        $this->db->insert('kodeotp', $data);
        //mengirim sms kode otp ke nomor yang terdaftar pada tabel akunuser, pastikan nomor aktif
        $email_api = urlencode("ekapurnama054@gmail.com"); //ubah dengan email medan sms kalian
        $passkey_api = urlencode("Hm123123"); //ubah dengan api key medan sms kalian
        $no_hp_tujuan = urlencode("081339362968");
        $isi_pesan = urlencode("Kode OTP : " . $kodeOtp);

        $url = "https://reguler.medansms.co.id/sms_api.php?action=kirim_sms&email=" . $email_api . "&passkey=" . $passkey_api . "&no_tujuan=" . $no_hp_tujuan . "&pesan=" . $isi_pesan;
        $result = file_get_contents($url);
        $data = explode("~~~", $result);
        //jika sms terkirim maka akan mengarah ke halaman validasi
        if ($data[0] == 1) {
            $this->session->set_flashdata('sukses', "kode otp berhasil dikirim ulang");
            redirect('coa/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->where('email', $this->session->userdata('username'));
            $this->db->update('kodeotp');
            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");
        }
    }

    public function delete()
    {
        date_default_timezone_set('Asia/Jakarta');
        $kode = $this->input->post('kodeakun');
        $datacoa = $this->db->get_where('coa', array('kode_akun' => $kode))->row();

        $datases = array(
            'kodeakun' => $kode,
        );

        $this->session->set_userdata($datases);

        //random kode otp sejumlah 4 digit, jika teman-teman ingin 6 digit silahkan ubah 4 menjadi 6
        $kodeOtp =  random_string('numeric', 4);                 //menentukan lama kode otp berlaku, disini saya set menjadi 10 menit, jika ingin mengubah menjadi 5 menit ubah +10 menjadi +5
        $tanggalSekarang = date('Y-m-d H:i:s');
        $datetime = new DateTime($tanggalSekarang);
        $datetime->modify('+1 hour,+15 minutes');
        $tanggalKadaluarsa = $datetime->format('Y-m-d H:i:s');

        $data = array(
            'email'         => $this->session->userdata('username'),
            'kode'             => $kodeOtp,
            'tanggal_buat' => $tanggalSekarang,
            'tanggal_kadaluarsa'     => $tanggalKadaluarsa,
            'status'         => 'Y'
        );

        //memasukkan kode otp kedalam tabel kodeotp
        $this->db->insert('kodeotp', $data);
        //mengirim sms kode otp ke nomor yang terdaftar pada tabel akunuser, pastikan nomor aktif
        $email_api = urlencode("ekapurnama054@gmail.com"); //ubah dengan email medan sms kalian
        $passkey_api = urlencode("Hm123123"); //ubah dengan api key medan sms kalian
        $no_hp_tujuan = urlencode("081339362968");
        $isi_pesan = urlencode("Kode OTP : " . $kodeOtp);

        $url = "https://reguler.medansms.co.id/sms_api.php?action=kirim_sms&email=" . $email_api . "&passkey=" . $passkey_api . "&no_tujuan=" . $no_hp_tujuan . "&pesan=" . $isi_pesan;
        $result = file_get_contents($url);
        $data = explode("~~~", $result);
        //jika sms terkirim maka akan mengarah ke halaman validasi
        if ($data[0] == 1) {
            redirect('coa/validasihapus');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->update('kodeotp');
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> kode otp gagal dikirim, silahkan coba kembali</div>');
        }
    }

    public function validasihapus()
    {
        $this->load->view('validasidata/v_validasihapuscoa');
    }

    public function hapuscoa()
    {
        date_default_timezone_set('Asia/Jakarta');
        $kode = $this->input->post('kodeotp');
        $waktuSekarang = date('Y-m-d H:i:s');
        //cek kode otp berdasarkan email, kode dan status
        $cek = $this->db->get_where('kodeotp', array('kode' => $kode, 'status' => 'Y'));

        if ($cek->num_rows() > 0) {
            $cek = $cek->row();
            if ($waktuSekarang > $cek->tanggal_kadaluarsa) {
                $this->session->set_flashdata('gagal', "Kode OTP tidak valid");
                redirect('coa/validasihapus');
            } else { //jika otp sudah benar maka session akan berubah menjadi sukseslogin
                $kode = $this->session->userdata('kodeakun');
                $hapus = $this->coa_model->hapuscoa($kode);
                if ($hapus) {
                    $this->db->set('status', 'N');
                    $this->db->where('email', $this->session->userdata('username'));
                    $this->db->update('kodeotp');
                    $this->session->set_flashdata('msg', "<div class='alert alert-primary' role='alert'>Berhasil Hapus Dengan Kode $kode data</div>");
                    $this->session->unset_userdata('kodeakun');
                    redirect('coa');
                    return true;
                }
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Kode OTP tidak valid</div>');
            redirect('coa');
        }
    }

    public function kirimulangkode()
    {
        date_default_timezone_set('Asia/Jakarta');
        $kodeOtp =  random_string('numeric', 4);                 //menentukan lama kode otp berlaku, disini saya set menjadi 10 menit, jika ingin mengubah menjadi 5 menit ubah +10 menjadi +5
        $tanggalSekarang = date('Y-m-d H:i:s');
        $datetime = new DateTime($tanggalSekarang);
        $datetime->modify('+1 hour,+15 minutes');
        $tanggalKadaluarsa = $datetime->format('Y-m-d H:i:s');

        $this->db->set('status', 'N');
        $this->db->where('email', $this->session->userdata('username'));
        $this->db->update('kodeotp');

        $data = array(
            'email'         => $this->session->userdata('username'),
            'kode'             => $kodeOtp,
            'tanggal_buat' => $tanggalSekarang,
            'tanggal_kadaluarsa'     => $tanggalKadaluarsa,
            'status'         => 'Y'
        );

        //memasukkan kode otp kedalam tabel kodeotp
        $this->db->insert('kodeotp', $data);
        //mengirim sms kode otp ke nomor yang terdaftar pada tabel akunuser, pastikan nomor aktif
        $email_api = urlencode("ekapurnama054@gmail.com"); //ubah dengan email medan sms kalian
        $passkey_api = urlencode("Hm123123"); //ubah dengan api key medan sms kalian
        $no_hp_tujuan = urlencode("081339362968");
        $isi_pesan = urlencode("Kode OTP : " . $kodeOtp);

        $url = "https://reguler.medansms.co.id/sms_api.php?action=kirim_sms&email=" . $email_api . "&passkey=" . $passkey_api . "&no_tujuan=" . $no_hp_tujuan . "&pesan=" . $isi_pesan;
        $result = file_get_contents($url);
        $data = explode("~~~", $result);
        //jika sms terkirim maka akan mengarah ke halaman validasi
        if ($data[0] == 1) {
            $this->session->set_flashdata('sukses', "kode otp berhasil dikirim ulang");
            redirect('coa/validasihapus');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->where('email', $this->session->userdata('username'));
            $this->db->update('kodeotp');
            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");
        }
    }

    public function updateowner()
    {
        $kode = $this->input->post('kodeakun');
        $nama = $this->input->post('namaakun');
        $up = $this->coa_model->updatecoa($kode, $nama);
        if ($up) {
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
            redirect('coa');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Gagal Update data</div>');
            redirect('coa');
        }
    }

    public function deleteowner()
    {
        $kode = $this->input->post('kodeakun');
        $del = $this->coa_model->hapuscoa($kode);
        if ($del) {
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Hapus data</div>');
            redirect('coa');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Gagal Hapus data</div>');
            redirect('coa');
        }
    }
}
