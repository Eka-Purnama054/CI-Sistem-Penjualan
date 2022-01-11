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
                            <h4 class="page-title">Detail Data Barang</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-badge info"><i class="fas fa-tshirt"></i></div>
                                        <div class="timeline-panel">
                                            <?php $b = $det->row_array() ?>
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title"><?= $b['kode_barang'] ?></h4>
                                            </div>
                                            <div class="timeline-body">
                                                <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="20%">Nama Barang</td>
                                                        <td width="1%">: </td>
                                                        <td> <?= $b['nama_barang'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ukuran</td>
                                                        <td width="1%">: </td>
                                                        <td> <?= $b['nama_size'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Warna</td>
                                                        <td width="1%">: </td>
                                                        <td> <?= $b['nama_warna'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Pokok</td>
                                                        <td width="1%">: </td>
                                                        <td> Rp. <?= number_format("$b[hargapokok]", 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Grosir</td>
                                                        <td width="1%">: </td>
                                                        <td> Rp. <?= number_format("$b[hargagrosir]", 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Jual</td>
                                                        <td width="1%">: </td>
                                                        <td> Rp. <?= number_format("$b[hargajual]", 2, ",", ".") ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Stok Barang</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="sTok" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Paling Laku</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="PalingLaku" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Day</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="Day" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Month</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="Month" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Tahun</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="yeAr" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
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
                var barChart = document.getElementById('sTok').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($stok) > 0) {
                                        foreach ($stok as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Stok /Toko",
                            backgroundColor: '#59d05d',
                            borderColor: '#59d05d',
                            data: [<?php
                                    if (count($stok) > 0) {
                                        foreach ($stok as $data) {
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

                var barChart = document.getElementById('PalingLaku').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($laku) > 0) {
                                        foreach ($laku as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Terjual",
                            backgroundColor: '#019efd',
                            borderColor: '#019efd',
                            data: [<?php
                                    if (count($laku) > 0) {
                                        foreach ($laku as $data) {
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

                var barChart = document.getElementById('Day').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($day) > 0) {
                                        foreach ($day as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Day",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($day) > 0) {
                                        foreach ($day as $data) {
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
                var barChart = document.getElementById('Month').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Month",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
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
                var barChart = document.getElementById('yeAr').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($year) > 0) {
                                        foreach ($year as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Year",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($year) > 0) {
                                        foreach ($year as $data) {
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
            </script>
            <script>
                var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
                var myMultipleLineChart = new Chart(multipleLineChart, {
                    type: 'line',
                    data: {
                        labels: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "",
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
                            data: []
                        }, {
                            label: "Toko 2",
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
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo $data->jumlah . ", ";
                                        }
                                    }
                                    ?>]
                        }, {
                            label: "Toko 3",
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
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo $data->jumlah . ", ";
                                        }
                                    }
                                    ?>]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'top',
                        },
                        tooltips: {
                            bodySpacing: 4,
                            mode: "nearest",
                            intersect: 0,
                            position: "nearest",
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        layout: {
                            padding: {
                                left: 15,
                                right: 15,
                                top: 15,
                                bottom: 15
                            }
                        }
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
                            <h4 class="page-title">Detail Data Barang</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-badge info"><i class="fas fa-tshirt"></i></div>
                                        <div class="timeline-panel">
                                            <?php $b = $det->row_array() ?>
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title"><?= $b['kode_barang'] ?></h4>
                                            </div>
                                            <div class="timeline-body">
                                                <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="20%">Nama Barang</td>
                                                        <td width="1%">:</td>
                                                        <td><?= $b['nama_barang'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ukuran</td>
                                                        <td width="1%">:</td>
                                                        <td><?= $b['nama_size'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Warna</td>
                                                        <td width="1%">:</td>
                                                        <td><?= $b['nama_warna'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Pokok</td>
                                                        <td width="1%">:</td>
                                                        <td>Rp. <?= number_format("$b[hargapokok]", 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Grosir</td>
                                                        <td width="1%">:</td>
                                                        <td>Rp. <?= number_format("$b[hargagrosir]", 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Jual</td>
                                                        <td width="1%">:</td>
                                                        <td>Rp. <?= number_format("$b[hargajual]", 2, ",", ".") ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Stok Barang</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="sTok" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Paling Laku</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="PalingLaku" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Day</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="Day" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Month</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="Month" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Tahun</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="yeAr" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
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
                var barChart = document.getElementById('sTok').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($stok) > 0) {
                                        foreach ($stok as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Stok /Toko",
                            backgroundColor: '#59d05d',
                            borderColor: '#59d05d',
                            data: [<?php
                                    if (count($stok) > 0) {
                                        foreach ($stok as $data) {
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

                var barChart = document.getElementById('PalingLaku').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($laku) > 0) {
                                        foreach ($laku as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Terjual",
                            backgroundColor: '#f3545d',
                            borderColor: '#f3545d',
                            data: [<?php
                                    if (count($laku) > 0) {
                                        foreach ($laku as $data) {
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

                var barChart = document.getElementById('Day').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($day) > 0) {
                                        foreach ($day as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Day",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($day) > 0) {
                                        foreach ($day as $data) {
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
                var barChart = document.getElementById('Month').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Month",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
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
                var barChart = document.getElementById('yeAr').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($year) > 0) {
                                        foreach ($year as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Year",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($year) > 0) {
                                        foreach ($year as $data) {
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
            </script>
            <script>
                var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
                var myMultipleLineChart = new Chart(multipleLineChart, {
                    type: 'line',
                    data: {
                        labels: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "",
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
                            data: []
                        }, {
                            label: "Toko 2",
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
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo $data->jumlah . ", ";
                                        }
                                    }
                                    ?>]
                        }, {
                            label: "Toko 3",
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
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo $data->jumlah . ", ";
                                        }
                                    }
                                    ?>]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'top',
                        },
                        tooltips: {
                            bodySpacing: 4,
                            mode: "nearest",
                            intersect: 0,
                            position: "nearest",
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        layout: {
                            padding: {
                                left: 15,
                                right: 15,
                                top: 15,
                                bottom: 15
                            }
                        }
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
                            <h4 class="page-title">Detail Data Barang</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-badge info"><i class="fas fa-tshirt"></i></div>
                                        <div class="timeline-panel">
                                            <?php $b = $det->row_array() ?>
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title"><?= $b['kode_barang'] ?></h4>
                                            </div>
                                            <div class="timeline-body">
                                                <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="20%">Nama Barang</td>
                                                        <td width="1%">: </td>
                                                        <td> <?= $b['nama_barang'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ukuran</td>
                                                        <td width="1%">: </td>
                                                        <td> <?= $b['nama_size'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Warna</td>
                                                        <td width="1%">: </td>
                                                        <td> <?= $b['nama_warna'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Pokok</td>
                                                        <td width="1%">: </td>
                                                        <td> Rp. <?= number_format("$b[hargapokok]", 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Grosir</td>
                                                        <td width="1%">: </td>
                                                        <td> Rp. <?= number_format("$b[hargagrosir]", 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Jual</td>
                                                        <td width="1%">: </td>
                                                        <td> Rp. <?= number_format("$b[hargajual]", 2, ",", ".") ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Stok Barang</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="sTok" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Paling Laku</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="PalingLaku" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Day</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="Day" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Month</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="Month" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Penjualan/Tahun</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="yeAr" style="display: block; width: 468px; height: 300px;" width="468" height="300" class="chartjs-render-monitor"></canvas>
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
                var barChart = document.getElementById('sTok').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($stok) > 0) {
                                        foreach ($stok as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Stok /Toko",
                            backgroundColor: '#59d05d',
                            borderColor: '#59d05d',
                            data: [<?php
                                    if (count($stok) > 0) {
                                        foreach ($stok as $data) {
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

                var barChart = document.getElementById('PalingLaku').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($laku) > 0) {
                                        foreach ($laku as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Terjual",
                            backgroundColor: '#019efd',
                            borderColor: '#019efd',
                            data: [<?php
                                    if (count($laku) > 0) {
                                        foreach ($laku as $data) {
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

                var barChart = document.getElementById('Day').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($day) > 0) {
                                        foreach ($day as $data) {
                                            echo "'" . $data->nama_toko . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Day",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($day) > 0) {
                                        foreach ($day as $data) {
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
                var barChart = document.getElementById('Month').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Month",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
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
                var barChart = document.getElementById('yeAr').getContext('2d');
                var myBarChart = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    if (count($year) > 0) {
                                        foreach ($year as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "Penjualan/Year",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: [<?php
                                    if (count($year) > 0) {
                                        foreach ($year as $data) {
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
            </script>
            <script>
                var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
                var myMultipleLineChart = new Chart(multipleLineChart, {
                    type: 'line',
                    data: {
                        labels: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo "'" . $data->tanggal . "',";
                                        }
                                    }
                                    ?>],
                        datasets: [{
                            label: "",
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
                            data: []
                        }, {
                            label: "Toko 2",
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
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo $data->jumlah . ", ";
                                        }
                                    }
                                    ?>]
                        }, {
                            label: "Toko 3",
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
                            data: [<?php
                                    if (count($month) > 0) {
                                        foreach ($month as $data) {
                                            echo $data->jumlah . ", ";
                                        }
                                    }
                                    ?>]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'top',
                        },
                        tooltips: {
                            bodySpacing: 4,
                            mode: "nearest",
                            intersect: 0,
                            position: "nearest",
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        layout: {
                            padding: {
                                left: 15,
                                right: 15,
                                top: 15,
                                bottom: 15
                            }
                        }
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