<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("users_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        iislogin();
        // tampilkan halaman login
        $this->load->view("v_login");
    }

    public function proses()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[1]|max_length[255]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]|max_length[255]');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nama = $this->input->post('nama');
            $this->users_model->register($username, $password, $nama);
            $this->session->set_flashdata('success_register', 'Proses Pendaftaran User Berhasil');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('login');
        }
    }

    public function Islogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cek = $this->db->get_where('users', ['username' => $username])->row();
        if ($cek) {
            if ($cek->status == 1) {
                if ($cek->level == 'Admin') {
                    if ($this->users_model->login_user($username, $password)) {
                        redirect('admin');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password anda salah !</div>');
                    }
                } else if ($cek->level == 'Kasir') {
                    if ($this->users_model->login_user($username, $password)) {
                        redirect('kasir');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password anda salah !</div>');
                    }
                } else if ($cek->level == 'Gudang') {
                    if ($this->users_model->login_user($username, $password)) {
                        redirect('gudang');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password anda salah !</div>');
                    }
                } else if ($cek->level == 'Owner') {
                    if ($this->users_model->login_user($username, $password)) {
                        redirect('owner');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password anda salah !</div>');
                    }
                } else if ($cek->level == 'Suplier') {
                    if ($this->users_model->login_user($username, $password)) {
                        redirect('suplier');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password anda salah !</div>');
                    }
                } else {
                    echo "Tidak Ada Data";
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Akun anda tidak aktif !</div>');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Username Anda Salah !</div>');
        }
        redirect('', 'refresh');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Anda berhasil logout !</div>');
        $this->load->view('v_login');
    }

    public function err()
    {
        $this->load->view('v_404');
    }
}
