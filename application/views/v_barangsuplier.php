<?php if ($this->session->userdata('lvl') == "Suplier") { ?>
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
                            <h4 class="page-title">Barang</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="<?= base_url(); ?>index.php/homesuplier">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/barangsuplier">BarangGudang</a>
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
                                            <a href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </a>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Modal Tambah -->
                                        <div class="modal fade bd-example-modal-lg" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                New</span>
                                                            <span class="fw-light">
                                                                Barang
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/barangsuplier/insert">
                                                            <div class="row">
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Kode Barang</label>
                                                                        <input id="kode" name="kode" type="text" class="form-control" placeholder="Kode Barang" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Barang</label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Pokok</label>
                                                                        <input id="harpok" name="harpok" type="text" class="form-control" placeholder="Harga Pokok" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Size Barang</label>
                                                                        <input id="size" name="size" type="text" class="form-control" placeholder="Size Barang" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Pilih Satuan</label>
                                                                        <select name="satuan" id="satuan" class="form-control" placeholder="Pilih Satuan">
                                                                            <option>---Pilih Satuan---</option>
                                                                            <?php foreach ($satu as $c) :  ?>
                                                                                <option value="<?= $c->id_satuan ?>"><?= $c->nama_satuan ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Pilih Kategori</label>
                                                                        <select name="kategori" id="kategori" class="form-control">
                                                                            <option>---Pilih Kategori---</option>
                                                                            <?php foreach ($kate as $a) :  ?>
                                                                                <option value="<?= $a->id_warna ?>"><?= $a->nama_warna ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Modal Edit -->
                                        <?php $no = 0;
                                        foreach ($barsup->result_array() as $b) :
                                            $no++;
                                            $id = $b['no_barang'];
                                            $kode = $b['kode_barang'];
                                            $nm = $b['nama_barang'];
                                            $harpok = $b['hargapokok'];
                                            $size = $b['nama_size'];
                                            $create = $b['created_at'];
                                            $update = $b['updated_at'];
                                            $satuan = $b['nama_satuan'];
                                            $idsatuan = $b['id_satuan'];
                                            $idwarna = $b['id_warna'];
                                            $warna = $b['nama_warna'];
                                        ?>
                                            <div class="modal fade bd-example-modal-lg" id="modalEdit<?= $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Edit</span>
                                                                <span class="fw-light">
                                                                    Data Barang
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?= base_url(); ?>index.php/barangsuplier/update">
                                                                <div class="row">
                                                                    <input id="id" name="id" type="hidden" value="<?= $id ?>" class="form-control" placeholder="Kode Barang" required>
                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Kode Barang</label>
                                                                            <input id="kode" name="kode" type="text" value="<?= $kode ?>" class="form-control" placeholder="Kode Barang" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama Barang</label>
                                                                            <input id="nama" name="nama" type="text" value="<?= $nm ?>" class="form-control" placeholder="Nama Barang" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Harga Pokok</label>
                                                                            <input id="harpok" name="harpok" type="text" value="<?= $harpok ?>" class="form-control" placeholder="Harga Pokok" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Size Barang</label>
                                                                            <input id="size" name="size" type="text" value="<?= $size ?>" class="form-control" placeholder="Size Barang" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Satuan</label>
                                                                            <select name="satuan" id="satuan" class="form-control" placeholder="Pilih Satuan">
                                                                                <option value="<?= $idsatuan ?>"><?= $satuan ?></option>
                                                                                <?php foreach ($satu as $c) :  ?>
                                                                                    <option value="<?= $c->id_satuan ?>"><?= $c->nama_satuan ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Kategori</label>
                                                                            <select name="kategori" id="kategori" class="form-control">
                                                                                <option value="<?= $idwarna ?>"><?= $warna ?></option>
                                                                                <?php foreach ($kate as $a) :  ?>
                                                                                    <option value="<?= $a->id_warna ?>"><?= $a->nama_warna ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-primary" value="Edit">Edit</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                        ?>

                                        <!-- End Modal -->
                                        <!-- =================================================================== -->
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga Pokok</th>
                                                        <th>Size Barang</th>
                                                        <th>Stok Gudang</th>
                                                        <th>Satuan</th>
                                                        <th>Warna</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga Pokok</th>
                                                        <th>Size Barang</th>
                                                        <th>Stok Gudang</th>
                                                        <th>Satuan</th>
                                                        <th>Warna</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($barsup->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['no_barang'];
                                                        $kode = $b['kode_barang'];
                                                        $nm = $b['nama_barang'];
                                                        $harpok = $b['hargapokok'];
                                                        $size = $b['nama_size'];
                                                        $stok = $b['stok_gudang'];
                                                        $satuan = $b['nama_satuan'];
                                                        $warna = $b['nama_warna'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $kode ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td>Rp. <?= $harpok ?></td>
                                                            <td><?= $size ?></td>
                                                            <td><?= $stok ?></td>
                                                            <td><?= $satuan ?></td>
                                                            <td><?= $warna ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#modalEdit<?= $id ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
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