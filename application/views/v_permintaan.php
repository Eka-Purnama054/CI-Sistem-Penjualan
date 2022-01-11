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
                            <h4 class="page-title">PermintaanToko</h4>
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
                                    <a href="<?= base_url(); ?>index.php/permintaan">Permintaan</a>
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
                                            <h4 class="card-title"><i class="fas fa-truck-moving"></i> Permintaan</h4>
                                            <a href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fas fa-truck-moving"></i>
                                                Orderan Toko
                                            </a>
                                            <a href="" class="btn btn-success btn-round" data-toggle="modal" data-target="#BarangGudang">
                                                <i class="fas fa-tshirt"></i>
                                                Barang Gudang
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
                                                                Orderan Toko
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
                                                                        <th>Kode Kirim</th>
                                                                        <th>Tanggal Kirim</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Toko</th>
                                                                        <th>Jumlah Barang</th>
                                                                        <th>Qty</th>
                                                                        <th style="width: 10%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Kode Kirim</th>
                                                                        <th>Tanggal Kirim</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Toko</th>
                                                                        <th>Jumlah Barang</th>
                                                                        <th>Qty</th>
                                                                        <th style="width: 10%">Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($r->result_array() as $b) :
                                                                        $no++;
                                                                        $id = $b['kode_order'];
                                                                        $tglo = $b['tanggal_order'];
                                                                        $qty = $b['jumlah'];
                                                                        $nmbar = $b['nama_barang'];
                                                                        $kodebar = $b['kode_barang'];
                                                                        $idbar = $b['no_barang'];
                                                                        $size = $b['nama_size'];
                                                                        $tokonm = $b['nama_toko'];
                                                                        $ket = $b['keterangan'];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $id ?></td>
                                                                            <td><?= $tglo ?></td>
                                                                            <td><?= $kodebar ?></td>
                                                                            <td><?= $nmbar ?></td>
                                                                            <td><?= $tokonm ?></td>
                                                                            <td><?= $qty ?></td>
                                                                            <td style="text-align:center;">
                                                                                <form action="<?= base_url(); ?>index.php/permintaan/kirimordertoko" method="post">
                                                                                    <div class="form-group has-success">
                                                                                        <input type="text" id="qty" name="qty" placeholder="Input Qty.." class="form-control" required>
                                                                                    </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-button-action">
                                                                                    <input type="hidden" name="idbar" value="<?php echo $idbar; ?>">
                                                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                                    <?php if ($ket == "KIRIM" || $ket == "ORDERTOKO") { ?>
                                                                                        <?php echo 'OK' ?>
                                                                                    <?php } else { ?>
                                                                                        <?php echo '<button type="submit" class="btn btn-sm btn-info">Pilih</button>' ?>
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
                                                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Harga Jual</th>
                                                                        <th>Harga Grosir</th>
                                                                        <th>Size Barang</th>
                                                                        <th>Stok Gudang</th>
                                                                        <th>Warna</th>
                                                                        <th>QTY</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
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
                                                                        $warna = $b['nama_warna'];

                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $kode ?></td>
                                                                            <td><?= $nm ?></td>
                                                                            <td>Rp. <?= $harjul ?></td>
                                                                            <td>Rp. <?= $hargro ?></td>
                                                                            <td><?= $size ?></td>
                                                                            <td><?= $stok ?></td>
                                                                            <td><?= $warna ?></td>
                                                                            <form action="<?= base_url(); ?>index.php/permintaan/kirimketoko" method="post">
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
                                                        <th>Harga</th>
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
                                                                <a href="<?= base_url('index.php/permintaan/removeorderan/' . $items['rowid']); ?>" class="btn btn-link btn-primary" data-original-title=".Remove"><span class="fas fa-trash"></a>
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
                                                KIRIM KE-TOKO
                                            </h1>
                                            <form action="<?= base_url(); ?>index.php/permintaan/insertpermintaan" method="POST">
                                                <label>Pilih Toko</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-store-alt"></i></span>
                                                    </div>
                                                    <select name="kirimke" id="kirimke" class="form-control">
                                                        <option>---Pilih Toko---</option>
                                                        <?php foreach ($toko as $b) : ?>
                                                            <option value="<?= $b->id_toko ?>"><?= $b->nama_toko ?> - <?= $b->alamat_toko ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group has-success">
                                                    <label for="comment">Tulis Pesan</label>
                                                    <textarea name="pesan" class="form-control" id="comment" rows="5"></textarea>
                                                </div>
                                                <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d h:i:s"); ?>">
                                                <input type="hidden" name="total" id="total" value="<?php echo $this->cart->total(); ?>">
                                                <div class="form-group">
                                                    <button id="kirim" type="submit" class="btn btn-primary ml-auto"><span class="fas fa-truck-moving"></span> Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h1 class="page-title">
                                                ORDER KE-TOKO
                                            </h1>
                                            <form action="<?= base_url(); ?>index.php/permintaan/orderketoko" method="POST">
                                                <label>Pilih Toko</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-store-alt"></i></span>
                                                    </div>
                                                    <select name="orderke" id="orderke" class="form-control">
                                                        <option>---Pilih Toko---</option>
                                                        <?php foreach ($toko as $b) : ?>
                                                            <option value="<?= $b->id_toko ?>"><?= $b->nama_toko ?> - <?= $b->alamat_toko ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group has-success">
                                                    <label for="comment">Tulis Pesan</label>
                                                    <textarea name="pesan" class="form-control" id="comment" rows="5"></textarea>
                                                </div>
                                                <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d h:i:s"); ?>">
                                                <input type="hidden" name="total" id="total" value="<?php echo $this->cart->total(); ?>">
                                                <div class="form-group">
                                                    <button id="order" type="submit" class="btn btn-success"><span class="fas fa-boxes"></span> Order</button>
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
            <!-- Datatables -->
            <script src="<?= base_url(); ?>/assets/js/plugin/datatables/datatables.min.js"></script>
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
                    $('#add-row').DataTable({
                        "pageLength": 5,
                    });

                    var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

                    $('#addRowButton').click(function() {
                        $('#add-row').dataTable().fnAddData([
                            $("#addName").val(),
                            $("#addPosition").val(),
                            $("#addOffice").val(),
                            action
                        ]);
                        $('#addRowModal').modal('hide');

                    });
                });
            </script>
            <script type="text/javascript">
                function akun() {
                    var tes = document.getElementById("kirimke").value;
                    document.getElementById("toko").value = tes;
                }
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
                            <h4 class="page-title">Permintaan</h4>
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
                                    <a href="<?= base_url(); ?>index.php/permintaan">Permintaan</a>
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
                                            <h4 class="card-title"><i class="fas fa-truck-moving"></i> Permintaan</h4>
                                            <a href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fas fa-truck-moving"></i>
                                                Permintaan
                                            </a>
                                            <a href="" class="btn btn-success btn-round" data-toggle="modal" data-target="#barang">
                                                <i class="fas fa-truck-moving"></i>
                                                Barang
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
                                                                Permintaan
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
                                                                    foreach ($suppp->result_array() as $b) :
                                                                        $no++;
                                                                        $id = $b['kode_order'];
                                                                        $tglo = $b['tanggal_order'];
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
                                                                                    <form action="<?= base_url(); ?>index.php/permintaan/kirimordertoko" method="post">
                                                                                        <input type="hidden" name="idbar" value="<?php echo $idbar; ?>">
                                                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                                        <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
                                                                                        <?php if ($ket == "KIRIM") { ?>
                                                                                            <?php echo 'OK' ?>
                                                                                        <?php } else { ?>
                                                                                            <?php echo '<button type="submit" class="btn btn-sm btn-info">Pilih</button>' ?>
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

                                        <div class="modal fade modal fade bd-example-modal-lg" id="barang" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Data</span>
                                                            <span class="fw-light">
                                                                Barang
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
                                                                        <th>No.</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Size Barang</th>
                                                                        <th>Satuan</th>
                                                                        <th>Warna</th>
                                                                        <th>Harga Pokok</th>
                                                                        <th>Qty</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Size Barang</th>
                                                                        <th>Satuan</th>
                                                                        <th>Warna</th>
                                                                        <th>Harga Pokok</th>
                                                                        <th>Qty</th>
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
                                                                            <td><?= $size ?></td>
                                                                            <td><?= $satuan ?></td>
                                                                            <td><?= $warna ?></td>
                                                                            <form action="<?= base_url(); ?>index.php/permintaan/krmbarusuplier" method="post">
                                                                                <td style="text-align:center;">
                                                                                    <div class="form-group has-success">
                                                                                        <input type="text" id="harga" name="harga" placeholder="Input harga.." class="form-control" required>
                                                                                    </div>
                                                                                </td>
                                                                                <td style="text-align:center;">
                                                                                    <div class="form-group has-success">
                                                                                        <input type="text" id="qty" name="qty" placeholder="Input Qty.." class="form-control" required>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-button-action">
                                                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                                        <button type="submit" class="btn btn-success">pilih</button>
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
                                                        <th>Harga Jual</th>
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
                                                                <a href="<?= base_url('index.php/permintaan/removeorderan/' . $items['rowid']); ?>" class="btn btn-link btn-primary" data-original-title=".Remove"><span class="fas fa-trash"></a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <a href="<?= base_url(); ?>index.php/permintaan/insertpermintaan" class="btn btn-primary"><i class="fas fa-box"></i> Kirim</a>
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