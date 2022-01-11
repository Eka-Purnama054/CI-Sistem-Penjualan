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
                                    <a href="<?= base_url(); ?>index.php/stokout/returdarigudang">Retur</a>
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
                                            <a href="" class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#BarangGudang">
                                                <i class="fas fa-tshirt"></i>
                                                Barang Gudang
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- MOdal tambah -->
                                        <div class="modal fade modal fade bd-example-modal-lg" id="BarangGudang" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Data</span>
                                                            <span class="fw-light">
                                                                Barang Gudang
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
                                                                        <th>Kode</th>
                                                                        <th>Nama</th>
                                                                        <th>Harga</th>
                                                                        <th>Size </th>
                                                                        <th>Stok</th>
                                                                        <th>Satuan</th>
                                                                        <th>Warna</th>
                                                                        <th>Suplier</th>
                                                                        <th>QTY</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Kode</th>
                                                                        <th>Nama</th>
                                                                        <th>Harga</th>
                                                                        <th>Size </th>
                                                                        <th>Stok</th>
                                                                        <th>Satuan</th>
                                                                        <th>Warna</th>
                                                                        <th>Suplier</th>
                                                                        <th>QTY</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($bk->result_array() as $b) :
                                                                        $no++;
                                                                        $id = $b['no_barang'];
                                                                        $kode = $b['kode_barang'];
                                                                        $nm = $b['nama_barang'];
                                                                        $harjul = $b['hargajual'];
                                                                        $hargro = $b['hargagrosir'];
                                                                        $harpok = $b['hargapokok'];
                                                                        $size = $b['nama_size'];
                                                                        $stok = $b['stok_gudang'];
                                                                        $satuan = $b['nama_satuan'];
                                                                        $warna = $b['nama_warna'];
                                                                        $suplier = $b['nama_suplier'];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $kode ?></td>
                                                                            <td><?= $nm ?></td>
                                                                            <td>Rp. <?= $harpok ?></td>
                                                                            <td><?= $size ?></td>
                                                                            <td><?= $stok ?></td>
                                                                            <td><?= $satuan ?></td>
                                                                            <td><?= $warna ?></td>
                                                                            <td><?= $suplier ?></td>
                                                                            <form action="<?= base_url(); ?>index.php/stokout/addreturdarigudang" method="post">
                                                                                <td style="text-align:center;">
                                                                                    <div class="form-group has-success">
                                                                                        <input type="text" id="qty" name="qty" placeholder="Input Qty.." class="form-control" required>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-button-action">
                                                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                                        <button type="submit" class="btn btn-icon btn-round btn-info"><span class="fas fa-check-double"></span></button>
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
                                                                <a href="<?= base_url('index.php/stokout/removegudang/' . $items['rowid']); ?>" class="btn btn-link btn-primary" data-original-title=".Remove"><span class="fas fa-trash"></a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h1 class="page-title">
                                                <?=
                                                $this->session->userdata('nama');
                                                ?>
                                            </h1>
                                            <form action="<?= base_url(); ?>index.php/stokout/simpanreturdarigudang" method="POST">
                                                <div class="form-group">
                                                    <label for="comment">Comment</label>
                                                    <textarea name="coment" id="coment" class="form-control" id="comment" rows="5"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Retur</button>
                                                </div>
                                            </form>
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