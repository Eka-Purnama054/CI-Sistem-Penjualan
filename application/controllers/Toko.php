<?php

class Toko extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('toko_model');
        $this->load->library('form_validation');
        $this->load->helper('string');
    }

    public function index()
    {
        $data['tk'] = $this->toko_model->getToko();
        $this->load->view('v_toko', $data);
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Sesuaikan Inputan Anda</div>');
            redirect('toko', 'refresh');
        } else {
            $data = array(
                'nama_toko' => $this->input->post('nama'),
                'alamat_toko' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('telp'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('toko', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
            redirect('toko', 'refresh');
        }
        redirect('toko', 'refresh');
    }

    public function validasi()
    {
        $this->load->view('validasidata/v_validasitoko');
    }

    public function ownerupdate()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'nama_toko' => $this->input->post('nama'),
            'alamat_toko' => $this->input->post('alamat'),
            'no_telp' => $this->input->post('telp'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->update('toko', $data, array('id_toko' => $this->input->post('id')));
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
        redirect('toko', 'refresh');
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->input->post('id');
        $namatoko = $this->input->post('namatoko');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $datatoko = $this->db->get_where('toko', array('id_toko' => $id))->row();

        $datases = array(
            'idtoko' => $datatoko->id_toko,
            'namatoko' => $namatoko,
            'alamat' => $alamat,
            'telp' => $telp,
        );
        // echo json_encode($datases);
        // die;
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
            redirect('toko/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('toko/validasi');
        }
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
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Kode OTP tidak valid</div>');
                redirect('toko/validasi');
            } else { //jika otp sudah benar maka session akan berubah menjadi sukseslogin
                $id = $this->session->userdata('idtoko');
                $namatoko = $this->session->userdata('namatoko');
                $alamat = $this->session->userdata('alamat');
                $telp = $this->session->userdata('telp');
                $updatetoko = $this->toko_model->updatetoko($id, $namatoko, $alamat, $telp);
                if ($updatetoko) {
                    $this->session->unset_userdata('idtoko');
                    $this->session->unset_userdata('namatoko');
                    $this->session->unset_userdata('alamat');
                    $this->session->unset_userdata('telp');

                    $this->db->set('status', 'N');
                    $this->db->where('email', $this->session->userdata('username'));
                    $this->db->update('kodeotp');
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
                    redirect('toko');
                    return true;
                }
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Kode OTP tidak valid</div>');
            redirect('toko');
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
            redirect('toko/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->where('email', $this->session->userdata('username'));
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('toko/validasi');
        }
    }
}
