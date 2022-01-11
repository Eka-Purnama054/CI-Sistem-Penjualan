<?php

class Baranggudang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('baranggudang_model');
        $this->load->library(array('excel', 'session'));
        $this->load->model('import_model');
        $this->load->model('stokout_model');
        $this->load->helper('string');
    }

    public function index()
    {
        $data['bar'] = $this->baranggudang_model->GetBaranggudang();
        $data['get'] = $this->baranggudang_model->getKirimsup();
        $data['rtt'] = $this->stokout_model->dtreturantoko();
        $data['kate'] = $this->db->from('kategori_warna')->order_by('nama_warna', 'ASC')->get()->result();
        $data['size'] = $this->db->from('kategori_size')->order_by('nama_size', 'ASC')->get()->result();
        $data['item'] = $this->db->from('kategori_item')->order_by('nama_item', 'ASC')->get()->result();
        $data['supp'] = $this->db->from('suplier')->order_by('nama_suplier', 'ASC')->get()->result();
        $data['satu'] = $this->db->from('satuan')->order_by('nama_satuan', 'ASC')->get()->result();
        $this->load->view('v_baranggudang', $data);
    }

    public function importexcel()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $kodebarang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $namabarang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $hargapokok = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $hargagrosir = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $hargajual = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $stok = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $item = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $size = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $warna = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $satuan = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $suplier = $worksheet->getCellByColumnAndRow(11, $row)->getValue();

                    //qrcode
                    $this->load->library('ciqrcode');

                    $config['cacheable']    = true; //boolean, the default is true
                    $config['cachedir']     = './assets/'; //string, the default is application/cache/
                    $config['errorlog']     = './assets/'; //string, the default is application/logs/
                    $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
                    $config['quality']      = true; //boolean, the default is true
                    $config['size']         = '1024'; //interger, the default is 1024
                    $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
                    $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
                    $this->ciqrcode->initialize($config);

                    $image_name = $item . $warna . $size . $kodebarang . '.png'; //buat name dari qr code sesuai dengan nim

                    $params['data'] = $kodebarang; //data yang akan di jadikan QR CODE
                    $params['level'] = 'H'; //H=High
                    $params['size'] = 10;
                    $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
                    $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

                    $temp_data[] = array(
                        'kode_barang'    => $item . $warna . $size . $kodebarang,
                        'nama_barang'    => $namabarang,
                        'hargapokok'    => $hargapokok,
                        'hargagrosir'    => $hargagrosir,
                        'hargajual'    => $hargajual,
                        'stok_gudang'    => $stok,
                        'kode_item'    => $item,
                        'id_size'    => $size,
                        'id_warna'    => $warna,
                        'id_satuan'    => $satuan,
                        'id_suplier'    => $suplier,
                        'qr_code' => $image_name,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                }
            }
            $insert = $this->import_model->insert($temp_data);
            if ($insert) {
                $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Table');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }

    public function insert()
    {
        $this->load->library('ciqrcode');
        $idsize = $this->input->post('size');
        $kodeitem = $this->input->post('item');
        $idwarna = $this->input->post('warna');
        $kode = $this->baranggudang_model->kodebarang($kodeitem, $idsize, $idwarna);
        // echo json_encode($kode);
        // die;
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $kode . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $kode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = array(
            'no_barang' => $this->baranggudang_model->nobarang(),
            'kode_barang' => $kode,
            'nama_barang' => $this->input->post('nama'),
            'hargajual' => $this->input->post('harjul'),
            'hargagrosir' => $this->input->post('hargro'),
            'hargapokok' => $this->input->post('harpok'),
            'stok_gudang' => $this->input->post('stok'),
            'id_satuan' => $this->input->post('satuan'),
            'id_warna' => $idwarna,
            'id_suplier' => $this->input->post('suplier'),
            'id_size' => $idsize,
            'kode_item' => $kodeitem,
            'qr_code' => $image_name,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('baranggudang', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Tambah data</div>');
        redirect('baranggudang', 'refresh');
    }

    public function validasi()
    {
        $this->load->view('validasidata/v_vbaranggudang');
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->input->post('nobarang');
        $nama_brg = $this->input->post('nama');
        $harpok = $this->input->post('harpok');
        $hargro = $this->input->post('hargro');
        $harjul = $this->input->post('harjul');
        $stok = $this->input->post('stok');
        $idsatuan = $this->input->post('satuan');
        $kategori = $this->input->post('kategori');
        $suplier = $this->input->post('suplier');
        $idsize = $this->input->post('size');
        $kodeitem = $this->input->post('item');
        $databarang = $this->db->get_where('baranggudang', array('no_barang' => $id))->row();

        $datases = array(
            'idbarang' => $databarang->no_barang,
            'kodebarang' => $kodeitem . $kategori . $idsize . $id,
            'nama_brg' => $nama_brg,
            'harpok' => $harpok,
            'hargro' => $hargro,
            'harjul' => $harjul,
            'size' => $idsize,
            'item' => $kodeitem,
            'stok' => $stok,
            'satuan' => $idsatuan,
            'suplier' => $suplier,
            'kategori' => $kategori,
        );

        $this->session->set_userdata($datases);

        //random kode otp sejumlah 4 digit, jika teman-teman ingin 6 digit silahkan ubah 4 menjadi 6
        $kodeOtp = random_string('numeric', 4);                 //menentukan lama kode otp berlaku, disini saya set menjadi 10 menit, jika ingin mengubah menjadi 5 menit ubah +10 menjadi +5
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
        // mengirim sms kode otp ke nomor yang terdaftar pada tabel akunuser, pastikan nomor aktif
        $email_api = urlencode("ekapurnama054@gmail.com"); //ubah dengan email medan sms kalian
        $passkey_api = urlencode("Hm123123"); //ubah dengan api key medan sms kalian
        $no_hp_tujuan = urlencode("081339362968");
        $isi_pesan = urlencode("Kode OTP : " . $kodeOtp);

        $url = "https://reguler.medansms.co.id/sms_api.php?action=kirim_sms&email=" . $email_api . "&passkey=" . $passkey_api . "&no_tujuan=" . $no_hp_tujuan . "&pesan=" . $isi_pesan;
        $result = file_get_contents($url);
        $data = explode("~~~", $result);
        //jika sms terkirim maka akan mengarah ke halaman validasi
        if ($data[0] == 1) {
            redirect('baranggudang/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->db->set('status', 'N');
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('baranggudang/validasi');
        }
    }

    public function updatedata()
    {
        $this->load->library('ciqrcode');
        $kodebrg = $this->session->userdata('kodebarang');
        $id = $this->session->userdata('idbarang');
        $namabarang = $this->session->userdata('nama_brg');
        $harpok = $this->session->userdata('harpok');
        $hargro = $this->session->userdata('hargro');
        $harjul = $this->session->userdata('harjul');
        $size =  $this->session->userdata('size');
        $stok = $this->session->userdata('stok');
        $idsatuan = $this->session->userdata('satuan');
        $kategori = $this->session->userdata('kategori');
        $suplier = $this->session->userdata('suplier');

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $kodebrg . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $kodebrg; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        date_default_timezone_set('Asia/Jakarta');
        $kodeOtp = $this->input->post('kodeotp');
        $waktuSekarang = date('Y-m-d H:i:s');
        //cek kode otp berdasarkan email, kode dan status
        $cek = $this->db->get_where('kodeotp', array('kode' => $kodeOtp, 'status' => 'Y'));
        if ($cek->num_rows() > 0) {
            $cek = $cek->row();
            if ($waktuSekarang > $cek->tanggal_kadaluarsa) {
                $this->session->set_flashdata('gagal', "Kode OTP tidak valid");
                redirect('satuan/validasi');
            } else { //jika otp sudah benar maka session akan berubah menjadi sukseslogin
                $updatebarang = $this->baranggudang_model->updatebarang($id, $kodebrg, $namabarang, $harpok, $hargro, $harjul, $size, $stok, $idsatuan, $kategori, $suplier, $image_name);
                if ($updatebarang) {
                    $this->session->unset_userdata('idbarang');
                    $this->session->unset_userdata('kodebarang');
                    $this->session->unset_userdata('namabarang');
                    $this->session->unset_userdata('harpok');
                    $this->session->unset_userdata('hargro');
                    $this->session->unset_userdata('harjul');
                    $this->session->unset_userdata('size');
                    $this->session->unset_userdata('item');
                    $this->session->unset_userdata('stok');
                    $this->session->unset_userdata('satuan');
                    $this->session->unset_userdata('kategori');
                    $this->session->unset_userdata('suplier');
                    $this->session->unset_userdata('kode');

                    $this->db->set('status', 'N');
                    $this->db->where('email', $this->session->userdata('username'));
                    $this->db->update('kodeotp');
                    redirect('baranggudang');
                    return true;
                }
            }
        } else {
            $this->session->set_flashdata('gagal', "Kode OTP tidak valid");
            redirect('baranggudang');
        }
    }

    public function kirimulang()
    {
        //random kode otp sejumlah 4 digit, jika teman-teman ingin 6 digit silahkan ubah 4 menjadi 6
        $kodeOtp = random_string('numeric', 4);                 //menentukan lama kode otp berlaku, disini saya set menjadi 10 menit, jika ingin mengubah menjadi 5 menit ubah +10 menjadi +5
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
            redirect('baranggudang/validasi');
        } else {
            //jika sms tidak terkirim makan tetap pada halaman login dan mengubah status kode otp menjadi N (tidak aktif)
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('namabarang');
            $this->session->unset_userdata('harpok');
            $this->session->unset_userdata('hargro');
            $this->session->unset_userdata('harjul');
            $this->session->unset_userdata('size');
            $this->session->unset_userdata('stok');
            $this->session->unset_userdata('satuan');
            $this->session->unset_userdata('kategori');
            $this->session->unset_userdata('suplier');
            $this->session->unset_userdata('kode');

            $this->db->set('status', 'N');
            $this->db->where('email', $this->session->userdata('username'));
            $this->db->update('kodeotp');

            $this->session->set_flashdata('gagal', "kode otp gagal dikirim, silahkan coba kembali");

            redirect('baranggudang/validasi');
        }
    }

    public function delete()
    {
        $this->db->delete('baranggudang', array('no_barang' => $this->input->post('nobarang')));
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Berhasil Hapus data</div>');
        redirect('baranggudang', 'refresh');
    }

    public function terimagudang()
    {
        if ($this->session->userdata('lvl') == 'Gudang') {
            $idbar = $this->input->post('idbar');
            $id = $this->input->post('id');
            $tgl = $this->input->post('tanggal');
            $this->baranggudang_model->updatedetailstokin($tgl, $idbar, $id);
            $product = $this->baranggudang_model->getKirimsupp($idbar, $id);
            $i = $product->row_array();

            $cek = $this->db->get_where('baranggudang', ['kode_barang' => $i['kode_barang']])->row_array();

            if (!$cek) {
                $tambahstokk = array(
                    'kode_barang' => $i['kode_barang'],
                    'stok_gudang' => $i['jumlah'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('baranggudang', $tambahstokk);

                echo $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Data Barang Dari Pengiriman!!Silakan Cek Barang Toko!</div>');
                redirect('baranggudang', 'refresh');
            } else {
                $tambahstokk = array(
                    'kode_barang' => $i['kode_barang'],
                    'hargapokok' => $i['harga'],
                    'stok_gudang' => ($cek['stok_gudang']) + ($i['jumlah']),
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                $this->db->update('baranggudang', $tambahstokk, array('kode_barang' => $cek['kode_barang']));

                $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Tambah Stok Pengiriman!! Silakan Cek Barang!</div>');
                redirect('baranggudang', 'refresh');
            }
            return true;
        }
    }

    public function ownerupdate()
    {
        $nobarang = $this->input->post('nobarang');
        $no = $this->input->post('no');
        $kode = $this->input->post('kode');
        $nama_brg = $this->input->post('nama');
        $harpok = $this->input->post('harpok');
        $hargro = $this->input->post('hargro');
        $harjul = $this->input->post('harjul');
        $stok = $this->input->post('stok');
        $idsatuan = $this->input->post('satuan');
        $kategori = $this->input->post('kategori');
        $suplier = $this->input->post('suplier');
        $idsize = $this->input->post('size');
        $kodeitem = $this->input->post('item');

        $this->load->library('ciqrcode');
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $kodeitem . $kategori . $idsize . $no . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $kode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = array(
            'kode_barang' => $kodeitem . $kategori . $idsize . $no,
            'nama_barang' => $nama_brg,
            'hargajual' => $harjul,
            'hargagrosir' => $hargro,
            'hargapokok' => $harpok,
            'stok_gudang' => $stok,
            'qr_code' => $image_name,
            'id_satuan' => $idsatuan,
            'id_warna' => $kategori,
            'id_suplier' => $suplier,
            'id_size' => $idsize,
            'kode_item' => $kodeitem,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->update('baranggudang', $data, array('no_barang' => $nobarang));
        $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Update Data</div>');
        redirect('baranggudang', 'refresh');
        return true;
    }

    public function terimaretur()
    {
        $id = $this->input->post('id');
        $nobar = $this->input->post('idbar');
        $this->baranggudang_model->updatestokout($id, $nobar);
        $product = $this->baranggudang_model->terimaretur($id, $nobar);
        $i = $product->row_array();
        $cek = $this->db->get_where('baranggudang', ['kode_barang' => $i['kode_barang']])->row_array();
        if ($cek) {
            $data = array(
                'stok_gudang' => $i['jumlah'] + $cek['stok_gudang'],
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->update('baranggudang', $data, array('no_barang' => $cek['no_barang']));
            $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert"> Berhasil Menambah Stok Retur, Jangan Lupa untuk Melakukan Retur Kesuplier ya, Terimakasih</div>');
            redirect('baranggudang', 'refresh');
        }
        return true;
    }
}
