<?php

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('string');
        $this->load->model('users_model');
    }

    public function index()
    {
        $data['supp'] = $this->db->from('suplier')->order_by('nama_suplier', 'ASC')->get()->result();
        $data['toko'] = $this->db->from('toko')->order_by('nama_toko', 'ASC')->get()->result();
        $data['us'] = $this->users_model->dataUser();
        $this->load->view('v_user', $data);
    }

    public function profile()
    {
        $this->load->view('v_profile');
    }

    public function validasinon()
    {
        $this->load->view('validasidata/v_nonaktifuser');
    }

    public function insert()
    {
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $level = $this->input->post('level');
        $idtoko = $this->input->post('toko');
        $alamat = $this->input->post('alamat');
        $jk = $this->input->post('jk');
        $telp = $this->input->post('telp');
        $idsuplier = $this->input->post('supplier');
        if ($level == 'Kasir') {
            $data = array(
                'username' => $username,
                'name' => $nama,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1,
                'level' => $level,
                'id_toko' => $idtoko,
                'no_telp' => $telp,
                'alamat' => $alamat,
                'gender' => $jk,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('users', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
            redirect('user', 'refresh');
        } else if ($level == 'Suplier') {
            $data = array(
                'username' => $username,
                'name' => $nama,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1,
                'level' => $level,
                'no_telp' => $telp,
                'alamat' => $alamat,
                'gender' => $jk,
                'id_suplier' => $idsuplier,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('users', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
            redirect('user', 'refresh');
        } else if ($level == 'Admin' || $level == 'Gudang') {
            $data = array(
                'username' => $username,
                'name' => $nama,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1,
                'level' => $level,
                'no_telp' => $telp,
                'alamat' => $alamat,
                'gender' => $jk,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('users', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
            redirect('user', 'refresh');
        }
    }

    public function nonaktifkan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $datauser = $this->db->get_where('users', array('username' => $username))->row();

        $datases = array(
            'nameuser' => $datauser->username,
            'name' => $nama,
            'status' => 0,
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
            redirect('user/validasinon');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('user/validasinon');
        }
    }

    public function nonaktifproses()
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
                redirect('user/validasi');
            } else { //jika otp sudah benar maka session akan berubah menjadi sukseslogin
                $status = $this->session->userdata('status');
                $username = $this->session->userdata('nameuser');
                $update = $this->users_model->nonaktifuser($status, $username);
                if ($update) {
                    $this->session->unset_userdata('status');
                    $this->session->unset_userdata('nameuser');

                    $this->db->set('status', 'N');
                    $this->db->where('email', $this->session->userdata('username'));
                    $this->db->update('kodeotp');
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
                    redirect('user');
                    return true;
                }
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Kode OTP tidak valid</div>');
            redirect('user');
        }
    }

    public function validasi()
    {
        $this->load->view('validasidata/v_validasiuser');
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $level = $this->input->post('options');
        $idtoko = $this->input->post('toko');
        $idsuplier = $this->input->post('supplier');
        $alamat = $this->input->post('alamat');
        $jk = $this->input->post('jk');
        $telp = $this->input->post('telp');
        $datauser = $this->db->get_where('users', array('username' => $username))->row();

        if ($level == 'Kasir') {
            $datases = array(
                'nameuser' => $datauser->username,
                'namauser' => $nama,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1,
                'level' => $level,
                'no_telp' => $telp,
                'almt' => $alamat,
                'gender' => $jk,
                'idtoko' => $idtoko,
            );
            $this->session->set_userdata($datases);
        } else if ($level == 'Suplier') {
            $datases = array(
                'nameuser' => $username,
                'namauser' => $nama,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1,
                'level' => $level,
                'no_telp' => $telp,
                'almt' => $alamat,
                'gender' => $jk,
                'idsuplier' => $idsuplier,
            );
            $this->session->set_userdata($datases);
        } else if ($level == 'Admin' || $level == 'Gudang') {
            $datases = array(
                'nameuser' => $username,
                'namauser' => $nama,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1,
                'level' => $level,
                'no_telp' => $telp,
                'almt' => $alamat,
                'gender' => $jk,
            );
            $this->session->set_userdata($datases);
        }

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
            redirect('user/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('user/validasi');
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
                redirect('user/validasi');
            } else { //jika otp sudah benar maka session akan berubah menjadi sukseslogin
                $username = $this->session->userdata('nameuser');
                $nama = $this->session->userdata('namauser');
                $password = $this->session->userdata('password');
                $level = $this->session->userdata('level');
                $idtoko = $this->session->userdata('idtoko');
                $alamat = $this->session->userdata('almt');
                $jk = $this->session->userdata('gender');
                $telp = $this->session->userdata('no_telp');
                $idsuplier = $this->session->userdata('idsuplier');
                $status = $this->session->userdata('status');
                $updateuser = $this->users_model->updateuser($username, $nama, $password, $telp, $alamat, $jk, $status, $level, $idtoko, $idsuplier);
                if ($updateuser) {
                    $this->session->unset_userdata('idtoko');
                    $this->session->unset_userdata('nameuser');
                    $this->session->unset_userdata('namauser');
                    $this->session->unset_userdata('password');
                    $this->session->unset_userdata('idsuplier');
                    $this->session->unset_userdata('almt');
                    $this->session->unset_userdata('gender');
                    $this->session->unset_userdata('no_telp');
                    $this->session->unset_userdata('status');
                    $this->session->unset_userdata('level');

                    $this->db->set('status', 'N');
                    $this->db->where('email', $this->session->userdata('username'));
                    $this->db->update('kodeotp');
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
                    redirect('user');
                    return true;
                }
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Kode OTP tidak valid</div>');
            redirect('user');
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
            redirect('user/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->where('email', $this->session->userdata('username'));
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('user/validasi');
        }
    }

    public function updateowner()
    {
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $level = $this->input->post('options');
        $idtoko = $this->input->post('toko');
        $idsuplier = $this->input->post('supplier');
        $alamat = $this->input->post('alamat');
        $jk = $this->input->post('jk');
        $telp = $this->input->post('telp');
        $status = 1;
        $this->users_model->updateuser($username, $nama, $password, $telp, $alamat, $jk, $status, $level, $idtoko, $idsuplier);
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
        redirect('user', 'refresh');
    }

    public function ownernonaktif()
    {
        $username = $this->input->post('username');
        $status = 0;
        $this->users_model->nonaktifuser($status, $username);
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Nonaktifkan data</div>');
        redirect('user', 'refresh');
    }
}
