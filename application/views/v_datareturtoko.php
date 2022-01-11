<?php if (
    $this->session->userdata('lvl') == "Kasir"
) {
    # code...
?>

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
                            <h4 class="page-title">DataRetur</h4>
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
                                    <a href="<?= base_url(); ?>index.php/stokout/dataretur">Dataretur</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-tools">
                                            <a href="<?= base_url(); ?>index.php/stokout" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                                <span class="btn-label">
                                                    <i class="fa fa-tshirt"></i>
                                                </span>
                                                Retur
                                            </a>
                                            <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                                <span class="btn-label">
                                                    <i class="fa fa-print"></i>
                                                </span>
                                                Print
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Retur</th>
                                                        <th>Tanggal</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Ukuran</th>
                                                        <th>Jumlah Barang</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Kode Retur</th>
                                                        <th>Tanggal</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Ukuran</th>
                                                        <th>Jumlah Barang</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($dretur->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['kode_stokout'];
                                                        $tglK = $b['tgl_stokout'];
                                                        $ket = $b['keterangan'];
                                                        $qty = $b['jumlah'];
                                                        $nmbar = $b['nama_barang'];
                                                        $kodebar = $b['kode_barang'];
                                                        $idbar = $b['id_barang'];
                                                        $size = $b['size_barang'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $id ?></td>
                                                            <td><?= $tglK ?></td>
                                                            <td><?= $kodebar ?></td>
                                                            <td><?= $nmbar ?></td>
                                                            <td><?= $size ?></td>
                                                            <td><?= $qty ?></td>
                                                            <td><?= $ket ?></td>
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

<?php  } ?>