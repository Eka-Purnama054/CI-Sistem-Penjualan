<?php if ($this->session->userdata('lvl') == "Admin") { ?>
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
                            <h4 class="page-title">BarangGudang</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="<?= base_url(); ?>/homegudang">
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
                                    <a href="<?= base_url(); ?>/baranggudang">BarangGudang</a>
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
                                                                Barang Gudang
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/baranggudang/insert">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Barang</label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Jual</label>
                                                                        <input id="harjul" name="harjul" type="text" class="form-control" placeholder="Harga Jual" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Grosir</label>
                                                                        <input id="hargro" name="hargro" type="text" class="form-control" placeholder="Harga Grosir" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Pokok</label>
                                                                        <input id="harpok" name="harpok" type="text" class="form-control" placeholder="Harga Pokok" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Stok Gudang/ Stok Awal</label>
                                                                        <input id="stok" name="stok" type="text" class="form-control" placeholder="Stok Gudang" required>
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
                                                                        <label>Pilih Warna</label>
                                                                        <select name="warna" id="warna" class="form-control">
                                                                            <option>---Pilih warna---</option>
                                                                            <?php foreach ($kate as $a) :  ?>
                                                                                <option value="<?= $a->id_warna ?>"><?= $a->nama_warna ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Pilih Suplier</label>
                                                                        <select name="suplier" id="suplier" class="form-control">
                                                                            <option>---Pilih Suplier---</option>
                                                                            <?php foreach ($supp as $a) :  ?>
                                                                                <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Size Barang</label>
                                                                        <select name="size" id="size" class="form-control">
                                                                            <option>---Pilih size---</option>
                                                                            <?php foreach ($size as $a) :  ?>
                                                                                <option value="<?= $a->id_size ?>"><?= $a->nama_size ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Pilih Item/Produk</label>
                                                                        <select name="item" id="item" class="form-control">
                                                                            <option>---Pilih Item/Produk---</option>
                                                                            <?php foreach ($item as $a) :  ?>
                                                                                <option value="<?= $a->kode_item ?>"><?= $a->nama_item ?></option>
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
                                        foreach ($bar->result_array() as $b) :
                                            $no++;
                                            $nobarang = $b['no_barang'];
                                            $kode = $b['kode_barang'];
                                            $nm = $b['nama_barang'];
                                            $harjul = $b['hargajual'];
                                            $hargro = $b['hargagrosir'];
                                            $harpok = $b['hargapokok'];
                                            $stok = $b['stok_gudang'];
                                            $create = $b['created_at'];
                                            $update = $b['updated_at'];
                                            $satuan = $b['nama_satuan'];
                                            $idsatuan = $b['id_satuan'];
                                            $idwarna = $b['id_warna'];
                                            $warna = $b['nama_warna'];
                                            $idsuplier = $b['id_suplier'];
                                            $suplier = $b['nama_suplier'];
                                            $almsuplier = $b['alamat_suplier'];
                                            $idsize = $b['id_size'];
                                            $namasize = $b['nama_size'];
                                            $kodeitem = $b['kode_item'];
                                            $namaitem = $b['nama_item'];
                                        ?>
                                            <div class="modal fade bd-example-modal-lg" id="modalEdit<?= $nobarang ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Edit</span>
                                                                <span class="fw-light">
                                                                    Data Barang Gudang
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?= base_url(); ?>index.php/baranggudang/update">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Kode Barang</label>
                                                                            <input id="nobarang" name="nobarang" type="hidden" value="<?= $nobarang ?>" class="form-control" placeholder="Kode Barang" readonly>
                                                                            <input id="kode" name="kode" type="text" value="<?= $kode ?>" class="form-control" placeholder="Kode Barang" readonly>
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
                                                                            <label>Harga Jual</label>
                                                                            <input id="harjul" name="harjul" type="text" value="<?= $harjul ?>" class="form-control" placeholder="Harga Jual" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Harga Grosir</label>
                                                                            <input id="hargro" name="hargro" type="text" value="<?= $hargro ?>" class="form-control" placeholder="Harga Grosir" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Harga Pokok</label>
                                                                            <input id="harpok" name="harpok" type="text" value="<?= $harpok ?>" class="form-control" placeholder="Harga Pokok" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Stok Gudang/ Stok Awal</label>
                                                                            <input id="stok" name="stok" type="text" value="<?= $stok ?>" class="form-control" placeholder="Stok Gudang" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Satuan</label>
                                                                            <select name="satuan" id="satuan" class="form-control" placeholder="Pilih Satuan">
                                                                                <option value="<?= $idsatuan  ?>"><?= $satuan ?></option>
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
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Suplier</label>
                                                                            <select name="suplier" id="suplier" class="form-control">
                                                                                <option value="<?= $idsuplier ?>"><?= $suplier ?>-<?= $almsuplier ?></option>
                                                                                <?php foreach ($supp as $a) :  ?>
                                                                                    <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Size Barang</label>
                                                                            <select name="size" id="size" class="form-control">
                                                                                <option value="<?= $idsize ?>"><?= $namasize ?></option>
                                                                                <?php foreach ($size as $a) :  ?>
                                                                                    <option value="<?= $a->id_size ?>"><?= $a->nama_size ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Item/Produk</label>
                                                                            <select name="item" id="item" class="form-control">
                                                                                <option value="<?= $kodeitem ?>"><?= $namaitem ?></option>
                                                                                <?php foreach ($item as $a) :  ?>
                                                                                    <option value="<?= $a->kode_item ?>"><?= $a->nama_item ?></option>
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
                                                        <th>Harga Grosir</th>
                                                        <th>Harga Jual</th>
                                                        <th>Size</th>
                                                        <th>Stok</th>
                                                        <th>Satuan</th>
                                                        <th>Warna</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($bar->result_array() as $b) :
                                                        $no++;
                                                        $nobarang = $b['no_barang'];
                                                        $qr = $b['qr_code'];
                                                        $kode = $b['kode_barang'];
                                                        $nm = $b['nama_barang'];
                                                        $harjul = $b['hargajual'];
                                                        $hargro = $b['hargagrosir'];
                                                        $harpok = $b['hargapokok'];
                                                        $stok = $b['stok_gudang'];
                                                        $satuan = $b['nama_satuan'];
                                                        $warna = $b['nama_warna'];
                                                        $namasize = $b['nama_size'];
                                                        $namaitem = $b['nama_item'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $qr; ?>"></td>
                                                            <td><?= $nm ?></td>
                                                            <td>Rp. <?= number_format("$harpok", 2, ",", ".") ?></td>
                                                            <td>Rp. <?= number_format("$hargro", 2, ",", ".") ?></td>
                                                            <td>Rp. <?= number_format("$harjul", 2, ",", ".") ?></td>
                                                            <td><?= $namasize ?></td>
                                                            <td><?= $stok ?></td>
                                                            <td><?= $satuan ?></td>
                                                            <td><?= $warna ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#modalEdit<?= $nobarang ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
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
                            <h4 class="page-title">BarangGudang</h4>
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
                                    <a href="#">DataBarang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/baranggudang">BarangGudang</a>
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
                                            <a href="" class="btn btn-success btn-round" data-toggle="modal" data-target="#addKirim">
                                                <i class="fa fa-box"></i>
                                                Kiriman
                                            </a>
                                            <a href="" class="btn btn-secondary btn-round" data-toggle="modal" data-target="#addRetur">
                                                <i class="fas fa-truck-moving"></i>
                                                Retur Toko
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Large modal -->
                                        <div class="modal fade modal fade bd-example-modal-lg" id="addRetur" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                        $idbar = $b['no_barang'];
                                                                        $size = $b['nama_size'];
                                                                        $harpok = $b['hargapokok'];
                                                                        $ket = $b['keterangan'];
                                                                        $kete = $b['ket'];
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

                                                                                <form action='<?= base_url(); ?>index.php/baranggudang/terimaretur' method='post'>
                                                                                    <div class='form-button-action'>
                                                                                        <input type='hidden' name='idbar' value='<?php echo $idbar; ?>'>
                                                                                        <input type='hidden' name='id' value='<?php echo $id; ?>'>
                                                                                        <?php if ($kete == null) { ?>
                                                                                            <?php echo "<button type='submit' class='btn btn-sm btn-info'>Pilih</button>" ?>
                                                                                        <?php } else if ($kete == 'TERIMA') { ?>
                                                                                            <?php echo "" ?>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </form>
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
                                        <div class="modal fade modal fade bd-example-modal-lg" id="addKirim" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Data</span>
                                                            <span class="fw-light">
                                                                Kirim
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table class="display table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Kode Order</th>
                                                                        <th>Tanggal Order</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Ukuran</th>
                                                                        <th>Jumlah Barang</th>
                                                                        <th style="width: 10%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Kode Order</th>
                                                                        <th>Tanggal Order</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Ukuran</th>
                                                                        <th>Jumlah Barang</th>
                                                                        <th style="width: 10%">Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($get->result_array() as $b) :
                                                                        $no++;
                                                                        $id = $b['kode_stokin'];
                                                                        $tglo = $b['tanggal'];
                                                                        $qty = $b['jumlah'];
                                                                        $nmbar = $b['nama_barang'];
                                                                        $kodebar = $b['kode_barang'];
                                                                        $idbar = $b['no_barang'];
                                                                        $size = $b['nama_size'];
                                                                        $ket = $b['keterangan'];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $id ?></td>
                                                                            <td><?= $tglo ?></td>
                                                                            <td><?= $kodebar ?></td>
                                                                            <td><?= $nmbar ?></td>
                                                                            <td><?= $size ?></td>
                                                                            <td><?= $qty ?></td>
                                                                            <td>
                                                                                <div class="form-button-action">
                                                                                    <form action="<?= base_url(); ?>index.php/baranggudang/terimagudang" method="post">
                                                                                        <input type="hidden" name="idbar" value="<?php echo $idbar; ?>">
                                                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                                        <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
                                                                                        <?php if ($ket == "TERIMA") { ?>
                                                                                            <?php echo '<button hidden=true class="btn btn-icon btn-round btn-warning" title="Terima"><span class="fas fa-check-double"></span></button>' ?>
                                                                                        <?php } else { ?>
                                                                                            <?php echo '<button type="submit" class="btn btn-icon btn-round btn-success"><i class="fa fa-check"></i></button>' ?>
                                                                                        <?php  } ?>
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
                                        <!-- Modal Tambah -->
                                        <div class="modal fade bd-example-modal-lg" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                New</span>
                                                            <span class="fw-light">
                                                                Barang Gudang
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/baranggudang/insert">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Barang</label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Jual</label>
                                                                        <input id="harjul" name="harjul" type="text" class="form-control" placeholder="Harga Jual" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Grosir</label>
                                                                        <input id="hargro" name="hargro" type="text" class="form-control" placeholder="Harga Grosir" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Pokok</label>
                                                                        <input id="harpok" name="harpok" type="text" class="form-control" placeholder="Harga Pokok" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Stok Gudang/ Stok Awal</label>
                                                                        <input id="stok" name="stok" type="text" class="form-control" placeholder="Stok Gudang" required>
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
                                                                        <label>Pilih Warna</label>
                                                                        <select name="warna" id="warna" class="form-control">
                                                                            <option>---Pilih warna---</option>
                                                                            <?php foreach ($kate as $a) :  ?>
                                                                                <option value="<?= $a->id_warna ?>"><?= $a->nama_warna ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Pilih Suplier</label>
                                                                        <select name="suplier" id="suplier" class="form-control">
                                                                            <option>---Pilih Suplier---</option>
                                                                            <?php foreach ($supp as $a) :  ?>
                                                                                <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Size Barang</label>
                                                                        <select name="size" id="size" class="form-control">
                                                                            <option>---Pilih size---</option>
                                                                            <?php foreach ($size as $a) :  ?>
                                                                                <option value="<?= $a->id_size ?>"><?= $a->nama_size ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Pilih Item/Produk</label>
                                                                        <select name="item" id="item" class="form-control">
                                                                            <option>---Pilih Item/Produk---</option>
                                                                            <?php foreach ($item as $a) :  ?>
                                                                                <option value="<?= $a->kode_item ?>"><?= $a->nama_item ?></option>
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
                                        foreach ($bar->result_array() as $b) :
                                            $no++;
                                            $nobarang = $b['no_barang'];
                                            $kode = $b['kode_barang'];
                                            $nm = $b['nama_barang'];
                                            $harjul = $b['hargajual'];
                                            $hargro = $b['hargagrosir'];
                                            $harpok = $b['hargapokok'];
                                            $stok = $b['stok_gudang'];
                                            $create = $b['created_at'];
                                            $update = $b['updated_at'];
                                            $satuan = $b['nama_satuan'];
                                            $idsatuan = $b['id_satuan'];
                                            $idwarna = $b['id_warna'];
                                            $warna = $b['nama_warna'];
                                            $idsuplier = $b['id_suplier'];
                                            $suplier = $b['nama_suplier'];
                                            $almsuplier = $b['alamat_suplier'];
                                            $idsize = $b['id_size'];
                                            $namasize = $b['nama_size'];
                                            $kodeitem = $b['kode_item'];
                                            $namaitem = $b['nama_item'];
                                        ?>
                                            <div class="modal fade bd-example-modal-lg" id="modalEdit<?= $nobarang ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Edit</span>
                                                                <span class="fw-light">
                                                                    Data Barang Gudang
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?= base_url(); ?>index.php/baranggudang/update">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Kode Barang</label>
                                                                            <input id="nobarang" name="nobarang" type="hidden" value="<?= $nobarang ?>" class="form-control" placeholder="Kode Barang" readonly>
                                                                            <input id="kode" name="kode" type="text" value="<?= $kode ?>" class="form-control" placeholder="Kode Barang" readonly>
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
                                                                            <label>Harga Jual</label>
                                                                            <input id="harjul" name="harjul" type="text" value="<?= $harjul ?>" class="form-control" placeholder="Harga Jual" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Harga Grosir</label>
                                                                            <input id="hargro" name="hargro" type="text" value="<?= $hargro ?>" class="form-control" placeholder="Harga Grosir" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Harga Pokok</label>
                                                                            <input id="harpok" name="harpok" type="text" value="<?= $harpok ?>" class="form-control" placeholder="Harga Pokok" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Stok Gudang/ Stok Awal</label>
                                                                            <input id="stok" name="stok" type="text" value="<?= $stok ?>" class="form-control" placeholder="Stok Gudang" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Satuan</label>
                                                                            <select name="satuan" id="satuan" class="form-control" placeholder="Pilih Satuan">
                                                                                <option value="<?= $idsatuan  ?>"><?= $satuan ?></option>
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
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Suplier</label>
                                                                            <select name="suplier" id="suplier" class="form-control">
                                                                                <option value="<?= $idsuplier ?>"><?= $suplier ?>-<?= $almsuplier ?></option>
                                                                                <?php foreach ($supp as $a) :  ?>
                                                                                    <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Size Barang</label>
                                                                            <select name="size" id="size" class="form-control">
                                                                                <option value="<?= $idsize ?>"><?= $namasize ?></option>
                                                                                <?php foreach ($size as $a) :  ?>
                                                                                    <option value="<?= $a->id_size ?>"><?= $a->nama_size ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Item/Produk</label>
                                                                            <select name="item" id="item" class="form-control">
                                                                                <option value="<?= $kodeitem ?>"><?= $namaitem ?></option>
                                                                                <?php foreach ($item as $a) :  ?>
                                                                                    <option value="<?= $a->kode_item ?>"><?= $a->nama_item ?></option>
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
                                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga Pokok</th>
                                                        <th>Harga Grosir</th>
                                                        <th>Harga Jual</th>
                                                        <th>Size</th>
                                                        <th>Stok</th>
                                                        <th>Satuan</th>
                                                        <th>Warna</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($bar->result_array() as $b) :
                                                        $no++;
                                                        $nobarang = $b['no_barang'];
                                                        $qr = $b['qr_code'];
                                                        $kode = $b['kode_barang'];
                                                        $nm = $b['nama_barang'];
                                                        $harjul = $b['hargajual'];
                                                        $hargro = $b['hargagrosir'];
                                                        $harpok = $b['hargapokok'];
                                                        $stok = $b['stok_gudang'];
                                                        $satuan = $b['nama_satuan'];
                                                        $warna = $b['nama_warna'];
                                                        $namasize = $b['nama_size'];
                                                        $namaitem = $b['nama_item'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $qr; ?>"></td>
                                                            <td><?= $nm ?></td>
                                                            <td>Rp. <?= number_format("$harpok", 2, ",", ".") ?></td>
                                                            <td>Rp. <?= number_format("$hargro", 2, ",", ".") ?></td>
                                                            <td>Rp. <?= number_format("$harjul", 2, ",", ".") ?></td>
                                                            <td><?= $namasize ?></td>
                                                            <td><?= $stok ?></td>
                                                            <td><?= $satuan ?></td>
                                                            <td><?= $warna ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#modalEdit<?= $nobarang ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
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

            <script>
                $(document).ready(function() {
                    $('#basic-datatables').DataTable({});

                    $('#multi-filter-select').DataTable({
                        "pageLength": 5,
                        initComplete: function() {
                            this.api().columns().every(function() {
                                var column = this;
                                var select = $('<select class="form-control"><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function() {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );

                                        column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                    });

                                column.data().unique().sort().each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>')
                                });
                            });
                        }
                    });

                    // Add Row
                    $('#add-row2').DataTable({
                        "pageLength": 5,
                    });

                    var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

                    $('#addRowButton').click(function() {
                        $('#add-row2').dataTable().fnAddData([
                            $("#addName").val(),
                            $("#addPosition").val(),
                            $("#addOffice").val(),
                            action
                        ]);
                        $('#addRowModal').modal('hide');

                    });
                });
            </script>
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

<?php if ($this->session->userdata('lvl') == "Owner") { ?>
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
                            <h4 class="page-title">BarangGudang</h4>
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
                                    <a href="#MasterData">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#Barang">Barang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/baranggudang">Gudang</a>
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
                                                                Barang Gudang
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/baranggudang/insert">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Barang</label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Jual</label>
                                                                        <input id="harjul" name="harjul" type="text" class="form-control" placeholder="Harga Jual" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Grosir</label>
                                                                        <input id="hargro" name="hargro" type="text" class="form-control" placeholder="Harga Grosir" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Harga Pokok</label>
                                                                        <input id="harpok" name="harpok" type="text" class="form-control" placeholder="Harga Pokok" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Stok Gudang/ Stok Awal</label>
                                                                        <input id="stok" name="stok" type="text" class="form-control" placeholder="Stok Gudang" required>
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
                                                                        <label>Pilih Warna</label>
                                                                        <select name="warna" id="warna" class="form-control">
                                                                            <option>---Pilih warna---</option>
                                                                            <?php foreach ($kate as $a) :  ?>
                                                                                <option value="<?= $a->id_warna ?>"><?= $a->nama_warna ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Pilih Suplier</label>
                                                                        <select name="suplier" id="suplier" class="form-control">
                                                                            <option>---Pilih Suplier---</option>
                                                                            <?php foreach ($supp as $a) :  ?>
                                                                                <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pr-0">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Size Barang</label>
                                                                        <select name="size" id="size" class="form-control">
                                                                            <option>---Pilih size---</option>
                                                                            <?php foreach ($size as $a) :  ?>
                                                                                <option value="<?= $a->id_size ?>"><?= $a->nama_size ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Pilih Item/Produk</label>
                                                                        <select name="item" id="item" class="form-control">
                                                                            <option>---Pilih Item/Produk---</option>
                                                                            <?php foreach ($item as $a) :  ?>
                                                                                <option value="<?= $a->kode_item ?>"><?= $a->nama_item ?></option>
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
                                        foreach ($bar->result_array() as $b) :
                                            $no++;
                                            $nobarang = $b['no_barang'];
                                            $kd = $b['kode'];
                                            $kode = $b['kode_barang'];
                                            $nm = $b['nama_barang'];
                                            $harjul = $b['hargajual'];
                                            $hargro = $b['hargagrosir'];
                                            $harpok = $b['hargapokok'];
                                            $stok = $b['stok_gudang'];
                                            $create = $b['created_at'];
                                            $update = $b['updated_at'];
                                            $satuan = $b['nama_satuan'];
                                            $idsatuan = $b['id_satuan'];
                                            $idwarna = $b['id_warna'];
                                            $warna = $b['nama_warna'];
                                            $idsuplier = $b['id_suplier'];
                                            $suplier = $b['nama_suplier'];
                                            $almsuplier = $b['alamat_suplier'];
                                            $idsize = $b['id_size'];
                                            $namasize = $b['nama_size'];
                                            $kodeitem = $b['kode_item'];
                                            $namaitem = $b['nama_item'];
                                        ?>
                                            <div class="modal fade bd-example-modal-lg" id="modalEdit<?= $nobarang ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Edit</span>
                                                                <span class="fw-light">
                                                                    Data Barang Gudang
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?= base_url(); ?>index.php/baranggudang/ownerupdate">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Kode Barang</label>
                                                                            <input id="nobarang" name="nobarang" type="hidden" value="<?= $nobarang ?>" class="form-control" placeholder="Kode Barang" readonly>
                                                                            <input id="no" name="no" type="hidden" value="<?= $kd ?>" class="form-control" placeholder="Kode Barang">
                                                                            <input id="kode" name="kode" type="text" value="<?= $kode ?>" class="form-control" placeholder="Kode Barang" readonly>
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
                                                                            <label>Harga Jual</label>
                                                                            <input id="harjul" name="harjul" type="text" value="<?= $harjul ?>" class="form-control" placeholder="Harga Jual" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Harga Grosir</label>
                                                                            <input id="hargro" name="hargro" type="text" value="<?= $hargro ?>" class="form-control" placeholder="Harga Grosir" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Harga Pokok</label>
                                                                            <input id="harpok" name="harpok" type="text" value="<?= $harpok ?>" class="form-control" placeholder="Harga Pokok" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Stok Gudang/ Stok Awal</label>
                                                                            <input id="stok" name="stok" type="text" value="<?= $stok ?>" class="form-control" placeholder="Stok Gudang" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Satuan</label>
                                                                            <select name="satuan" id="satuan" class="form-control" placeholder="Pilih Satuan">
                                                                                <option value="<?= $idsatuan  ?>"><?= $satuan ?></option>
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
                                                                                    <option value="<?= $a->id_kategori ?>"><?= $a->nama_kategori ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Suplier</label>
                                                                            <select name="suplier" id="suplier" class="form-control">
                                                                                <option value="<?= $idsuplier ?>"><?= $suplier ?>-<?= $almsuplier ?></option>
                                                                                <?php foreach ($supp as $a) :  ?>
                                                                                    <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 pr-0">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Size Barang</label>
                                                                            <select name="size" id="size" class="form-control">
                                                                                <option value="<?= $idsize ?>"><?= $namasize ?></option>
                                                                                <?php foreach ($size as $a) :  ?>
                                                                                    <option value="<?= $a->id_size ?>"><?= $a->nama_size ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Pilih Item/Produk</label>
                                                                            <select name="item" id="item" class="form-control">
                                                                                <option value="<?= $kodeitem ?>"><?= $namaitem ?></option>
                                                                                <?php foreach ($item as $a) :  ?>
                                                                                    <option value="<?= $a->kode_item ?>"><?= $a->nama_item ?></option>
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
                                                        <th>Harga Grosir</th>
                                                        <th>Harga Jual</th>
                                                        <th>Size</th>
                                                        <th>Stok</th>
                                                        <th>Satuan</th>
                                                        <th>Warna</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($bar->result_array() as $b) :
                                                        $no++;
                                                        $nobarang = $b['no_barang'];
                                                        $qr = $b['qr_code'];
                                                        $kode = $b['kode_barang'];
                                                        $nm = $b['nama_barang'];
                                                        $harjul = $b['hargajual'];
                                                        $hargro = $b['hargagrosir'];
                                                        $harpok = $b['hargapokok'];
                                                        $stok = $b['stok_gudang'];
                                                        $satuan = $b['nama_satuan'];
                                                        $warna = $b['nama_warna'];
                                                        $namasize = $b['nama_size'];
                                                        $namaitem = $b['nama_item'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $qr; ?>"></td>
                                                            <td><?= $nm ?></td>
                                                            <td>Rp. <?= number_format("$harpok", 2, ",", ".") ?></td>
                                                            <td>Rp. <?= number_format("$hargro", 2, ",", ".") ?></td>
                                                            <td>Rp. <?= number_format("$harjul", 2, ",", ".") ?></td>
                                                            <td><?= $namasize ?></td>
                                                            <td><?= $stok ?></td>
                                                            <td><?= $satuan ?></td>
                                                            <td><?= $warna ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#modalEdit<?= $nobarang ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
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