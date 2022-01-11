<?php if ($this->session->userdata('lvl') == 'Admin') { ?>
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
                <?php $this->load->view('template/v_logoheader');
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
                        <?php
                        $this->load->view('template/v_pageheader');
                        ?>

                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <i class="fas fa-tshirt"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Total Product</p>
                                                    <h4 class="card-title"><?php echo $this->db->count_all('baranggudang') ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="far fa-newspaper"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Retur Gudang</p>
                                                    <h4 class="card-title"><?php echo $this->db->count_all('detail_returgudang') ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                    <i class="far fa-check-circle"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Order</p>
                                                    <h4 class="card-title">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                                    <i class="far fa-chart-bar"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Sales</p>
                                                    <span class="h4">Rp. <?php
                                                                            foreach ($d as $data) {
                                                                                echo number_format("$data->grandtotal", 2, ",", ".");
                                                                            }
                                                                            ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Total Penjualan /Toko</div>
                                            <div class="card-tools">
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                                    <span class="btn-label">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                    Export
                                                </a>
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                                    <span class="btn-label">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                    Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="min-height: 375px">
                                            <canvas id="myChart" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                        <div id="myChartLegend"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chart JS -->
        <!-- jQuery Sparkline -->
        <script src="<?= base_url(); ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
        <!-- Chart Circle -->
        <script src="<?= base_url(); ?>/assets/js/plugin/chart-circle/circles.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/plugin/chart.js/chart.min.js"></script>
        <script>
            var ctx = document.getElementById('myChart');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        <?php
                        if (count($c) > 0) {
                            foreach ($c as $data) {
                                echo "'" . $data->nama_toko . "',";
                            }
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Daily Sales /Toko',
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: [
                            <?php
                            if (count($c) > 0) {
                                foreach ($c as $data) {
                                    echo $data->grandtotal . ", ";
                                }
                            }
                            ?>
                        ]
                    }, ]
                },
            });
        </script>
        <!-- Custom template | don't include it in your project! -->
        <?php
        $this->load->view('template/v_costum');
        ?>
        <!-- End Custom template -->
        </div>
        </div>
        </div>
        <?php $this->load->view('template/v_script');
        ?>
    </body>

    </html>

