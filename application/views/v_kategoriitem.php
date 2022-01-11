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
                            <h4 class="page-title">DataProduk/Item</h4>
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
                                    <a href="#Masterdata">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#Kategori">KategoriBarang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/kategoriitem">Produk/Item</a>
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
                                            <a href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Modal Tambah -->
                                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                New</span>
                                                            <span class="fw-light">
                                                                Data KategoriProduk/Item
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/kategoriitem/insert">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Produk/Item</label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Produk/Item" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" class="btn btn-primary" id="alert_demo_3_3">Add</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Modal Edit -->
                                        <?php $no = 1;
                                        foreach ($item->result_array() as $b) {
                                            $no++;
                                            $id = $b['kode_item'];
                                            $nm = $b['nama_item'];
                                            $create = $b['created_at'];
                                            $update = $b['updated_at'];
                                        ?>
                                            <div class="modal fade" id="modalEdit<?= $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Edit</span>
                                                                <span class="fw-light">
                                                                    Data Kategori Produk/Item
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?php echo base_url(); ?>index.php/kategoriitem/updateowner">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>ID. Produk/Item</label>
                                                                            <input id="id" name="id" value="<?= $id ?>" type="text" class="form-control" placeholder="ID. Produk/Item" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama Produk/Item</label>
                                                                            <input id="nama" name="nama" value="<?= $nm ?>" type="text" class="form-control" placeholder="Nama Produk/Item" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-primary" value="Edit">Edit</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="modalHapus<?= $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Delete</span>
                                                                <span class="fw-light">
                                                                    Data kategoriProduk/Item
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/kategoriitem/delete">
                                                            <div class="modal-body">
                                                                <p>Yakin mau menghapus data <?php echo $nm; ?>..?</p>
                                                                <input name="id" type="hidden" value="<?php echo $id; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" value="delete">Delete</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <!-- End Modal -->
                                        <!-- =================================================================== -->
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($item->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['kode_item'];
                                                        $nm = $b['nama_item'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#modalEdit<?= $id ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a href="#modalHapus<?= $id ?>" class="btn btn-link btn-danger" data-toggle="modal" data-original-title="Remove">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
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
                            <h4 class="page-title">DataProduk/Item</h4>
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
                                    <a href="#Masterdata">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#Kategori">KategoriBarang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/kategoriitem">Produk/Item</a>
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
                                            <a href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Modal Tambah -->
                                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                New</span>
                                                            <span class="fw-light">
                                                                Data KategoriProduk/Item
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/kategoriitem/insert">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Produk/Item</label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Produk/Item" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" class="btn btn-primary" id="alert_demo_3_3">Add</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Modal Edit -->
                                        <?php $no = 1;
                                        foreach ($item->result_array() as $b) {
                                            $no++;
                                            $id = $b['kode_item'];
                                            $nm = $b['nama_item'];
                                            $create = $b['created_at'];
                                            $update = $b['updated_at'];
                                        ?>
                                            <div class="modal fade" id="modalEdit<?= $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Edit</span>
                                                                <span class="fw-light">
                                                                    Data Kategori Produk/Item
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?php echo base_url(); ?>index.php/kategoriitem/update">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>ID. Produk/Item</label>
                                                                            <input id="id" name="id" value="<?= $id ?>" type="text" class="form-control" placeholder="ID. Produk/Item" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama Produk/Item</label>
                                                                            <input id="nama" name="nama" value="<?= $nm ?>" type="text" class="form-control" placeholder="Nama Produk/Item" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-primary" value="Edit">Edit</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div id="modalHapus<?= $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Delete</span>
                                                                <span class="fw-light">
                                                                    Data kategoriProduk/Item
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/kategoriitem/delete">
                                                            <div class="modal-body">
                                                                <p>Yakin mau menghapus data <?php echo $nm; ?>..?</p>
                                                                <input name="id" type="hidden" value="<?php echo $id; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" value="delete">Delete</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> -->
                                        <?php
                                        }
                                        ?>

                                        <!-- End Modal -->
                                        <!-- =================================================================== -->
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($item->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['kode_item'];
                                                        $nm = $b['nama_item'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#modalEdit<?= $id ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <!-- <a href="#modalHapus<?= $id ?>" class="btn btn-link btn-danger" data-toggle="modal" data-original-title="Remove">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a> -->
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
                            <h4 class="page-title">DataProduk/Item</h4>
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
                                    <a href="#Masterdata">MasterData</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#Kategori">KategoriBarang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/kategoriitem">Produk/Item</a>
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
                                            <a href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Modal Tambah -->
                                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                New</span>
                                                            <span class="fw-light">
                                                                Data KategoriProduk/Item
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/kategoriitem/insert">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Produk/Item</label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Produk/Item" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" class="btn btn-primary" id="alert_demo_3_3">Add</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Modal Edit -->
                                        <?php $no = 1;
                                        foreach ($item->result_array() as $b) {
                                            $no++;
                                            $id = $b['kode_item'];
                                            $nm = $b['nama_item'];
                                            $create = $b['created_at'];
                                            $update = $b['updated_at'];
                                        ?>
                                            <div class="modal fade" id="modalEdit<?= $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Edit</span>
                                                                <span class="fw-light">
                                                                    Data Kategori Produk/Item
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?php echo base_url(); ?>index.php/kategoriitem/update">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>ID. Produk/Item</label>
                                                                            <input id="id" name="id" value="<?= $id ?>" type="text" class="form-control" placeholder="ID. Produk/Item" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama Produk/Item</label>
                                                                            <input id="nama" name="nama" value="<?= $nm ?>" type="text" class="form-control" placeholder="Nama Produk/Item" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-primary" value="Edit">Edit</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <!-- End Modal -->
                                        <!-- =================================================================== -->
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($item->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['kode_item'];
                                                        $nm = $b['nama_item'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#modalEdit<?= $id ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
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