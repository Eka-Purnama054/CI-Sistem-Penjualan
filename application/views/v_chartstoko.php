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
                                    <a href="#Charts">Charts</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/charts">Toko</a>
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
                                        <div class="card-title">Penjualan /Bulan <?php
                                                                                    foreach ($nama as $data) {
                                                                                        echo $data->nama_toko;
                                                                                    }
                                                                                    ?> </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChartt" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan /Tahun <?php
                                                                                    foreach ($nama as $data) {
                                                                                        echo $data->nama_toko;
                                                                                    }
                                                                                    ?> </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myCharttt" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Stok Barang Toko</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart2" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Jumlah Penjualan</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
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
                    var barChart = document.getElementById('myChart').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($toko) > 0) {
                                            foreach ($toko as $data) {
                                                echo "'" . $data->nama_barang . "',";
                                            }
                                        }
                                        ?>],
                            datasets: [{
                                label: "Total Penjualan",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($toko) > 0) {
                                            foreach ($toko as $data) {
                                                echo $data->jumlah . ", ";
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
                    var barChart = document.getElementById('myChart2').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($bartoko) > 0) {
                                            foreach ($bartoko as $data) {
                                                echo "'" . $data->nama_barang . "',";
                                            }
                                        }

                                        ?>],
                            datasets: [{
                                label: "Stok Toko",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($bartoko) > 0) {
                                            foreach ($bartoko as $data) {
                                                echo $data->stok_toko . ", ";
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

                    var barChart = document.getElementById('myChartt').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($bulan) > 0) {
                                            foreach ($bulan as $data) {
                                                echo "'" . $data->bulan . "',";
                                            }
                                        }

                                        ?>],
                            datasets: [{
                                label: "Penjualan/Bulan",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($bulan) > 0) {
                                            foreach ($bulan as $data) {
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
                    var barChart = document.getElementById('myCharttt').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($tahun) > 0) {
                                            foreach ($tahun as $data) {
                                                echo "'" . $data->tahun . "',";
                                            }
                                        }
                                        ?>],
                            datasets: [{
                                label: "Penjualan/Tahun",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($tahun) > 0) {
                                            foreach ($tahun as $data) {
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
                                    <a href="#Charts">Charts</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/charts">Toko</a>
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
                                        <div class="card-title">Penjualan /Bulan <?php
                                                                                    foreach ($nama as $data) {
                                                                                        echo $data->nama_toko;
                                                                                    }
                                                                                    ?> </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChartt" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan /Tahun <?php
                                                                                    foreach ($nama as $data) {
                                                                                        echo $data->nama_toko;
                                                                                    }
                                                                                    ?> </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myCharttt" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Stok Barang Toko</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart2" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Jumlah Penjualan</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="myChart" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
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
                    var barChart = document.getElementById('myChart').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($toko) > 0) {
                                            foreach ($toko as $data) {
                                                echo "'" . $data->nama_barang . "',";
                                            }
                                        }
                                        ?>],
                            datasets: [{
                                label: "Total Penjualan",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($toko) > 0) {
                                            foreach ($toko as $data) {
                                                echo $data->jumlah . ", ";
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
                    var barChart = document.getElementById('myChart2').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($bartoko) > 0) {
                                            foreach ($bartoko as $data) {
                                                echo "'" . $data->nama_barang . "',";
                                            }
                                        }

                                        ?>],
                            datasets: [{
                                label: "Stok Toko",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($bartoko) > 0) {
                                            foreach ($bartoko as $data) {
                                                echo $data->stok_toko . ", ";
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

                    var barChart = document.getElementById('myChartt').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($bulan) > 0) {
                                            foreach ($bulan as $data) {
                                                echo "'" . $data->bulan . "',";
                                            }
                                        }

                                        ?>],
                            datasets: [{
                                label: "Penjualan/Bulan",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($bulan) > 0) {
                                            foreach ($bulan as $data) {
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
                    var barChart = document.getElementById('myCharttt').getContext('2d');
                    var myBarChart = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [<?php
                                        if (count($tahun) > 0) {
                                            foreach ($tahun as $data) {
                                                echo "'" . $data->tahun . "',";
                                            }
                                        }
                                        ?>],
                            datasets: [{
                                label: "Penjualan/Tahun",
                                backgroundColor: 'rgb(23, 125, 255)',
                                borderColor: 'rgb(23, 125, 255)',
                                data: [<?php
                                        if (count($tahun) > 0) {
                                            foreach ($tahun as $data) {
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