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
                        <h4 class="page-title">StokIn</h4>
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
                                <a href="<?= base_url(); ?>index.php/stokin">Stokin</a>
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
                                                    <th>Kode Kirim</th>
                                                    <th>Tanggal Kirim</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Ukuran</th>
                                                    <th>QTY</th>
                                                    <th>Pesan</th>
                                                    <th>Tanggal Terima</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0;
                                                foreach ($t->result_array() as $b) :
                                                    $no++;
                                                    $id = $b['no_stokin'];
                                                    $tglK = $b['tgl_stokin'];
                                                    $tglT = $b['tgl_terima'];
                                                    $ket = $b['stokin_ket'];
                                                    $qty = $b['jumlah'];
                                                    $nmbar = $b['nama_barang'];
                                                    $kodebar = $b['kode_barang'];
                                                    $idbar = $b['no_barang'];
                                                    $size = $b['nama_size'];
                                                    $pesan = $b['keterangan'];
                                                ?>
                                                    <tr>
                                                        <td><?= $id ?></td>
                                                        <td><?= $tglK ?></td>
                                                        <td><?= $kodebar ?></td>
                                                        <td><?= $nmbar ?></td>
                                                        <td><?= $size ?></td>
                                                        <td><?= $qty ?></td>
                                                        <td><?= $pesan ?></td>
                                                        <td><?= $tglT ?></td>
                                                        <form action="<?= base_url(); ?>index.php/stokin/terimakiriman" method="post">
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <input type="hidden" name="idbar" value="<?php echo $idbar; ?>">
                                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                    <input type="hidden" name="tanggal" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                                    <?php if ($ket == "TERIMA") { ?>
                                                                        <?php echo '<button hidden=true class="btn btn-icon btn-round btn-warning" title="Terima"><span class="fas fa-check-double"></span></button>' ?>
                                                                    <?php } else { ?>
                                                                        <?php echo '<button type="submit" class="btn btn-icon btn-round btn-success"><i class="fa fa-check"></i></button>' ?>
                                                                    <?php  } ?>
                                                                </div>
                                                            </td>
                                                        </form>
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