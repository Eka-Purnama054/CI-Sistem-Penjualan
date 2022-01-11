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
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-pricing card-primary">
                                    <div class="card-header">
                                        <h5 class="card-title">Total</h5>
                                        <div class="card-price">
                                            <span class="price">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></span>
                                            <span class="text">,00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h1 class="page-title">
                                                <?=
                                                $this->session->userdata('nama');
                                                ?>
                                            </h1>
                                            <label>No Faktur</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tshirt"></i></span>
                                                </div>
                                                <input name="no_faktur" type="text" class="form-control" value="<?= $kodeunik ?>" placeholder="Input Kode Barang.." aria-label="kode" aria-describedby="basic-addon1" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-card-no-pd">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title"><i class="flaticon-cart-1"></i> Transaksi</h4>
                                            <a href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fas fa-cart-plus"></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Modal Tambah -->
                                        <div class="modal fade modal fade bd-example-modal-lg" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Data</span>
                                                            <span class="fw-light">
                                                                Barang Toko
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
                                                                        <th>Harga Jual</th>
                                                                        <th>Size Barang</th>
                                                                        <th>Stok Toko</th>
                                                                        <th>Jumlah</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($detail->result_array() as $b) :
                                                                        $no++;
                                                                        $id = $b['no_barang'];
                                                                        $kode = $b['kode_barang'];
                                                                        $nm = $b['nama_barang'];
                                                                        $harjul = $b['hargajual'];
                                                                        $hargro = $b['hargagrosir'];
                                                                        $size = $b['nama_size'];
                                                                        $stok = $b['stok_toko'];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $no ?></td>
                                                                            <td><?= $kode ?></td>
                                                                            <td><?= $nm ?></td>
                                                                            <td>Rp. <?= $harjul ?></td>
                                                                            <td><?= $size ?></td>
                                                                            <td><?= $stok ?></td>
                                                                            <form action="<?php echo base_url(); ?>index.php/transaksi/belanja" method="post">
                                                                                <td style="text-align:center;">
                                                                                    <div class="form-group has-success">
                                                                                        <input type="text" id="qty" name="qty" placeholder="Input Qty.." class="form-control" required>
                                                                                    </div>
                                                                                </td>
                                                                                <td style="text-align:center;">
                                                                                    <input type="hidden" name="kode" value="<?= $id; ?>">
                                                                                    <input type="hidden" name="kodebar" value="<?= $kode; ?>">
                                                                                    <input type="hidden" name="nama" value="<?= $nm; ?>">
                                                                                    <input type="hidden" name="stok" value="<?= $stok; ?>">
                                                                                    <input type="hidden" name="harjul" value="<?= number_format($harjul); ?>">
                                                                                    <button type="submit" class="btn btn-link btn-primary" data-original-title=".Pilih"><span class="flaticon-cart-1"></span></button>
                                                                                </td>
                                                                            </form>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <?php if ($this->cart->total_items() != 0) { // cek apakan keranjang belanja lebih dari 0, jika iya maka tampilkan list dalam bentuk table di bawah ini: 
                                                    ?>
                                                        <?php echo $this->session->flashdata('msg'); ?>

                                                        <table class="display table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Kode Barang</th>
                                                                    <th>Nama Barang</th>
                                                                    <th>QTY</th>
                                                                    <th style="text-align:right">Item Price</th>
                                                                    <th style="text-align:right">Sub-Total</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = 0; ?>
                                                                <?php foreach ($this->cart->contents() as $items) : ?>

                                                                    <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                                                                    <tr>
                                                                        <!-- <td><?= $items['id'] ?></td> -->
                                                                        <td><?= $items['kodebar'] ?></td>
                                                                        <td>
                                                                            <?php echo $items['name']; ?>
                                                                        </td>
                                                                        <td><?= number_format($items['qty']) ?></td>
                                                                        <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                                                                        <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                                                        <td style="text-align:center;">
                                                                            <a href="<?= base_url('index.php/transaksi/removecart/' . $items['rowid']); ?>" class="btn btn-link btn-primary" data-original-title=".Remove"><span class="fas fa-trash"></a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    <?php } // selesai menampilkan list cart dalam bentuk table 
                                                    ?>

                                                    <?php if ($this->cart->total_items() == 0) { // jika cart kosong, maka tampilkan: 
                                                    ?>
                                                        Silakan pilih data!!
                                                    <?php } else { // jika cart tidak kosong, tampilkan: 
                                                    ?>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                            Bayar
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">PEMBAYARAN TUNAI/NON TUNAI</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url(); ?>index.php/transaksi/inserttransaksi" method="POST">
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-6 pr-0">
                                                    <div class="form-group">
                                                        <label for="subtotal2">Total Belanja</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            </div>
                                                            <input type="text" value="Rp. <?php echo $this->cart->format_number($this->cart->total()); ?>" class="form-control" name="subtotal2" id="subtotal2" placeholder="Sub Total.." readonly>
                                                            <input type="hidden" value=" <?php echo $this->cart->total(); ?>" class="form-control" name="totalbelanja" id="totalbelanja" placeholder="Sub Total.." readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Diskon (Input Tanpa %)</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="diskon" name="diskon" placeholder="Diskon.." required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pr-0">
                                                    <div class="form-group">
                                                        <label>Grand Total</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="grandtotal" name="grandtotal" placeholder="Grand Total.." readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Cash</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="cash" name="cash" placeholder="Cash.." required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Kembalian</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="kembalian" name="kembalian" placeholder="Kembalian.." readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Print</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="<?= base_url(); ?>/assets/js/qrcodelib.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>/assets/js/webcodecamjquery.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>/assets/js/webcodecamjs.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#totalbelanja, #diskon").keyup(function() {
                    var totalbelanja = $("#totalbelanja").val();
                    var diskon = $("#diskon").val();

                    var grandtotal = parseInt(totalbelanja) - parseInt(diskon);
                    $("#grandtotal").val(grandtotal);
                });

                $("#grandtotal, #cash").keyup(function() {
                    var grandtotal = $("#grandtotal").val();
                    var cash = $("#cash").val();

                    var kembalian = parseInt(cash) - parseInt(grandtotal);
                    $("#kembalian").val(kembalian);
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

    <body>

        <div class="panel-body text-center">
            <canvas></canvas>
        </div>
        <div class="form-group">
            <select class="form-control"></select>
        </div>

        <!-- Js Lib -->
        <script type="text/javascript" src="<?php echo base_url() ?>/assets/js/jquery.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>/assets/js/qrcodelib.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>/assets/js/webcodecamjquery.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>/assets/js/webcodecamjs.js"></script>
        <script type="text/javascript">
            var arg = {
                resultFunction: function(result) {
                    //$('.hasilscan').append($('<input name="noijazah" value=' + result.code + ' readonly><input type="submit" value="Cek"/>'));
                    // $.post("../cek.php", { noijazah: result.code} );
                    var redirect = 'transaksi/scanwebcam';
                    $.redirectPost(redirect, {
                        kode_brg: result.code,

                    });
                }
            };

            var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
            decoder.buildSelectMenu("select");
            decoder.play();
            /*  Without visible select menu
                decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
            */
            $('select').on('change', function() {
                decoder.stop().play();
            });

            // jquery extend function
            $.extend({
                redirectPost: function(location, args) {
                    var form = '';
                    $.each(args, function(key, value) {
                        form += '<input type="hidden" name="' + key + '" value="' + value + '">';
                    });
                    $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
                }
            });
        </script>
    </body>
<?php } ?>