<?php } ?>

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
                <?php $this->load->view('template/v_logoheader');
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
                        <?php
                        $this->load->view('template/v_pageheader');
                        ?>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <i class="fas fa-tshirt"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Product</p>
                                                    <h4 class="card-title"><?php
                                                                            foreach ($p as $data) {
                                                                                echo $data->no_barang;
                                                                            }
                                                                            ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="fas fa-luggage-cart"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Retur</p>
                                                    <h4 class="card-title"><?php
                                                                            foreach ($r as $data) {
                                                                                echo $data->kode_stokout;
                                                                            }
                                                                            ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                                    <i class="far fa-chart-bar"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Sales</p>
                                                    <span class="h4">Rp. <?php
                                                                            foreach ($d as $data) {
                                                                                echo number_format("$data->grandtotal", 2, ",", ".");
                                                                            }
                                                                            ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                    <i class="flaticon-box-2"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Order</p>
                                                    <h4 class="card-title"><?php
                                                                            foreach ($t as $data) {
                                                                                echo $data->kode_order;
                                                                            }
                                                                            ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Barang Terlaris</div>
                                            <div class="card-tools">
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                                    <span class="btn-label">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                    Export
                                                </a>
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                                    <span class="btn-label">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                    Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="min-height: 375px">
                                            <canvas id="myChart3"></canvas>
                                        </div>
                                        <div id="myChart3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <div class="card-title">Daily Sales</div>
                                        <div class="card-category"><?= date('d-M-Y') ?></div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="mb-4 mt-2">
                                            <h1><?php
                                                foreach ($h as $data) {
                                                    echo "Rp " . number_format($data->grandtotal, 2, ',', '.');
                                                }
                                                ?></h1>
                                        </div>
                                        <div class="pull-in">
                                            <canvas id="dailySalesChart"></canvas>
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
        </div>
        <!-- Chart JS -->
        <!-- jQuery Sparkline -->
        <script src="<?= base_url(); ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
        <!-- Chart Circle -->
        <script src="<?= base_url(); ?>/assets/js/plugin/chart-circle/circles.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/plugin/chart.js/chart.min.js"></script>
        <script>
            var ctx = document.getElementById('myChart3');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        <?php
                        if (count($l) > 0) {
                            foreach ($l as $data) {
                                echo "'" . $data->nama_barang . "',";
                            }
                        }

                        ?>

                    ],
                    datasets: [{
                        label: 'Barang Terlaris',
                        borderColor: "#f3545d",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#f3545d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: [
                            <?php
                            if (count($l) > 0) {
                                foreach ($l as $data) {
                                    echo $data->jumlah . ", ";
                                }
                            }

                            ?>

                        ]
                    }, ]
                },
            });
        </script>
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
                <?php $this->load->view('template/v_logoheader');
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
                        <?php
                        $this->load->view('template/v_pageheader');
                        ?>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-primary card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-tshirt"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Total Product</p>
                                                    <h4 class="card-title"><?php echo $this->db->count_all('baranggudang') ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-info card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-box-1"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Retur</p>
                                                    <h4 class="card-title"><?php echo $this->db->count_all('detail_returgudang') ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-success card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-analytics"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Sales</p>
                                                    <span class="h4">Rp. <?php
                                                                            foreach ($d as $data) {
                                                                                echo number_format("$data->grandtotal", 2, ",", ".");
                                                                            }
                                                                            ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-secondary card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-success"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Order</p>
                                                    <h4 class="card-title">200</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Penjualan per/Toko</div>
                                            <div class="card-tools">
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                                    <span class="btn-label">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                    Export
                                                </a>
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                                    <span class="btn-label">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                    Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="min-height: 375px">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                        <div id="myChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Chart JS -->
        <!-- jQuery Sparkline -->
        <script src="<?= base_url(); ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
        <!-- Chart Circle -->
        <script src="<?= base_url(); ?>/assets/js/plugin/chart-circle/circles.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/plugin/chart.js/chart.min.js"></script>
        <script>
            var ctx = document.getElementById('myChart');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        <?php
                        if (count($c) > 0) {
                            foreach ($c as $data) {
                                echo "'" . $data->nama_toko . "',";
                            }
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Total Penjualan /Toko',
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: [
                            <?php
                            if (count($c) > 0) {
                                foreach ($c as $data) {
                                    echo $data->subtotal . ", ";
                                }
                            }
                            ?>
                        ]
                    }, ]
                },
            });
        </script>
        <!-- Custom template | don't include it in your project! -->
        <?php
        $this->load->view('template/v_costum');
        ?>
        <!-- End Custom template -->
        </div>
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
                <?php $this->load->view('template/v_logoheader');
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
                        <?php
                        $this->load->view('template/v_pageheader');
                        ?>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-primary card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-tshirt"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Total Product</p>
                                                    <h4 class="card-title"><?php echo $this->db->count_all('baranggudang') ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-info card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-cubes"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Retur</p>
                                                    <h4 class="card-title">1303</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-success card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-analytics"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Sales</p>
                                                    <span class="h4">Rp. <?php
                                                                            foreach ($d as $data) {
                                                                                echo number_format("$data->grandtotal", 2, ",", ".");
                                                                            }
                                                                            ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-secondary card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-success"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Order</p>
                                                    <h4 class="card-title">576</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Daily Sales /Toko</div>
                                            <div class="card-tools">
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                                    <span class="btn-label">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                    Export
                                                </a>
                                                <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                                    <span class="btn-label">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                    Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="min-height: 375px">
                                            <canvas id="myChart" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                        <div id="myChartLegend"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <div class="card-title">Daily Sales</div>
                                        <div class="card-category"><?= date('d-M-y'); ?></div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="mb-4 mt-2">
                                            <h1><?php
                                                foreach ($t as $data) {
                                                    echo "Rp " . number_format($data->grandtotal, 2, ',', '.');
                                                }
                                                ?></h1>
                                        </div>
                                        <div class="pull-in">
                                            <canvas id="dailySalesChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Chart JS -->
            <!-- jQuery Sparkline -->
            <script src="<?= base_url(); ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
            <!-- Chart Circle -->
            <script src="<?= base_url(); ?>/assets/js/plugin/chart-circle/circles.min.js"></script>
            <script src="<?= base_url(); ?>/assets/js/plugin/chart.js/chart.min.js"></script>
            <script>
                var ctx = document.getElementById('myChart');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            <?php
                            if (count($c) > 0) {
                                foreach ($c as $data) {
                                    echo "'" . $data->nama_toko . "',";
                                }
                            }
                            ?>
                        ],
                        datasets: [{
                            label: 'Total Penjualan /Toko',
                            borderColor: "#1d7af3",
                            pointBorderColor: "#FFF",
                            pointBackgroundColor: "#1d7af3",
                            pointBorderWidth: 2,
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 1,
                            pointRadius: 4,
                            backgroundColor: 'transparent',
                            fill: true,
                            borderWidth: 2,
                            data: [
                                <?php
                                if (count($c) > 0) {
                                    foreach ($c as $data) {
                                        echo $data->grandtotal . ", ";
                                    }
                                }
                                ?>
                            ]
                        }, ]
                    },
                });
            </script>
            <!-- Custom template | don't include it in your project! -->
            <?php
            $this->load->view('template/v_costum');
            ?>
            <!-- End Custom template -->
        </div>
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
                <?php $this->load->view('template/v_logoheader');
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
                        <?php
                        $this->load->view('template/v_pageheader');
                        ?>


                    </div>
                </div>
            </div>

            <?php
            $this->load->view('template/v_costum');
            ?>
            <!-- End Custom template -->
        </div>
        </div>
        </div>
        <?php $this->load->view('template/v_script');
        ?>
    </body>

    </html>
<?php } ?>