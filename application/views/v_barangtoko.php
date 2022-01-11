<?php if ($this->session->userdata('lvl') == 'Admin') { ?>
    <!DOCTYPE html>
    <html lang="en">

    <?php
    $this->load->view('template/v_header');
    ?>

    <body>
        <div class="wrapper">
            <!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
            <div class="main-header" data-background-color="purple">
                <?php
                $this->load->view('template/v_logoheader');
                ?>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <?php
                $this->load->view('template/v_navbar');

                ?>
                <!-- End Navbar -->
            </div>

            <!-- Sidebar -->
            <?php
            $this->load->view('template/v_sidebar');
            ?>

            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">BarangToko</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="<?= base_url(); ?>index.php/homeadmin">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Barang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Toko</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Size</th>
                                                        <th>Warna</th>
                                                        <th>Harga Jual</th>
                                                        <th>Harga Grosir</th>
                                                        <th>Stok Toko</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Size</th>
                                                        <th>Warna</th>
                                                        <th>Harga Jual</th>
                                                        <th>Harga Grosir</th>
                                                        <th>Stok Toko</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($tampil->result_array() as $b) :
                                                        $no++;
                                                        $qr = $b['qr_code'];
                                                        $id = $b['id_barangtoko'];
                                                        $kode = $b['kode_barang'];
                                                        $nm = $b['nama_barang'];
                                                        $harjul = $b['hargajual'];
                                                        $hargro = $b['hargagrosir'];
                                                        $harpok = $b['hargapokok'];
                                                        $size = $b['nama_size'];
                                                        $stok = $b['stok_toko'];
                                                        $warna = $b['nama_warna'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $qr; ?>"></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $size ?></td>
                                                            <td><?= $warna ?></td>
                                                            <td style="text-align:right;width:120px">Rp. <?= number_format("$harjul", 2, ",", ".") ?></td>
                                                            <td style="text-align:right;width:120px">Rp. <?= number_format("$hargro", 2, ",", ".") ?></td>
                                                            <td style="text-align:center"><?= $stok ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                        </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom template | don't include it in your project! -->
            <?php
            $this->load->view('template/v_costum');
            ?>
            <!-- End Custom template -->
        </div>
        </div>
        <?php $this->load->view('template/v_script');
        ?>
    </body>

    </html>
<?php } ?>

<?php if ($this->session->userdata('lvl') == 'Kasir') { ?>
    <!DOCTYPE html>
    <html lang="en">

    <?php
    $this->load->view('template/v_header');
    ?>

    <body>
        <div class="wrapper">
            <!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
            <div class="main-header" data-background-color="purple">
                <?php
                $this->load->view('template/v_logoheader');
                ?>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <?php
                $this->load->view('template/v_navbar');

                ?>
                <!-- End Navbar -->
            </div>

            <!-- Sidebar -->
            <?php
            $this->load->view('template/v_sidebar');
            ?>
            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">BarangToko</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="<?= base_url(); ?>index.php/homekasir">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Masterdata</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/barangtoko">Barangtoko</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title"></h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Size</th>
                                                        <th>Warna</th>
                                                        <th>Harga Jual</th>
                                                        <th>Harga Grosir</th>
                                                        <th>Stok Toko</th>
                                                        <th>Nama Toko</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($bartok->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['id_barangtoko'];
                                                        $qr = $b['qr_code'];
                                                        $kode = $b['kode_barang'];
                                                        $nm = $b['nama_barang'];
                                                        $nmtok = $b['nama_toko'];
                                                        $harjul = $b['hargajual'];
                                                        $hargro = $b['hargagrosir'];
                                                        $harpok = $b['hargapokok'];
                                                        $size = $b['nama_size'];
                                                        $stok = $b['stok_toko'];
                                                        $warna = $b['nama_warna'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $qr; ?>"></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $size ?></td>
                                                            <td><?= $warna ?></td>
                                                            <td>Rp. <?= number_format("$harjul", 2, ",", ".") ?></td>
                                                            <td>Rp. <?= number_format("$hargro", 2, ",", ".") ?></td>
                                                            <td><?= $stok ?></td>
                                                            <td><?= $nmtok ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                        </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom template | don't include it in your project! -->
            <?php
            $this->load->view('template/v_costum');
            ?>
            <!-- End Custom template -->
        </div>
        </div>
        <?php $this->load->view('template/v_script');
        ?>
    </body>

    </html>
<?php } ?>

<?php if ($this->session->userdata('lvl') == 'Gudang') { ?>
    <!DOCTYPE html>
    <html lang="en">

    <?php
    $this->load->view('template/v_header');
    ?>

    <body>
        <div class="wrapper">
            <!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
            <div class="main-header" data-background-color="purple">
                <?php
                $this->load->view('template/v_logoheader');
                ?>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <?php
                $this->load->view('template/v_navbar');

                ?>
                <!-- End Navbar -->
            </div>

            <!-- Sidebar -->
            <?php
            $this->load->view('template/v_sidebar');
            ?>

            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">BarangToko</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="<?= base_url(); ?>index.php/homegudang">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Barang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Toko</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title"></h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Size</th>
                                                        <th>Harga Jual</th>
                                                        <th>Harga Grosir</th>
                                                        <th>Stok Toko</th>
                                                        <th>Nama Toko</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($tampil->result_array() as $b) :
                                                        $no++;
                                                        $qr = $b['qr_code'];
                                                        $id = $b['id_barangtoko'];
                                                        $kode = $b['kode_barang'];
                                                        $nm = $b['nama_barang'];
                                                        $nmtok = $b['nama_toko'];
                                                        $harjul = $b['hargajual'];
                                                        $hargro = $b['hargagrosir'];
                                                        $harpok = $b['hargapokok'];
                                                        $size = $b['nama_size'];
                                                        $stok = $b['stok_toko'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $qr; ?>"></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $size ?></td>
                                                            <td>Rp. <?= number_format("$harjul", 2, ",", ".") ?></td>
                                                            <td>Rp. <?= number_format("$hargro", 2, ",", ".") ?></td>
                                                            <td><?= $stok ?></td>
                                                            <td><?= $nmtok ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                        </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom template | don't include it in your project! -->
            <?php
            $this->load->view('template/v_costum');
            ?>
            <!-- End Custom template -->
        </div>
        </div>
        <?php $this->load->view('template/v_script');
        ?>
    </body>

    </html>
<?php } ?>
<?php if ($this->session->userdata('lvl') == 'Owner') { ?>
    <!DOCTYPE html>
    <html lang="en">

    <?php
    $this->load->view('template/v_header');
    ?>

    <body>
        <div class="wrapper">
            <!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
            <div class="main-header" data-background-color="purple">
                <?php
                $this->load->view('template/v_logoheader');
                ?>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <?php
                $this->load->view('template/v_navbar');

                ?>
                <!-- End Navbar -->
            </div>

            <!-- Sidebar -->
            <?php
            $this->load->view('template/v_sidebar');
            ?>

            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">BarangToko</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="<?= base_url(); ?>index.php/homeowner">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Barang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Toko</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Size</th>
                                                        <th>Harga Jual</th>
                                                        <th>Harga Grosir</th>
                                                        <th>Stok Toko</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Size</th>
                                                        <th>Harga Jual</th>
                                                        <th>Harga Grosir</th>
                                                        <th>Stok Toko</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($tampil->result_array() as $b) :
                                                        $no++;
                                                        $qr = $b['qr_code'];
                                                        $id = $b['id_barangtoko'];
                                                        $kode = $b['kode_barang'];
                                                        $nm = $b['nama_barang'];
                                                        $harjul = $b['hargajual'];
                                                        $hargro = $b['hargagrosir'];
                                                        $harpok = $b['hargapokok'];
                                                        $size = $b['size_barang'];
                                                        $stok = $b['stok_toko'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $qr; ?>"></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $size ?></td>
                                                            <td style="text-align:right;width:120px">Rp. <?= number_format("$hargro", 2, ",", ".") ?></td>
                                                            <td style="text-align:right;width:120px">Rp. <?= number_format("$harpok", 2, ",", ".") ?></td>
                                                            <td style="text-align:center"><?= $stok ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                        </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom template | don't include it in your project! -->
            <?php
            $this->load->view('template/v_costum');
            ?>
            <!-- End Custom template -->
        </div>
        </div>
        <?php $this->load->view('template/v_script');
        ?>
    </body>

    </html>
<?php } ?>