<?php
class Users_model extends CI_Model
{

    function register($username, $password, $nama)
    {
        $data_user = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'name' => $nama
        );
        $this->db->insert('users', $data_user);
    }

    function login_user($username, $password)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        if ($query->num_rows() > 0) {
            $data_user = $query->row();
            if (password_verify($password, $data_user->password)) {
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('nama', $data_user->name);
                $this->session->set_userdata('lvl', $data_user->level);
                $this->session->set_userdata('idtoko', $data_user->id_toko);
                $this->session->set_userdata('idsup', $data_user->id_suplier);
                $this->session->set_userdata('almt', $data_user->alamat);
                $this->session->set_userdata('telpon', $data_user->no_telp);
                $this->session->set_userdata('jk', $data_user->gender);
                $this->session->set_userdata('is_login', TRUE);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function cek_login()
    {
        if (empty($this->session->userdata('is_login'))) {
            redirect('login');
        }
    }

    public function dataUser()
    {
        $q = $this->db->query("SELECT * From users");
        return $q;
    }

    public function updateuser($username, $nama, $password, $notelp, $alamat, $gender, $status, $level, $idtoko, $idsuplier)
    {
        if ($level == 'Kasir') {
            $data = array(
                'name' => $nama,
                'password' => $password,
                'no_telp' => $notelp,
                'alamat' => $alamat,
                'gender' => $gender,
                'status' => $status,
                'level' => $level,
                'updated_at' => date('Y-m-d H:i:s'),
                'id_toko' => $idtoko,
            );
            $this->db->update('users', $data, array('username' => $username));
        } else if ($level == 'Suplier') {
            $data = array(
                'name' => $nama,
                'password' => $password,
                'no_telp' => $notelp,
                'alamat' => $alamat,
                'gender' => $gender,
                'status' => $status,
                'level' => $level,
                'id_suplier' => $idsuplier,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->update('users', $data, array('username' => $username));
        } else {
            $data = array(
                'name' => $nama,
                'password' => $password,
                'no_telp' => $notelp,
                'alamat' => $alamat,
                'gender' => $gender,
                'status' => $status,
                'level' => $level,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->update('users', $data, array('username' => $username));
        }
        return true;
    }

    public function nonaktifuser($status, $username)
    {
        $data = array(
            'status' => $status,
        );
        $this->db->update('users', $data, array('username' => $username));
        return true;
    }
}
