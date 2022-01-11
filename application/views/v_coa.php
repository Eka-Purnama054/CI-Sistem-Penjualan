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
                            <h4 class="page-title">DataCoa</h4>
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
                                    <a href="<?= base_url(); ?>index.php/coa">Coa</a>
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
                                            <a href="<?= base_url(); ?>index.php/coa/halamantambahcoa" class="btn btn-primary btn-round ml-auto">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Modal Edit -->
                                    <?php foreach ($coa->result_array() as $row) {
                                        $kode = $row['kode_akun'];
                                        $nama = $row['nama_akun'];
                                    ?>
                                        <div class="modal fade" id="editCoa<?= $kode ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit COA (Charts Of Account)</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url(); ?>index.php/coa/update" method="POST">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="namaakun">Nama Akun</label>
                                                                <input type="text" value="<?= $nama ?>" class="form-control form-control" id="namaakun" name="namaakun" placeholder="Nama Akun" required>
                                                                <input type="hidden" value="<?= $kode ?>" class="form-control form-control" id="kodeakun" name="kodeakun">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="hapusCoa<?= $kode ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus COA (Charts Of Account)</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url(); ?>index.php/coa/delete" method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?= $kode ?>" class="form-control form-control" id="kodeakun" name="kodeakun">
                                                            <h5>Apakah Anda Yakin Akan Menghapus Data <?= $nama ?> ?</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- End Modal -->

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;text-align: center;">Aksi</th>
                                                        <th style="width: 100px;">Kode Akun</th>
                                                        <th>Nama Akun</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($coa->result_array() as $row) {
                                                        $kode = $row['kode_akun'];
                                                        $nama = $row['nama_akun'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <button class='btn btn-primary btn-link' data-target="#editCoa<?= $kode ?>" data-toggle='modal' data-original-title='Edit Task'>
                                                                    <span class='fa fa-edit'></span>
                                                                </button>
                                                                <button class='btn btn-primary btn-link' data-toggle='modal' data-target="#hapusCoa<?= $kode ?>" data-original-title='Delete Task'>
                                                                    <span class='fa fa-trash'></span>
                                                                </button>
                                                            </td>
                                                            <td><?= $kode ?></td>
                                                            <td><?= $nama ?></td>
                                                        </tr>
                                                    <?php } ?>
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
            <script>
                $(function() {
                    $('#colorselector').change(function() {
                        $('.colors').hide();
                        $('#' + $(this).val()).show();
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
                            <h4 class="page-title">DataCoa</h4>
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
                                    <a href="<?= base_url(); ?>index.php/coa">Coa</a>
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
                                            <a href="<?= base_url(); ?>index.php/coa/halamantambahcoa" class="btn btn-primary btn-round ml-auto">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Modal Edit -->
                                    <?php foreach ($coa->result_array() as $row) {
                                        $kode = $row['kode_akun'];
                                        $nama = $row['nama_akun'];
                                    ?>
                                        <div class="modal fade" id="editCoa<?= $kode ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit COA (Charts Of Account)</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url(); ?>index.php/coa/updateowner" method="POST">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="namaakun">Nama Akun</label>
                                                                <input type="text" value="<?= $nama ?>" class="form-control form-control" id="namaakun" name="namaakun" placeholder="Nama Akun" required>
                                                                <input type="hidden" value="<?= $kode ?>" class="form-control form-control" id="kodeakun" name="kodeakun">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="hapusCoa<?= $kode ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus COA (Charts Of Account)</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url(); ?>index.php/coa/deleteowner" method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?= $kode ?>" class="form-control form-control" id="kodeakun" name="kodeakun">
                                                            <h5>Apakah Anda Yakin Akan Menghapus Data <?= $nama ?> ?</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- End Modal -->

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;text-align: center;">Aksi</th>
                                                        <th style="width: 100px;">Kode Akun</th>
                                                        <th>Nama Akun</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($coa->result_array() as $row) {
                                                        $kode = $row['kode_akun'];
                                                        $nama = $row['nama_akun'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <button class='btn btn-sm btn-primary btn-link' data-target="#editCoa<?= $kode ?>" data-toggle='modal' data-original-title='Edit Task'>
                                                                    <span class='fa fa-edit'></span>
                                                                </button>
                                                                <button class='btn btn-sm btn-primary btn-link' data-toggle='modal' data-target="#hapusCoa<?= $kode ?>" data-original-title='Delete Task'>
                                                                    <span class='fa fa-trash'></span>
                                                                </button>
                                                            </td>
                                                            <td><?= $kode ?></td>
                                                            <td><?= $nama ?></td>
                                                        </tr>
                                                    <?php } ?>
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
            <script>
                $(function() {
                    $('#colorselector').change(function() {
                        $('.colors').hide();
                        $('#' + $(this).val()).show();
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

<?php } ?>