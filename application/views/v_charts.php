<?php if ($this->session->userdata('lvl') == 'Owner') { ?>
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
                            <h4 class="page-title">Charts</h4>
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
                                    <a href="<?= base_url(); ?>index.php/charts">Charts</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan /Toko</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Stok Gudang</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart2" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Barang Terlaris</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart3" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan Per/Bulan</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart4" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
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
                                if (count($p) > 0) {
                                    foreach ($p as $data) {
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
                                    if (count($p) > 0) {
                                        foreach ($p as $data) {
                                            echo $data->grandtotal . ", ";
                                        }
                                    }
                                    ?>
                                ]
                            }, ]
                        },
                    });

                    var ctx = document.getElementById('myChart2');
                    var chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [
                                <?php
                                if (count($b) > 0) {
                                    foreach ($b as $data) {
                                        echo "'" . $data->nama_barang . "',";
                                    }
                                }

                                ?>
                            ],
                            datasets: [{
                                label: 'Stok Gudang',
                                borderColor: "#59d05d",
                                pointBorderColor: "#FFF",
                                pointBackgroundColor: "#59d05d",
                                pointBorderWidth: 2,
                                pointHoverRadius: 4,
                                pointHoverBorderWidth: 1,
                                pointRadius: 4,
                                backgroundColor: 'transparent',
                                fill: true,
                                borderWidth: 2,
                                data: [
                                    <?php
                                    if (count($b) > 0) {
                                        foreach ($b as $data) {
                                            echo $data->stok_gudang . ", ";
                                        }
                                    }

                                    ?>
                                ]
                            }, ]
                        },
                    });

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
                    var barChart = document.getElementById('myChart4').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($f) > 0) {
                                            foreach ($f as $data) {
                                                echo "'" . $data->bulan . "',";
                                            }
                                        }

                                        ?>],
                            datasets: [{
                                label: "Sales",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($f) > 0) {
                                            foreach ($f as $data) {
                                                echo $data->grandtotal . ", ";
                                            }
                                        }
                                        ?>],
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                        }
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
                            <h4 class="page-title">Charts</h4>
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
                                    <a href="<?= base_url(); ?>index.php/charts">Charts</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan /Toko</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Stok Gudang</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart2" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Barang Terlaris</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart3" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan Per/Bulan</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart4" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
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
                                if (count($p) > 0) {
                                    foreach ($p as $data) {
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
                                    if (count($p) > 0) {
                                        foreach ($p as $data) {
                                            echo $data->subtotal . ", ";
                                        }
                                    }
                                    ?>
                                ]
                            }, ]
                        },
                    });

                    var ctx = document.getElementById('myChart2');
                    var chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [
                                <?php
                                if (count($b) > 0) {
                                    foreach ($b as $data) {
                                        echo "'" . $data->nama_barang . "',";
                                    }
                                }

                                ?>
                            ],
                            datasets: [{
                                label: 'Stok Gudang',
                                borderColor: "#59d05d",
                                pointBorderColor: "#FFF",
                                pointBackgroundColor: "#59d05d",
                                pointBorderWidth: 2,
                                pointHoverRadius: 4,
                                pointHoverBorderWidth: 1,
                                pointRadius: 4,
                                backgroundColor: 'transparent',
                                fill: true,
                                borderWidth: 2,
                                data: [
                                    <?php
                                    if (count($b) > 0) {
                                        foreach ($b as $data) {
                                            echo $data->stok_gudang . ", ";
                                        }
                                    }

                                    ?>
                                ]
                            }, ]
                        },
                    });

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
                    var barChart = document.getElementById('myChart4').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            datasets: [{
                                label: "Sales",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                        }
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