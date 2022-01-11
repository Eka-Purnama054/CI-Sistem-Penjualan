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
                            <h4 class="page-title">DataSemuaStokBarang</h4>
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
                                    <a href="#">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/barang">BarangAll</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Gudang</th>
                                                        <?php
                                                        foreach ($tk->result() as $row) {
                                                            echo "<th>";
                                                            echo "$row->nama_toko";
                                                            echo "</th>";
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($bar->result_array() as $row) :
                                                        $kode = $row['kode_barang'];
                                                        $id = $row['no_barang'];
                                                        $stok = $row['stok_gudang'];
                                                    ?>
                                                        <tr>
                                                            <td><a href="<?= base_url('index.php/barang/detail/' . $id); ?>" class="btn btn-link btn-sm"><?= $kode ?></a></td>
                                                            <td><?= $stok ?></td>
                                                            <?php
                                                            foreach ($tk->result() as $b) {
                                                                $cek = $this->db->get_where('barangtoko', ['no_barang' => $id, 'id_toko' => $b->id_toko])->row_array();
                                                                if ($cek && $b->id_toko) {
                                                                    echo "<td>";
                                                                    echo "$cek[stok_toko]";
                                                                    echo "</td>";
                                                                } else {
                                                                    echo "<td>";
                                                                    echo "";
                                                                    echo "</td>";
                                                                }
                                                            }
                                                            ?>
                                                        </tr>
                                                    <?php endforeach; ?>
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
            <script class="text/javascript">

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
                            <h4 class="page-title">DataSemuaStokBarang</h4>
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
                                    <a href="#">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/barang">BarangAll</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Gudang</th>
                                                        <?php
                                                        foreach ($tk->result() as $row) {
                                                            echo "<th>";
                                                            echo "$row->nama_toko";
                                                            echo "</th>";
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($bar->result_array() as $row) :
                                                        $kode = $row['kode_barang'];
                                                        $id = $row['no_barang'];
                                                        $stok = $row['stok_gudang'];
                                                    ?>
                                                        <tr>
                                                            <td><a href="<?= base_url('index.php/barang/detail/' . $id); ?>" class="btn btn-link btn-sm"><?= $kode ?></a></td>
                                                            <td><?= $stok ?></td>
                                                            <?php
                                                            foreach ($tk->result() as $b) {
                                                                $cek = $this->db->get_where('barangtoko', ['no_barang' => $id, 'id_toko' => $b->id_toko])->row_array();
                                                                if ($cek && $b->id_toko) {
                                                                    echo "<td>";
                                                                    echo "$cek[stok_toko]";
                                                                    echo "</td>";
                                                                } else {
                                                                    echo "<td>";
                                                                    echo "";
                                                                    echo "</td>";
                                                                }
                                                            }
                                                            ?>
                                                        </tr>
                                                    <?php endforeach; ?>
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
            <script class="text/javascript">

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
                            <h4 class="page-title">DataSemuaStokBarang</h4>
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
                                    <a href="#">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/barang">BarangAll</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Gudang</th>
                                                        <?php
                                                        foreach ($tk->result() as $row) {
                                                            echo "<th>";
                                                            echo "$row->nama_toko";
                                                            echo "</th>";
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($bar->result_array() as $row) :
                                                        $kode = $row['kode_barang'];
                                                        $id = $row['no_barang'];
                                                        $stok = $row['stok_gudang'];
                                                    ?>
                                                        <tr>
                                                            <td><a href="<?= base_url('index.php/barang/detail/' . $id); ?>" class="btn btn-link btn-sm"><?= $kode ?></a></td>
                                                            <td><?= $stok ?></td>
                                                            <?php
                                                            $i = $bar->row_array();
                                                            foreach ($tk->result() as $b) {
                                                                $cek = $this->db->get_where('barangtoko', ['no_barang' => $id, 'id_toko' => $b->id_toko])->row_array();
                                                                if ($cek && $b->id_toko) {
                                                                    echo "<td>";
                                                                    echo "$cek[stok_toko]";
                                                                    echo "</td>";
                                                                } else {
                                                                    echo "<td>";
                                                                    echo "";
                                                                    echo "</td>";
                                                                }
                                                            }
                                                            ?>
                                                        </tr>
                                                    <?php endforeach; ?>
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
            <script class="text/javascript">

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