<?php if ($this->session->userdata('lvl') == 'Admin') { ?>
    <div class="sidebar">
        <div class="sidebar-background"></div>
        <div class="sidebar-wrapper scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $this->session->userdata('lvl'); ?>
                                <span class="user-level"><?= $this->session->userdata('nama'); ?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/user/profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/login/logout">
                                        <span class="link-collapse">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="<?= base_url(); ?>index.php/homeadmin">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Master Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-toggle="collapse" href="#subnav1">
                                        <span class="sub-item">Data Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/baranggudang">
                                                    <span class="sub-item">Gudang</span>
                                                </a>
                                            </li>
                                            <?php
                                            //datamainmenu
                                            $main_menu = $this->db->get('toko');
                                            foreach ($main_menu->result() as $main) {
                                                // Query untuk mencari data sub menu
                                                $link =  'barangtoko/ambiltokoid/' . $main->id_toko;
                                                $sub_menu = $this->db->get_where('toko');
                                                echo "<li>";
                                                echo " <a href='$link'><span class='sub-item'>$main->nama_toko</span></a>";
                                                echo "<li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#kategori">
                                        <span class="sub-item">Kategori Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="kategori">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategoriitem">
                                                    <span class="sub-item">Produk/Item</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategoriwarna">
                                                    <span class="sub-item">Warna</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategorisize">
                                                    <span class="sub-item">Size</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/barang">
                                        <span class="sub-item">Stok Barang</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/satuan">
                                        <span class="sub-item">Data Satuan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/kategoriwarna">
                                        <span class="sub-item">Data Warna</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/user">
                                        <span class="sub-item">Data User</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/toko">
                                        <span class="sub-item">Data Toko</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/datasuplier">
                                        <span class="sub-item">Data Suplier</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>index.php/orderbarang">
                            <i class="fas fa-boxes"></i>
                            <p>Order Barang</p>
                            <span></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-clipboard"></i>
                            <p>Laporan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-toggle="collapse" href="#barang">
                                        <span class="sub-item">Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="barang">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/laporan/lbaranggudang" target="_blank">
                                                    <span class="sub-item">Gudang</span>
                                                </a>
                                            </li>
                                            <?php
                                            //datamainmenu
                                            $main_menu = $this->db->get('toko');
                                            foreach ($main_menu->result() as $main) {
                                                // Query untuk mencari data sub menu
                                                $link =  'laporan/lapbarangtoko/' . $main->id_toko;
                                                $sub_menu = $this->db->get_where('toko');
                                                echo "<li>";
                                                echo " <a href='$link' target='_blank'><span class='sub-item'>$main->nama_toko</span></a>";
                                                echo "<li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#order">
                                        <span class="sub-item">Data Order</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="order">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lorderbarang">
                                                    <span class="sub-item">Order Gudang</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lorderbarang/ldatapotoko">
                                                    <span class="sub-item">Order Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#kirim">
                                        <span class="sub-item">Data Kirim</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="kirim">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lpengiriman/lihatdatastokingudang">
                                                    <span class="sub-item">Pengiriman Dari Suplier</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/Lpengiriman">
                                                    <span class="sub-item">Pengiriman Ke Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#retur">
                                        <span class="sub-item">Data Retur</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="retur">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/dataretur">
                                                    <span class="sub-item">Gudang</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/laporan/datareturtoko">
                                                    <span class="sub-item">Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan">
                                        <span class="sub-item">Penjualan Toko</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan/laptokoperkasir">
                                        <span class="sub-item">Penjualan Kasir</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan">
                                        <span class="sub-item">Laba Rugi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Charts</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-toggle="collapse" href="#subnav2">
                                        <span class="sub-item">Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav2">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/charts">
                                                    <span class="sub-item">Barang</span>
                                                </a>
                                            </li>
                                            <?php
                                            //datamainmenu
                                            $main_menu = $this->db->get('toko');
                                            foreach ($main_menu->result() as $main) {
                                                // Query untuk mencari data sub menu
                                                $link =  'charts/penjualanpalingbanyak/' . $main->id_toko;
                                                $sub_menu = $this->db->get_where('toko');
                                                echo "<li>";
                                                echo " <a href='$link'>
                                    <span class='sub-item'>$main->nama_toko</span></a>";
                                                echo "<li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#akutansi">
                            <i class="fas fa-calculator"></i>
                            <p>Akutansi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="akutansi">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/coa">
                                        <span class="sub-item">COA (Charts Of Account)</span>
                                    </a>
                                    <a href="<?= base_url(); ?>index.php/jurnalumum">
                                        <span class="sub-item">Jurnal</span>
                                    </a>
                                    <a href="<?= base_url(); ?>index.php/grandtotal">
                                        <span class="sub-item">Grand Total</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Sidebar -->
<?php if ($this->session->userdata('lvl') == 'Kasir') { ?>
    <div class="sidebar">

        <div class="sidebar-background"></div>
        <div class="sidebar-wrapper scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $this->session->userdata('lvl'); ?>
                                <span class="user-level"><?= $this->session->userdata('nama'); ?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/user/profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="<?= base_url(); ?>index.php/homekasir">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-database"></i>
                            <p>Master Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/barangtoko">
                                        <span class="sub-item">Barang /Toko</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/stokin">
                                        <span class="sub-item">Stok In</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#subnav1">
                                        <span class="sub-item">Retur</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/stokout">
                                                    <span class="sub-item">Retur Ke Toko</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/stokout/returkegudang">
                                                    <span class="sub-item">Retur Ke Gudang</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>index.php/orderbarang">
                                        <span class="sub-item">Order Barang</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="sub-item">Pembelian Toko</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-book"></i>
                            <p>Laporan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan/lpenjualantoko">
                                        <span class="sub-item">Penjualan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan/lorderbarangt">
                                        <span class="sub-item">Order</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan/lreturtoko">
                                        <span class="sub-item">Retur</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#tutup">
                            <i class="fas fa-book"></i>
                            <p>Tutup Kasiran</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tutup">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/tutupshift">
                                        <span class="sub-item">Tutup Shift</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/tutupharian">
                                        <span class="sub-item">Tutup Harian</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/tutupbulanan">
                                        <span class="sub-item">Tutup Bulanan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/tutuptahunan">
                                        <span class="sub-item">Tutup Tahunan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#">
                            <i class="flaticon-analytics"></i>
                            <p>Charts</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url(); ?>index.php/transaksi">
                            <i class="flaticon-cart-1"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Sidebar -->
<?php if ($this->session->userdata('lvl') == "Gudang") { ?>
    <div class="sidebar">
        <div class="sidebar-background"></div>
        <div class="sidebar-wrapper scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $this->session->userdata('lvl'); ?>
                                <span class="user-level"><?= $this->session->userdata('nama'); ?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/user/profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="<?= base_url(); ?>index.php/homegudang">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Master Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-toggle="collapse" href="#subnav1">
                                        <span class="sub-item">Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/baranggudang">
                                                    <span class="sub-item">Gudang</span>
                                                </a>
                                            </li>
                                            <?php
                                            //datamainmenu

                                            $main_menu = $this->db->get('toko');
                                            foreach ($main_menu->result() as $main) {
                                                // Query untuk mencari data sub menu
                                                $link =  'barangtoko/ambiltokoid/' . $main->id_toko;
                                                $sub_menu = $this->db->get_where('toko');
                                                echo "<li>";
                                                echo " <a href='$link'>
                                    <span class='sub-item'>$main->nama_toko</span></a>";
                                                echo "<li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#kategori">
                                        <span class="sub-item">Kategori Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="kategori">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategoriitem">
                                                    <span class="sub-item">Produk/Item</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategoriwarna">
                                                    <span class="sub-item">Warna</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategorisize">
                                                    <span class="sub-item">Size</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/barang">
                                        <span class="sub-item">Stok Barang</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/satuan">
                                        <span class="sub-item">Data Satuan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/toko">
                                        <span class="sub-item">Data Toko</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/datasuplier">
                                        <span class="sub-item">Data Suplier</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('index.php/permintaan'); ?>">
                                        <span class="sub-item">Permintaan Toko</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/stokout/returdarigudang">
                                        <span class="sub-item">Retur</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-clipboard"></i>
                            <p>Laporan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan/lbaranggudang" target="_blank">
                                        <span class="sub-item">Barang Gudang</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan/tampiltokolap">
                                        <span class="sub-item">Barang /Toko</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan">
                                        <span class="sub-item">Penjualan Toko</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#order">
                                        <span class="sub-item">Data Order</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="order">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lorderbarang">
                                                    <span class="sub-item">Order Gudang</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lorderbarang/ldatapotoko">
                                                    <span class="sub-item">Order Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#kirim">
                                        <span class="sub-item">Data Kirim</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="kirim">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lpengiriman/lihatdatastokingudang">
                                                    <span class="sub-item">Pengiriman Dari Suplier</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/Lpengiriman">
                                                    <span class="sub-item">Pengiriman Ke Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#retur">
                                        <span class="sub-item">Data Retur</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="retur">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/dataretur">
                                                    <span class="sub-item">Gudang</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/laporan/datareturtoko">
                                                    <span class="sub-item">Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan">
                                        <span class="sub-item">Laba Rugi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>index.php/charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Charts</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Sidebar -->
<?php if ($this->session->userdata('lvl') == "Owner") { ?>
    <div class="sidebar">
        <div class="sidebar-background"></div>
        <div class="sidebar-wrapper scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $this->session->userdata('lvl'); ?>
                                <span class="user-level"><?= $this->session->userdata('nama'); ?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/user/profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="<?= base_url(); ?>index.php/homeowner">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="flaticon-database"></i>
                            <p>Master Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-toggle="collapse" href="#subnav1">
                                        <span class="sub-item">Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/baranggudang">
                                                    <span class="sub-item">Gudang</span>
                                                </a>
                                            </li>
                                            <?php
                                            //datamainmenu

                                            $main_menu = $this->db->get('toko');
                                            foreach ($main_menu->result() as $main) {
                                                // Query untuk mencari data sub menu
                                                $link =  'barangtoko/ambiltokoid/' . $main->id_toko;
                                                $sub_menu = $this->db->get_where('toko');
                                                echo "<li>";
                                                echo " <a href='$link'>
                                    <span class='sub-item'>$main->nama_toko</span></a>";
                                                echo "<li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#kategori">
                                        <span class="sub-item">Kategori Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="kategori">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategoriitem">
                                                    <span class="sub-item">Produk/Item</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategoriwarna">
                                                    <span class="sub-item">Warna</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/kategorisize">
                                                    <span class="sub-item">Size</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/barang">
                                        <span class="sub-item">Stok Barang</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/satuan">
                                        <span class="sub-item">Data Satuan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/user">
                                        <span class="sub-item">Data User</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/toko">
                                        <span class="sub-item">Data Toko</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/datasuplier">
                                        <span class="sub-item">Data Suplier</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#laporan">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Laporan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="laporan">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/laporan">
                                        <span class="sub-item">Transaksi Penjualan</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#order">
                                        <span class="sub-item">Data Order</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="order">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lorderbarang">
                                                    <span class="sub-item">Order Gudang</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lorderbarang/ldatapotoko">
                                                    <span class="sub-item">Order Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#kirim">
                                        <span class="sub-item">Data Kirim</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="kirim">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/lpengiriman/lihatdatastokingudang">
                                                    <span class="sub-item">Pengiriman Dari Suplier</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/Lpengiriman">
                                                    <span class="sub-item">Pengiriman Ke Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#retur">
                                        <span class="sub-item">Data Retur</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="retur">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/dataretur">
                                                    <span class="sub-item">Gudang</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/laporan/datareturtoko">
                                                    <span class="sub-item">Toko</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Charts</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-toggle="collapse" href="#subnav2">
                                        <span class="sub-item">Barang</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav2">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/charts">
                                                    <span class="sub-item">Gudang</span>
                                                </a>
                                            </li>
                                            <?php
                                            //datamainmenu

                                            $main_menu = $this->db->get('toko');
                                            foreach ($main_menu->result() as $main) {
                                                // Query untuk mencari data sub menu
                                                $link =  'charts/penjualanpalingbanyak/' . $main->id_toko;
                                                $sub_menu = $this->db->get_where('toko');
                                                echo "<li>";
                                                echo " <a href='$link'>
                                    <span class='sub-item'>$main->nama_toko</span></a>";
                                                echo "<li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#akutansi">
                            <i class="fas fa-calculator"></i>
                            <p>Akutansi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="akutansi">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/coa">
                                        <span class="sub-item">COA (Charts Of Account)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Sidebar -->
<?php if ($this->session->userdata('lvl') == "Suplier") { ?>
    <div class="sidebar">
        <div class="sidebar-background"></div>
        <div class="sidebar-wrapper scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $this->session->userdata('lvl'); ?>
                                <span class="user-level"><?= $this->session->userdata('nama'); ?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/user/profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="<?= base_url(); ?>index.php/homesuplier">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>index.php/permintaan">
                            <i class="fas fa-luggage-cart"></i>
                            <p>Permintaan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>index.php/barangsuplier">
                            <i class="fas fa-tshirt"></i>
                            <p>Barang</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Sidebar -->