<?php if ($this->session->userdata('lvl') == "Admin") { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title><?= $this->session->userdata('nama'); ?></title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="<?= base_url(); ?>/assets/img/balitees.png" type="image/x-icon" />


        <!-- Fonts and icons -->
        <script src="<?= base_url(); ?>/assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: {
                    "families": ["Open+Sans:300,400,600,700"]
                },
                custom: {
                    "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
                    urls: ['<?= base_url(); ?>/assets/css/fonts.css']
                },
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/azzara.min.css">

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/demo.css">
        <style type="text/css">
            .table-container {
                overflow: auto;
            }
        </style>

    </head>

    <body>
        <div class="page-wrapper">
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
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
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
                                        }
                                        ?>

                                        <div class="card-body">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#jurnal" role="tab" aria-controls="nav-home" aria-selected="true">Journal</a>
                                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#cashFlow" role="tab" aria-controls="nav-profile" aria-selected="false">Cash Flow</a>
                                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#grandTotal" role="tab" aria-controls="nav-profile" aria-selected="false">Grand Total</a>
                                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#Amortisasi" role="tab" aria-controls="nav-profile" aria-selected="false">Amortisasi</a>
                                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#lapFL" role="tab" aria-controls="nav-profile" aria-selected="false">Lap F & L</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="jurnal" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <div class="card-header">
                                                        <?php $b = $lihatjurnal->row_array(); ?>
                                                        <div class="d-flex align-items-center">
                                                            <p style="font-family:'Times New Roman', Times, serif;font-size: 14px;">
                                                                <b>
                                                                    Journal <?= $b['nama_akun'] ?><br />
                                                                    PERIODE : Bulan <?= date('M-Y', strtotime($b['tanggal'])); ?><br>
                                                                </b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table id="add-row" class="display table table-striped table-hover">
                                                            <thead>
                                                                <tr style='background-color:#ccc;'>
                                                                    <th>No.</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Uraian</th>
                                                                    <th>CQ /Transfer</th>
                                                                    <th>No.CQ /Transfer</th>
                                                                    <th>Code</th>
                                                                    <th>Debit</th>
                                                                    <th>Kredit</th>
                                                                    <th>Balance</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="6" style="text-align: center;"><b>Saldo Awal ( Opening Balance )</b></td>
                                                                    <td>Rp. <?= number_format("$b[awal_saldo]"); ?></td>
                                                                    <td></td>
                                                                    <td>Rp. <?= number_format("$b[awal_saldo]"); ?></td>
                                                                </tr>

                                                                <?php $no = 0;
                                                                foreach ($lihatjurnal->result_array() as $row) {
                                                                    $no++;
                                                                    $d = $b['saldo_awal'] - $row['total'];
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
                                                                                echo "Rp. " . number_format("$row[total]");
                                                                            } ?>
                                                                        </td>
                                                                        <td> <?php if ($row['d_c'] == 'Credit') {
                                                                                    echo  "Rp. " . number_format("$row[total]");
                                                                                } ?>
                                                                        </td>
                                                                        <td>Rp.<?= number_format($row['akhir_saldo']) ?></td>
                                                                    </tr>
                                                                <?php }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="6" align="center">Total</td>
                                                                    <td align="right">
                                                                        <?php foreach ($debit as $d) {
                                                                            echo "Rp. " . number_format("$d->debit");
                                                                        } ?>
                                                                    </td>
                                                                    <td align="right">
                                                                        <?php foreach ($credit as $c) {
                                                                            echo "Rp. " . number_format("$c->credit");
                                                                        } ?>
                                                                    </td>
                                                                    <td align="right">Rp. <?= number_format("$b[saldo_akhir]"); ?> </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="cashFlow" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <div class="card-header">
                                                        <?php $b = $lihatjurnal->row_array(); ?>
                                                        <div class="d-flex align-items-center">
                                                            <p style="font-family:'Times New Roman', Times, serif;font-size: 14px;">
                                                                <b>
                                                                    Cash Flow <?= $b['nama_akun'] ?><br />
                                                                    PERIODE : Bulan <?= date('M-Y', strtotime($b['tanggal'])); ?><br>
                                                                </b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="table-container">
                                                        <table class="display table table-striped table-bordered table-hover" width="100%">
                                                            <thead>
                                                                <tr style='background-color:#ccc;'>
                                                                    <th style="text-align: center;">Description</th>
                                                                    <th></th>
                                                                    <th colspan="2" style="text-align: right;">Grand Total</th>
                                                                    <?php

                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<th>";
                                                                        echo $i . " ";
                                                                        echo "</th>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th style="text-align: center;">Saldo Awal ( Opening Balance )</th>
                                                                    <td style="text-align: center;">CODE</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Penerimaan Kas</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;">-</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($akun as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "";
                                                                            echo "</td>";
                                                                        }

                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Penerimaan Internal</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Penerimaan Transaksi</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;">-</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($coa2 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "";
                                                                            echo "</td>";
                                                                        }

                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Penerimaan Proyek / Transaksi</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Transaksi Pemilik</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($coa3 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "";
                                                                            echo "</td>";
                                                                        }

                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Transaksi Pemilik</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Penerimaan Kas</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Pengeluaran Kas</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Pengeluaran Internal</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;">-</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($coa as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "";
                                                                            echo "</td>";
                                                                        }

                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Pengeluaran Internal</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Transaksi Pemilik</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($coa3 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "";
                                                                            echo "</td>";
                                                                        }

                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Transaksi Pemilik</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">IINVESTASI & INVENTARIS</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($coa4 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                        $cek = $this->db->get_where('jurnalumum', ['code' => $row->kode_akun])->row_array();
                                                                        $datet = $cek['tanggal'];
                                                                        $date = date_create($datet);
                                                                        $printtgl = date_format($date, "d");
                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "$cek[total]";
                                                                            echo "</td>";
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Investasi & Inventaris</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">GAJI & TUNJANGAN KARYAWAN</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($coa5 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "";
                                                                            echo "</td>";
                                                                        }

                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Gaji & Tunjangan Karyawan</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;"> BIAYA ADMINISTRASI & OPERASIONAL</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;"></td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($coa6 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "";
                                                                            echo "</td>";
                                                                        }

                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Biaya Administrasi & Operasional</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Pajak & Bank</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;"></td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <?php foreach ($coa7 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td colspan="2" style="text-align: right;">Rp.</td>
                                                                        <?php
                                                                        $tahun = date('Y'); //Mengambil tahun saat ini
                                                                        $bulan = date('m'); //Mengambil bulan saat ini
                                                                        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                        for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                            echo "<td>";
                                                                            echo "";
                                                                            echo "</td>";
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Pajak & Bank</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="2" style="text-align: center;">Total Pajak & BANK</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align: center;">Total Pendapatan & Kas</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align: center;">Total Pengeluaran</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align: center;">Saldo Akhir</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <?php
                                                                    $tahun = date('Y'); //Mengambil tahun saat ini
                                                                    $bulan = date('m'); //Mengambil bulan saat ini
                                                                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                                                                    for ($i = 1; $i < $tanggal + 1; $i++) {
                                                                        echo "<td>";
                                                                        echo "";
                                                                        echo "</td>";
                                                                    }

                                                                    ?>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show active" id="grandTotal" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <div class="card-header">
                                                        <div class="d-flex align-items-center">
                                                            <p style="font-family:'Times New Roman', Times, serif;font-size: 14px;">
                                                                <b>
                                                                    Grand Total<br />
                                                                    PERIODE : Bulan <?= date('M-Y', strtotime($b['tanggal'])); ?><br>
                                                                </b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="display table table-striped table-bordered table-hover" width="100%">
                                                            <thead>
                                                                <tr style='background-color:#ccc;'>
                                                                    <th style="text-align: center;">Description</th>
                                                                    <th></th>
                                                                    <th colspan="2" style="text-align: right;">Grand Total</th>
                                                                    <?php foreach ($coa as $row) {
                                                                        echo "<th>";
                                                                        echo "$row->nama_akun";
                                                                        echo "</th>";
                                                                    } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th style="text-align: center;">Saldo Awal ( Opening Balance )</th>
                                                                    <td style="text-align: center;">CODE</td>
                                                                    <td colspan="2" style="text-align: right;">Rp.</td>
                                                                    <?php foreach ($coa as $row) {
                                                                        $cek = $this->db->get_where('saldo_awal', ['kode_akun' => $row->kode_akun])->row_array();
                                                                        if ($cek) {
                                                                            echo "<td>";
                                                                            echo number_format("$cek[saldo_akhir]");
                                                                            echo "</td>";
                                                                        }
                                                                    } ?>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Penerimaan Kas</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <?php foreach ($akun as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Penerimaan Internal</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Penerimaan Transaksi</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <?php foreach ($coa2 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Penerimaan Proyek / Transaksi</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Transaksi Pemilik</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <?php foreach ($coa3 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Transaksi Pemilik</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Penerimaan Kas</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Pengeluaran Kas</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Pengeluaran Internal</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <?php foreach ($coa as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Pengeluaran Internal</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Transaksi Pemilik</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                </tr>
                                                                <?php foreach ($coa3 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Transaksi Pemilik</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">INVESTASI & INVENTARIS</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                </tr>
                                                                <?php foreach ($coa4 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                        <?php foreach ($coa as $row2) {
                                                                            $cek = $this->db->get_where('jurnalumum', ['code' => $row->kode_akun, 'kode_akun' => $row2->kode_akun])->row_array();
                                                                            if ($cek) {
                                                                                echo "<td>";
                                                                                echo number_format("$cek[total]");
                                                                                echo "</td>";
                                                                            } else {
                                                                                echo "<td>";
                                                                                echo "";
                                                                                echo "</td>";
                                                                            }
                                                                        } ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Investasi & Inventaris</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">GAJI & TUNJANGAN KARYAWAN</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                </tr>
                                                                <?php foreach ($coa5 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Gaji & Tunjangan Karyawan</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;"> BIAYA ADMINISTRASI & OPERASIONAL</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                </tr>
                                                                <?php foreach ($coa6 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Biaya Administrasi & Operasional</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left;">Pajak & Bank</th>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                    <td style="text-align: right;"></td>
                                                                </tr>
                                                                <?php foreach ($coa7 as $row) { ?>
                                                                    <tr>
                                                                        <td style="text-align: left;"><?= $row->nama_akun ?></td>
                                                                        <td style="text-align: center;"><?= $row->kode_akun ?></td>
                                                                        <td style="text-align: right;">Rp.</td>
                                                                        <td style="text-align: right;">-</td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td style="text-align: center;">Total Pajak & Bank</td>
                                                                    <td style="text-align: center;"></td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="2" style="text-align: center;">Total Pajak & BANK</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align: center;">Total Pendapatan & Kas</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align: center;">Total Pengeluaran</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align: center;">Saldo Akhir</td>
                                                                    <td style="text-align: right;">Rp.</td>
                                                                    <td style="text-align: right;">-</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show active" id="Amortisasi" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <div class="card-header">
                                                        <div class="d-flex align-items-center">
                                                            <p style="font-family:'Times New Roman', Times, serif;font-size: 14px;">
                                                                <b>
                                                                    Amortisasi<br />
                                                                    PERIODE : Bulan <?= date('M-Y', strtotime($b['tanggal'])); ?><br>
                                                                </b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="table-container">
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show active" id="lapFL" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <div class="card-header">
                                                        <div class="d-flex align-items-center">
                                                            <p style="font-family:'Times New Roman', Times, serif;font-size: 14px;">
                                                                <b>
                                                                    Lap F & L<br />
                                                                    PERIODE : Bulan <?= date('M-Y', strtotime($b['tanggal'])); ?><br>
                                                                </b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="table-container">
                                                    </div>
                                                </div>
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

<?php if ($this->session->userdata('lvl') == "Owner") { ?>
    <!DOCTYPE html>
    <html lang="en">

    <?php
    $this->load->view('template/v_header');
    ?>

    <body>
        <div class="page-wrapper">
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
                                    <a href="<?= base_url(); ?>index.php/homeowner">
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
                                    }
                                    ?>
                                    <div class="card-header">
                                        <?php $b = $lihatjurnal->row_array(); ?>
                                        <div class="d-flex align-items-center">
                                            <p style="font-family:'Times New Roman', Times, serif;font-size: 14px;">
                                                <b>
                                                    Journal <?= $b['nama_akun'] ?><br />
                                                    PERIODE : Bulan <?= date('M-Y', strtotime($b['tanggal'])); ?><br>
                                                    Saldo Awal : Rp.
                                                </b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr style='background-color:#ccc;'>
                                                        <th>No.</th>
                                                        <th>Tanggal</th>
                                                        <th>Uraian</th>
                                                        <th>CQ /Transfer</th>
                                                        <th>No.CQ /Transfer</th>
                                                        <th>Code</th>
                                                        <th>Debit</th>
                                                        <th>Kredit</th>
                                                        <th>Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($lihatjurnal->result_array() as $row) {
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
                                                            <td></td>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" align="center">Total</td>
                                                        <td>
                                                            <?php foreach ($debit as $d) {
                                                                echo "Rp. " . number_format("$d->debit", 2, ",", ".");
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php foreach ($credit as $c) {
                                                                echo "Rp. " . number_format("$c->credit", 2, ",", ".");
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                </tfoot>
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