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
                            <h4 class="page-title">DataUser</h4>
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
                                    <a href="<?= base_url(); ?>index.php/user">DataUser</a>
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
                                                <i class="flaticon-add-user"></i>
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
                                                                Data User
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/user/insert">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Username </label>
                                                                        <input id="username" name="username" type="text" class="form-control" placeholder="username" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama </label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Password </label>
                                                                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Alamat </label>
                                                                        <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Alamat" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>No. Telp/HP </label>
                                                                        <input id="telp" name="telp" type="text" class="form-control" placeholder="No. Telp/HP" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Jenis Kelamin </label>
                                                                        <select name="jk" id="jk" class="form-control">
                                                                            <option>---Pilih Jenis Kelamnin---</option>
                                                                            <option value="Perempuan">Perempuan</option>
                                                                            <option value="Lakir-Laki">Lakir-Laki</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Level </label>
                                                                        <select name="level" id="level" class="form-control">
                                                                            <option>---Pilih Level---</option>
                                                                            <option value="Admin">Admin</option>
                                                                            <option value="Kasir">Kasir</option>
                                                                            <option value="Gudang">Gudang</option>
                                                                            <option value="Suplier">Suplier</option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="Kasir" class="levels form-group form-group-default">
                                                                        <label>Toko </label>
                                                                        <select name="toko" id="toko" class="form-control">
                                                                            <option value=>---Pilih Toko---</option>
                                                                            <?php foreach ($toko as $a) :  ?>
                                                                                <option value="<?= $a->id_toko ?>"><?= $a->nama_toko ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="Suplier" class="levels form-group form-group-default">
                                                                        <label>Suplier </label>
                                                                        <select name="supplier" class="form-control">
                                                                            <option value=>---Pilih Suplier---</option>
                                                                            <?php foreach ($supp as $a) :  ?>
                                                                                <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <?php $no = 0;
                                        foreach ($us->result_array() as $b) {
                                            $no++;
                                            $username = $b['username'];
                                            $nm = $b['name'];
                                            $status = $b['status'];
                                            $level = $b['level'];
                                            $telp = $b['no_telp'];
                                            $alamat = $b['alamat'];
                                            $gender = $b['gender'];
                                        ?>
                                            <div class="modal fade" id="updateuser<?= $username ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Update</span>
                                                                <span class="fw-light">
                                                                    Data User
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?= base_url(); ?>index.php/user/update">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Username </label>
                                                                            <input id="username" name="username" value="<?= $username ?>" type="text" class="form-control" placeholder="username" readonly>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama </label>
                                                                            <input id="nama" name="nama" type="text" value="<?= $nm ?>" class="form-control" placeholder="Nama" required>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Password </label>
                                                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Alamat </label>
                                                                            <input id="alamat" name="alamat" value="<?= $alamat ?>" type="text" class="form-control" placeholder="Alamat" required>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>No. Telp/HP </label>
                                                                            <input id="telp" name="telp" type="text" value="<?= $telp ?>" class="form-control" placeholder="No. Telp/HP" required>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Jenis Kelamin </label>
                                                                            <select name="jk" id="jk" class="form-control">
                                                                                <option value="<?= $gender ?>"><?= $gender ?></option>
                                                                                <option value="Perempuan">Perempuan</option>
                                                                                <option value="Lakir-Laki">Lakir-Laki</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Level </label>
                                                                            <select name="options" id="options" class="form-control">
                                                                                <option value="<?= $level ?>"><?= $level ?></option>
                                                                                <option value="Admin">Admin</option>
                                                                                <option value="Kasir">Kasir</option>
                                                                                <option value="Gudang">Gudang</option>
                                                                                <option value="Suplier">Suplier</option>
                                                                            </select>
                                                                        </div>
                                                                        <div id="option-Kasir" class="option form-group form-group-default">
                                                                            <label>Toko </label>
                                                                            <select name="toko" id="toko" class="form-control">
                                                                                <option>Pilih Toko</option>
                                                                                <?php foreach ($toko as $a) :  ?>
                                                                                    <option value="<?= $a->id_toko ?>"><?= $a->nama_toko ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div id="option-Suplier" class="option form-group form-group-default">
                                                                            <label>Suplier </label>
                                                                            <select name="supplier" class="form-control">
                                                                                <option>Pilih Suplier</option>
                                                                                <?php foreach ($supp as $a) :  ?>
                                                                                    <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="modalHapus<?= $username ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Nonaktifkan</span>
                                                                <span class="fw-light">
                                                                    User
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/user/nonaktifkan">
                                                            <div class="modal-body">
                                                                <p>Yakin mau menghapus data <?php echo $nm; ?>..?</p>
                                                                <input name="username" type="hidden" value="<?php echo $username; ?>">
                                                                <input name="nama" type="hidden" value="<?php echo $nm; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-warning" value="delete">Nonaktif</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <!-- End Modal -->
                                        <!-- =================================================================== -->
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Username</th>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                        <th>level</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Username</th>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                        <th>level</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($us->result_array() as $b) :
                                                        $no++;
                                                        $username = $b['username'];
                                                        $nm = $b['name'];
                                                        $status = $b['status'];
                                                        $level = $b['level'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];

                                                    ?>

                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $username ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?php if ($status != 1) {
                                                                    echo "NonAktif";
                                                                } else {
                                                                    echo "Aktif";
                                                                } ?></td>
                                                            <td><?= $level ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#updateuser<?= $username ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a href="#modalHapus<?= $username ?>" class="btn btn-link btn-danger" data-toggle="modal" data-original-title="Nonaktif Task">
                                                                        <i class="flaticon-lock"></i>
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
        <script>
            $(function() {
                $('#level').change(function() {
                    $('.levels').hide();
                    $('#' + $(this).val()).show();
                });
            });
        </script>
        <script>
            $('#options').on('change', function(e) {
                $('.option').hide();
                $('#option-' + e.target.value).show();
            });
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
                            <h4 class="page-title">DataUser</h4>
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
                                    <a href="<?= base_url(); ?>index.php/user">DataUser</a>
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
                                                <i class="flaticon-add-user"></i>
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
                                                                Data User
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $this->session->flashdata('msg'); ?>
                                                        <form method="post" action="<?= base_url(); ?>index.php/user/insert">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Username </label>
                                                                        <input id="username" name="username" type="text" class="form-control" placeholder="username" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama </label>
                                                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Password </label>
                                                                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Alamat </label>
                                                                        <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Alamat" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>No. Telp/HP </label>
                                                                        <input id="telp" name="telp" type="text" class="form-control" placeholder="No. Telp/HP" required>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Jenis Kelamin </label>
                                                                        <select name="jk" id="jk" class="form-control">
                                                                            <option>---Pilih Jenis Kelamnin---</option>
                                                                            <option value="Perempuan">Perempuan</option>
                                                                            <option value="Lakir-Laki">Lakir-Laki</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Level </label>
                                                                        <select name="level" id="level" class="form-control">
                                                                            <option>---Pilih Level---</option>
                                                                            <option value="Admin">Admin</option>
                                                                            <option value="Kasir">Kasir</option>
                                                                            <option value="Gudang">Gudang</option>
                                                                            <option value="Suplier">Suplier</option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="Kasir" class="levels form-group form-group-default">
                                                                        <label>Toko </label>
                                                                        <select name="toko" id="toko" class="form-control">
                                                                            <option value=>---Pilih Toko---</option>
                                                                            <?php foreach ($toko as $a) :  ?>
                                                                                <option value="<?= $a->id_toko ?>"><?= $a->nama_toko ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="Suplier" class="levels form-group form-group-default">
                                                                        <label>Suplier </label>
                                                                        <select name="supplier" class="form-control">
                                                                            <option value=>---Pilih Suplier---</option>
                                                                            <?php foreach ($supp as $a) :  ?>
                                                                                <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <?php $no = 0;
                                        foreach ($us->result_array() as $b) {
                                            $no++;
                                            $username = $b['username'];
                                            $nm = $b['name'];
                                            $status = $b['status'];
                                            $level = $b['level'];
                                            $telp = $b['no_telp'];
                                            $alamat = $b['alamat'];
                                            $gender = $b['gender'];
                                        ?>
                                            <div class="modal fade" id="updateuser<?= $username ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Update</span>
                                                                <span class="fw-light">
                                                                    Data User
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                            <form method="post" action="<?= base_url(); ?>index.php/user/updateowner">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Username </label>
                                                                            <input id="username" name="username" value="<?= $username ?>" type="text" class="form-control" placeholder="username" readonly>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama </label>
                                                                            <input id="nama" name="nama" type="text" value="<?= $nm ?>" class="form-control" placeholder="Nama" required>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Password </label>
                                                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Alamat </label>
                                                                            <input id="alamat" name="alamat" value="<?= $alamat ?>" type="text" class="form-control" placeholder="Alamat" required>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>No. Telp/HP </label>
                                                                            <input id="telp" name="telp" type="text" value="<?= $telp ?>" class="form-control" placeholder="No. Telp/HP" required>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Jenis Kelamin </label>
                                                                            <select name="jk" id="jk" class="form-control">
                                                                                <option value="<?= $gender ?>"><?= $gender ?></option>
                                                                                <option value="Perempuan">Perempuan</option>
                                                                                <option value="Lakir-Laki">Lakir-Laki</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group form-group-default">
                                                                            <label>Level </label>
                                                                            <select name="options" id="options" class="form-control">
                                                                                <option value="<?= $level ?>"><?= $level ?></option>
                                                                                <option value="Admin">Admin</option>
                                                                                <option value="Kasir">Kasir</option>
                                                                                <option value="Gudang">Gudang</option>
                                                                                <option value="Suplier">Suplier</option>
                                                                            </select>
                                                                        </div>
                                                                        <div id="option-Kasir" class="option form-group form-group-default">
                                                                            <label>Toko </label>
                                                                            <select name="toko" id="toko" class="form-control">
                                                                                <option>Pilih Toko</option>
                                                                                <?php foreach ($toko as $a) :  ?>
                                                                                    <option value="<?= $a->id_toko ?>"><?= $a->nama_toko ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div id="option-Suplier" class="option form-group form-group-default">
                                                                            <label>Suplier </label>
                                                                            <select name="supplier" class="form-control">
                                                                                <option>Pilih Suplier</option>
                                                                                <?php foreach ($supp as $a) :  ?>
                                                                                    <option value="<?= $a->id_suplier ?>"><?= $a->nama_suplier ?>-<?= $a->alamat_suplier ?>-<?= $a->no_telp ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="modalHapus<?= $username ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                    Nonaktifkan</span>
                                                                <span class="fw-light">
                                                                    User
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/user/ownernonaktif">
                                                            <div class="modal-body">
                                                                <p>Yakin mau menghapus data <?php echo $nm; ?>..?</p>
                                                                <input name="username" type="hidden" value="<?php echo $username; ?>">
                                                                <input name="nama" type="hidden" value="<?php echo $nm; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-warning" value="delete">Nonaktif</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <!-- End Modal -->
                                        <!-- =================================================================== -->
                                        <div class="table-responsive">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Username</th>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                        <th>level</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Username</th>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                        <th>level</th>
                                                        <th>Create</th>
                                                        <th>Update</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($us->result_array() as $b) :
                                                        $no++;
                                                        $username = $b['username'];
                                                        $nm = $b['name'];
                                                        $status = $b['status'];
                                                        $level = $b['level'];
                                                        $create = $b['created_at'];
                                                        $update = $b['updated_at'];
                                                    ?>

                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $username ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?php if ($status != 1) {
                                                                    echo "NonAktif";
                                                                } else {
                                                                    echo "Aktif";
                                                                } ?></td>
                                                            <td><?= $level ?></td>
                                                            <td><?= $create ?></td>
                                                            <td><?= $update ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="#updateuser<?= $username ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a href="#modalHapus<?= $username ?>" class="btn btn-link btn-danger" data-toggle="modal" data-original-title="Nonaktif Task">
                                                                        <i class="flaticon-lock"></i>
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
        <script>
            $(function() {
                $('#level').change(function() {
                    $('.levels').hide();
                    $('#' + $(this).val()).show();
                });
            });
        </script>
        <script>
            $('#options').on('change', function(e) {
                $('.option').hide();
                $('#option-' + e.target.value).show();
            });
        </script>
    </body>

    </html>

<?php } ?>