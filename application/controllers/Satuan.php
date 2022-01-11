<?php

class Satuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('satuan_model');
        $this->load->helper('string');
    }
    public function index()
    {
        $data['sat'] = $this->satuan_model->getSatuan();
        $this->load->view('v_satuan', $data);
    }

    public function insert()
    {
        $data = array(
            'nama_satuan' => $this->input->post('nama'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
        $this->db->insert('satuan', $data);
        redirect('satuan', 'refresh');
    }

    public function ownerupdate()
    {
        $data = array(
            'nama_satuan' => $this->input->post('nama'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->update('satuan', $data, array('id_satuan' => $this->input->post('id')));
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Update data</div>');
        redirect('satuan', 'refresh');
        return true;
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->input->post('id');
        $namasatuan = $this->input->post('nama');
        $datasatuan = $this->db->get_where('satuan', array('id_satuan' => $id))->row();

        $datases = array(
            'idsatuan' => $datasatuan->id_satuan,
            'namasatuan' => $namasatuan,
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
            redirect('satuan/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('satuan/validasi');
        }
    }

    public function validasi()
    {
        $this->load->view('validasidata/v_validasisatuan');
    }

    public function validasiproses()
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
                redirect('satuan/validasi');
            } else { //jika otp sudah benar maka session akan berubah menjadi sukseslogin
                $id = $this->session->userdata('idsatuan');
                $namasatuan = $this->session->userdata('namasatuan');
                $updatesatuan = $this->satuan_model->update($namasatuan, $id);
                if ($updatesatuan) {
                    $this->session->unset_userdata('idsatuan');
                    $this->session->unset_userdata('namasatuan');
                    $this->db->set('status', 'N');
                    $this->db->where('email', $this->session->userdata('username'));
                    $this->db->update('kodeotp');
                    redirect('satuan');
                    return true;
                }
            }
        } else {
            $this->session->set_flashdata('gagal', "Kode OTP tidak valid");
            redirect('satuan');
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
            redirect('satuan/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->session->unset_userdata('idsatuan');
            $this->session->unset_userdata('namasatuan');
            $this->db->set('status', 'N');
            $this->db->where('email', $this->session->userdata('username'));
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('satuan/validasi');
        }
    }

    public function delete()
    {
        $this->db->delete('satuan', array('id_satuan' => $this->input->post('id')));
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Hapus data</div>');
        redirect('satuan', 'refresh');
    }
}
