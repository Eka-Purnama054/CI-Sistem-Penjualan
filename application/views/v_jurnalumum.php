<?php if ($this->session->userdata('lvl') == "Admin") { ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    $this->load->view('template/v_header');
    ?>

    <body>
        <div class="wrapper">
            <!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"-->
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
                            <h4 class="page-title">Jurnal</h4>
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
                                    <a href="#masterdata">Akutansi</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/jurnalumum">Jurnal</a>
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
                                            <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModalCenter">
                                                <i class="fa fa-plus"></i>
                                                Pembelian
                                            </button>&emsp;
                                            <button type="button" class="btn btn-primary" id="hide" data-toggle="modal" data-target="#salDo">
                                                <i class="fas fa-money-check-alt"></i>
                                                Saldo
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <?php $no = 0;
                                    foreach ($saldo->result_array() as $row) {
                                        $no++;
                                    ?>
                                        <div class="modal fade" id="updaTe<?= $row['id_saldo'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Saldo</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Bank/Kas</label>
                                                            <select class="custom-select" name="coa" required>
                                                                <option value="<?= $row['kode_akun'] ?>"><?= $row['nama_akun'] ?></option>
                                                            </select>
                                                            <div class="invalid-feedback">select menu</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="saldo">Jumlah Saldo</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp.</div>
                                                                </div>
                                                                <input type="text" value="<?= $row['saldo_awal'] ?>" class="form-control" id="saldoawal" name="saldoawal" aria-describedby="jumlah" placeholder="Jumlah Saldo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="modal fade" id="salDo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"><b>SALDO BANK DAN KAS</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body was-validated">
                                                    <form action="<?= base_url(); ?>index.php/jurnalumum/tambahsaldo" method="POST">
                                                        <div class="row">
                                                            <div class="col-sm-3 pr-0">
                                                                <div class="form-group">
                                                                    <label for="">Bank/Kas</label>
                                                                    <select class="custom-select" id="kode" name="coa" required>
                                                                        <option value="">&nbsp;</option>
                                                                        <?php foreach ($akun as $b) { ?>
                                                                            <option value="<?= $b->kode_akun ?>"><?= $b->nama_akun ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">select menu</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">Bank/Kas</label>
                                                                    <select class="custom-select" id="subkodeakun" name="subakun">
                                                                        <option value="">&nbsp;</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="saldo">Jumlah Saldo</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp.</div>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="saldo" name="saldo" aria-describedby="jumlah" placeholder="Jumlah Saldo" required>
                                                                    </div>
                                                                    <input type="hidden" class="form-control" id="saldo2" name="saldo2">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tambah">Tambah</label><br>
                                                                <button type="submit" id="tambah" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <br>
                                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Aksi</th>
                                                                <th>NO.</th>
                                                                <th>Bank / Kas</th>
                                                                <th>Saldo Awal</th>
                                                                <th>Saldo Akhir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0;
                                                            foreach ($saldo->result_array() as $row) {
                                                                $no++;
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <button type="button" onclick="EditSaldo()" class="btn btn-primary btn-link" data-toggle="modal" data-target="#updaTe<?= $row['id_saldo'] ?>"><i class="fas fa-edit"></i></button>
                                                                    </td>
                                                                    <td><?= $no ?></td>
                                                                    <td><?= $row['nama_akun'] ?></td>
                                                                    <td>Rp. <?= number_format($row['saldo_awal']); ?></td>
                                                                    <td>Rp. <?= number_format($row['saldo_akhir']) ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jurnal</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="<?= base_url(); ?>index.php/jurnalumum/insert">
                                                    <div class="modal-body was-validated">
                                                        <div class="row">
                                                            <div class="col-sm-6 pr-0">
                                                                <div class="form-group">
                                                                    <select class="custom-select" id="coa" name="coa" required>
                                                                        <option value="">Open this select menu</option>
                                                                        <?php foreach ($akun as $b) { ?>
                                                                            <option value="<?= $b->kode_akun ?>"><?= $b->nama_akun ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">select menu</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <select class="custom-select" id="namacoa" name="namacoa">

                                                                    </select>
                                                                    <div class="invalid-feedback">select menu</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Tanggal Transaksi</label>
                                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Transaksi" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Uraian</label>
                                                                    <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 pr-0">
                                                                <div class="form-group">
                                                                    <label>Cek/Transfer</label>
                                                                    <select class="custom-select" name="pembayaran" required>
                                                                        <option value="">&nbsp;</option>
                                                                        <option value="Transfer">Transfer</option>
                                                                        <option value="Cek">Cek</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">select Transfer/Cek</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>No. Cek/Transfer</label>
                                                                    <input type="text" class="form-control" id="nomor" name="nomor" placeholder="No. Cek/Transfer" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Debit/Credit</label>
                                                                    <select class="custom-select" name="dc" required>
                                                                        <option value="">&nbsp;</option>
                                                                        <option value="Debit">Debit</option>
                                                                        <option value="Credit">Credit</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">select Debit/Credit</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Kode Akun</label>
                                                                    <select class="custom-select" name="code" required>
                                                                        <option value="">&nbsp;</option>
                                                                        <?php foreach ($coa as $d) : ?>
                                                                            <option value="<?= $d->kode_akun ?>"><?= $d->kode_akun ?>|<?= $d->nama_akun ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">select Akun</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="sr-only">Jumlah Tagihan</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp.</div>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="rupiah" name="rupiah" aria-describedby="jumlah" placeholder="Jumlah Tagihan" required>
                                                                    </div>
                                                                    <input type="hidden" class="form-control" id="rupiah2" name="rupiah2" aria-describedby="jumlah" placeholder="Jumlah Tagihan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Modal -->
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/jurnalumum/lihat" method="POST">
                                            <div class="row">
                                                <div class="col-md-2 pr-0">
                                                    <div class="form-group">
                                                        <label>Pilih Kas/Bank</label>
                                                        <select class="custom-select" id="namaakun" name="namaakun" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php foreach ($akun as $b) { ?>
                                                                <option value="<?= $b->kode_akun ?>"><?= $b->nama_akun ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Pilih Kas/Bank</label>
                                                        <select class="custom-select" id="subakun" name="subakun">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Transaksi</label>
                                                        <input type="month" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Transaksi" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Cek</label><br>
                                                    <button type="submit" class="btn btn-warning"><i class="fas fa-book-open"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php echo $this->session->flashdata('msg'); ?>
                                        <?php
                                        function tgl_indo($tanggal)
                                        {
                                            $bulan = array(
                                                1 =>   'Januari',
                                                'Februari',
                                                'Maret',
                                                'April',
                                                'Mei',
                                                'Juni',
                                                'Juli',
                                                'Agustus',
                                                'September',
                                                'Oktober',
                                                'November',
                                                'Desember'
                                            );
                                            $pecahkan = explode('-', $tanggal);
                                            // variabel pecahkan 0 = tanggal
                                            // variabel pecahkan 1 = bulan
                                            // variabel pecahkan 2 = tahun
                                            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                                        } ?>
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr style='background-color:#ccc;'>
                                                        <th>No.</th>
                                                        <th>Tanggal</th>
                                                        <th>Uraian</th>
                                                        <th>CQ/Transfer</th>
                                                        <th>No CQ/Transfer</th>
                                                        <th>Code</th>
                                                        <th>Debit</th>
                                                        <th>Kredit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($jurnal->result_array() as $row) {
                                                        $no++;
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= tgl_indo(date('Y-m-d', strtotime($row['tanggal']))); ?></td>
                                                            <td><?= $row['uraian'] ?></td>
                                                            <td><?= $row['c_t'] ?></td>
                                                            <td><?= $row['no_dc'] ?></td>
                                                            <td><?= $row['code'] ?></td>
                                                            <td>
                                                                <?php if ($row['d_c'] == 'Debit') {
                                                                    echo "Rp. " . number_format("$row[total]", 2, ",", ".");
                                                                } ?>
                                                            </td>
                                                            <td> <?php if ($row['d_c'] == 'Credit') {
                                                                        echo  "Rp. " . number_format("$row[total]", 2, ",", ".");
                                                                    } ?>
                                                            </td>
                                                        </tr>
                                                    <?php }
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
        <script>
            function EditSaldo() {
                $('#salDo').modal('hide');
                $('#updaTe').modal('show');
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#kode').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/jurnalumum/getsubakun",
                        method: "POST",
                        data: {
                            kode: id
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_akun + '>' + data[i].kode_akun + ' | ' + data[i].nama_akun + '</option>';
                            }
                            $('#subkodeakun').html(html);
                        }
                    });
                    return false;
                });
                $('#namaakun').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/jurnalumum/getakun",
                        method: "POST",
                        data: {
                            namaakun: id
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {

                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_akun + '>' + data[i].kode_akun + ' | ' + data[i].nama_akun + '</option>';
                            }
                            $('#subakun').html(html);
                        }
                    });
                    return false;
                });
                $('#coa').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/jurnalumum/getakunsub",
                        method: "POST",
                        data: {
                            coa: id
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_akun + '>' + data[i].kode_akun + ' | ' + data[i].nama_akun + '</option>';
                            }
                            $('#namacoa').html(html);

                        }
                    });
                    return false;
                });
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $('#rupiah').on("input", function() {
                    var jumuang = $('#rupiah').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    $('#rupiah2').val(hsl);
                })
            });
            $(function() {
                $('#saldo').on("input", function() {
                    var jumuang = $('#saldo').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    $('#saldo2').val(hsl);
                })
            });
        </script>
        <script type="text/javascript">
            var rupiah = document.getElementById('rupiah');
            rupiah.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value);
            });

            var saldo = document.getElementById('saldo');
            saldo.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                saldo.value = formatRupiah(this.value);
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        </script>
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
                            <h4 class="page-title">Jurnal</h4>
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
                                    <a href="#masterdata">Akutansi</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/jurnalumum">Jurnal</a>
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
                                            <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModalCenter">
                                                <i class="fa fa-plus"></i>
                                                Pembelian
                                            </button>&emsp;
                                            <button type="button" class="btn btn-primary" id="hide" data-toggle="modal" data-target="#salDo">
                                                <i class="fas fa-money-check-alt"></i>
                                                Saldo
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <?php $no = 0;
                                    foreach ($saldo->result_array() as $row) {
                                        $no++;
                                    ?>
                                        <div class="modal fade" id="updaTe<?= $row['id_saldo'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Bank/Kas</label>
                                                            <select class="custom-select" name="coa" required>
                                                                <option value="<?= $row['kode_akun'] ?>"><?= $row['nama_akun'] ?></option>
                                                            </select>
                                                            <div class="invalid-feedback">select menu</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="saldo">Jumlah Saldo</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp.</div>
                                                                </div>
                                                                <input type="text" value="<?= $row['saldo_awal'] ?>" class="form-control" id="saldoawal" name="saldoawal" aria-describedby="jumlah" placeholder="Jumlah Saldo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="modal fade" id="salDo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"><b>SALDO BANK DAN KAS</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body was-validated">
                                                    <form action="<?= base_url(); ?>index.php/jurnalumum/tambahsaldo" method="POST">
                                                        <div class="row">
                                                            <div class="col-sm-3 pr-0">
                                                                <div class="form-group">
                                                                    <label for="">Bank/Kas</label>
                                                                    <select class="custom-select" id="kode" name="coa" required>
                                                                        <option value="">&nbsp;</option>
                                                                        <?php foreach ($akun as $b) { ?>
                                                                            <option value="<?= $b->kode_akun ?>"><?= $b->nama_akun ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">select menu</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="">Bank/Kas</label>
                                                                    <select class="custom-select" id="subkodeakun" name="subakun">
                                                                        <option value="">&nbsp;</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="saldo">Jumlah Saldo</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp.</div>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="saldo" name="saldo" aria-describedby="jumlah" placeholder="Jumlah Saldo" required>
                                                                    </div>
                                                                    <input type="hidden" class="form-control" id="saldo2" name="saldo2">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tambah">Tambah</label><br>
                                                                <button type="submit" id="tambah" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <br>
                                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Aksi</th>
                                                                <th>NO.</th>
                                                                <th>Bank / Kas</th>
                                                                <th>Saldo Awal</th>
                                                                <th>Saldo Akhir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0;
                                                            foreach ($saldo->result_array() as $row) {
                                                                $no++;
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <button type="button" onclick="EditSaldo()" class="btn btn-primary btn-link" data-toggle="modal" data-target="#updaTe<?= $row['id_saldo'] ?>"><i class="fas fa-edit"></i></button>
                                                                    </td>
                                                                    <td><?= $no ?></td>
                                                                    <td><?= $row['nama_akun'] ?></td>
                                                                    <td>Rp. <?= number_format($row['saldo_awal']); ?></td>
                                                                    <td>Rp. <?= number_format($row['saldo_akhir']) ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jurnal</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="<?= base_url(); ?>index.php/jurnalumum/insert">
                                                    <div class="modal-body was-validated">
                                                        <div class="row">
                                                            <div class="col-sm-6 pr-0">
                                                                <div class="form-group">
                                                                    <select class="custom-select" id="coa" name="coa" required>
                                                                        <option value="">Open this select menu</option>
                                                                        <?php foreach ($akun as $b) { ?>
                                                                            <option value="<?= $b->kode_akun ?>"><?= $b->nama_akun ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">select menu</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <select class="custom-select" id="namacoa" name="namacoa">

                                                                    </select>
                                                                    <div class="invalid-feedback">select menu</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Tanggal Transaksi</label>
                                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Transaksi" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Uraian</label>
                                                                    <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 pr-0">
                                                                <div class="form-group">
                                                                    <label>Cek/Transfer</label>
                                                                    <select class="custom-select" name="pembayaran" required>
                                                                        <option value="">&nbsp;</option>
                                                                        <option value="Transfer">Transfer</option>
                                                                        <option value="Cek">Cek</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">select Transfer/Cek</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>No. Cek/Transfer</label>
                                                                    <input type="text" class="form-control" id="nomor" name="nomor" placeholder="No. Cek/Transfer" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Debit/Credit</label>
                                                                    <select class="custom-select" name="dc" required>
                                                                        <option value="">&nbsp;</option>
                                                                        <option value="Debit">Debit</option>
                                                                        <option value="Credit">Credit</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">select Debit/Credit</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Kode Akun</label>
                                                                    <select class="custom-select" name="code" required>
                                                                        <option value="">&nbsp;</option>
                                                                        <?php foreach ($coa as $d) : ?>
                                                                            <option value="<?= $d->kode_akun ?>"><?= $d->kode_akun ?>|<?= $d->nama_akun ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">select Akun</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="sr-only">Jumlah Tagihan</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp.</div>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="rupiah" name="rupiah" aria-describedby="jumlah" placeholder="Jumlah Tagihan" required>
                                                                    </div>
                                                                    <input type="hidden" class="form-control" id="rupiah2" name="rupiah2" aria-describedby="jumlah" placeholder="Jumlah Tagihan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Modal -->
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/jurnalumum/lihat" method="POST">
                                            <div class="row">
                                                <div class="col-md-2 pr-0">
                                                    <div class="form-group">
                                                        <label>Pilih Kas/Bank</label>
                                                        <select class="custom-select" id="namaakun" name="namaakun" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php foreach ($akun as $b) { ?>
                                                                <option value="<?= $b->kode_akun ?>"><?= $b->nama_akun ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Pilih Kas/Bank</label>
                                                        <select class="custom-select" id="subakun" name="subakun">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Transaksi</label>
                                                        <input type="month" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Transaksi" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Cek</label><br>
                                                    <button type="submit" class="btn btn-warning"><i class="fas fa-book-open"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php echo $this->session->flashdata('msg'); ?>
                                        <?php
                                        function tgl_indo($tanggal)
                                        {
                                            $bulan = array(
                                                1 =>   'Januari',
                                                'Februari',
                                                'Maret',
                                                'April',
                                                'Mei',
                                                'Juni',
                                                'Juli',
                                                'Agustus',
                                                'September',
                                                'Oktober',
                                                'November',
                                                'Desember'
                                            );
                                            $pecahkan = explode('-', $tanggal);
                                            // variabel pecahkan 0 = tanggal
                                            // variabel pecahkan 1 = bulan
                                            // variabel pecahkan 2 = tahun
                                            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                                        } ?>
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr style='background-color:#ccc;'>
                                                        <th>No.</th>
                                                        <th>Tanggal</th>
                                                        <th>Uraian</th>
                                                        <th>CQ/Transfer</th>
                                                        <th>No CQ/Transfer</th>
                                                        <th>Code</th>
                                                        <th>Debit</th>
                                                        <th>Kredit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($jurnal->result_array() as $row) {
                                                        $no++;
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= tgl_indo(date('Y-m-d', strtotime($row['tanggal']))); ?></td>
                                                            <td><?= $row['uraian'] ?></td>
                                                            <td><?= $row['c_t'] ?></td>
                                                            <td><?= $row['no_dc'] ?></td>
                                                            <td><?= $row['code'] ?></td>
                                                            <td>
                                                                <?php if ($row['d_c'] == 'Debit') {
                                                                    echo "Rp. " . number_format("$row[total]", 2, ",", ".");
                                                                } ?>
                                                            </td>
                                                            <td> <?php if ($row['d_c'] == 'Credit') {
                                                                        echo  "Rp. " . number_format("$row[total]", 2, ",", ".");
                                                                    } ?>
                                                            </td>
                                                        </tr>
                                                    <?php }
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
        <script>
            function EditSaldo() {
                $('#salDo').modal('hide');
                $('#updaTe').modal('show');
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#kode').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/jurnalumum/getsubakun",
                        method: "POST",
                        data: {
                            kode: id
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_akun + '>' + data[i].kode_akun + ' | ' + data[i].nama_akun + '</option>';
                            }
                            $('#subkodeakun').html(html);
                        }
                    });
                    return false;
                });
                $('#namaakun').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/jurnalumum/getakun",
                        method: "POST",
                        data: {
                            namaakun: id
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {

                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_akun + '>' + data[i].kode_akun + ' | ' + data[i].nama_akun + '</option>';
                            }
                            $('#subakun').html(html);
                        }
                    });
                    return false;
                });
                $('#coa').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/jurnalumum/getakunsub",
                        method: "POST",
                        data: {
                            coa: id
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_akun + '>' + data[i].kode_akun + ' | ' + data[i].nama_akun + '</option>';
                            }
                            $('#namacoa').html(html);

                        }
                    });
                    return false;
                });
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $('#rupiah').on("input", function() {
                    var jumuang = $('#rupiah').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    $('#rupiah2').val(hsl);
                })
            });
            $(function() {
                $('#saldo').on("input", function() {
                    var jumuang = $('#saldo').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    $('#saldo2').val(hsl);
                })
            });
        </script>
        <script type="text/javascript">
            var rupiah = document.getElementById('rupiah');
            rupiah.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value);
            });

            var saldo = document.getElementById('saldo');
            saldo.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                saldo.value = formatRupiah(this.value);
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        </script>
    </body>

    </html>
<?php } ?>