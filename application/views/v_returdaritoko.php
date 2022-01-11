<?php if ($this->session->userdata('lvl') == "Gudang") { ?>

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
                            <h4 class="page-title">ReturKeSuplier</h4>
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
                                    <a href="$MasterData">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#Retur">Retur</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/stokout/returdaritoko">ReturDariToko</a>
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
                                            <h4 class="card-title"><i class="fas fa-truck-moving"></i> ReturKeSuplier</h4>
                                            <a href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fas fa-truck-moving"></i>
                                                Returan Toko
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- MOdal tambah -->

                                        <div class="modal fade modal fade bd-example-modal-lg" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Data</span>
                                                            <span class="fw-light">
                                                                Retur Toko
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table id="add-row" class="display table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No. Retur</th>
                                                                        <th>Tanggal</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Ukuran</th>
                                                                        <th>Harga</th>
                                                                        <th>Qty</th>
                                                                        <th style="width: 10%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>No. Retur</th>
                                                                        <th>Tanggal</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Ukuran</th>
                                                                        <th>Harga</th>
                                                                        <th>Qty</th>
                                                                        <th style="width: 10%">Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($rtt->result_array() as $b) :
                                                                        $no++;
                                                                        $id = $b['kode_stokout'];
                                                                        $tglo = $b['tgl_stokout'];
                                                                        $qty = $b['jumlah'];
                                                                        $nmbar = $b['nama_barang'];
                                                                        $kodebar = $b['kode_barang'];
                                                                        $idbar = $b['id_barang'];
                                                                        $size = $b['size_barang'];
                                                                        $harpok = $b['hargapokok'];
                                                                        $ket = $b['keterangan'];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $id ?></td>
                                                                            <td><?= $tglo ?></td>
                                                                            <td><?= $kodebar ?></td>
                                                                            <td><?= $nmbar ?></td>
                                                                            <td><?= $size ?></td>
                                                                            <td><?= $harpok ?></td>
                                                                            <td><?= $qty ?></td>
                                                                            <td>
                                                                                <div class="form-button-action">
                                                                                    <form action="<?= base_url(); ?>index.php/stokout/addreturdaritoko" method="post">
                                                                                        <input type="hidden" name="idbar" value="<?php echo $idbar; ?>">
                                                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                                        <button type="submit" class="btn btn-sm btn-info">Pilih</button>
                                                                                    </form>
                                                                                </div>

                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    endforeach;
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah Barang</th>
                                                        <th>Harga Pokok</th>
                                                        <th>Sub Total</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th style="text-align:right" colspan="4">Total</th>
                                                        <th style="text-align:right">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?> </th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    <?php foreach ($this->cart->contents() as $items) : ?>

                                                        <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                                                        <tr>
                                                            <td><?= $items['kodebar'] ?></td>
                                                            <td>
                                                                <?php echo $items['name']; ?>
                                                            </td>
                                                            <td><?= number_format($items['qty']) ?></td>
                                                            <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                                                            <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                                            <td style="text-align:center;">
                                                                <a href="<?= base_url('index.php/stokout/remove/' . $items['rowid']); ?>" class="btn btn-link btn-primary" data-original-title=".Remove"><span class="fas fa-trash"></a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <a href="<?= base_url(); ?>index.php/stokout/simpanreturdaritoko" class="btn btn-primary">Retur</a>
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