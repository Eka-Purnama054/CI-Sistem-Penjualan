<?php

function iislogin()
{
    $ci = get_instance();
    if ($ci->session->userdata('username')) {
        redirect('owner', 'refresh');
    }
}

function cekadmin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Anda harus login !</div>');
        redirect('', 'refresh');
    }
}


function getlevel($level)
{
    if ($level == 'Admin') {
        return 'Admin';
    } elseif ($level == 'Kasir') {
        return 'Kasir';
    } elseif ($level == 'Gudang') {
        return 'Gudang';
    } elseif ($level == 'Suplier') {
        return 'Suplier';
    } elseif ($level == 'Owner') {
        return 'Owner';
    } else {
        return 'lain';
    }
}
                        
/* End of file myhelper.php */
