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
                            <h4 class="page-title">DataReturGudang</h4>
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
                                    <a href="<?= base_url(); ?>index.php/dataretur">DataReturGudang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/dataretur/laporanreturtgl" target="_blank" method="POST">
                                            <div class="form-group">
                                                <label>Dari Tanggal:</label>
                                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                    <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                                                    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sampai:</label>
                                                <div class="input-group date" id="reservationdatetimee" data-target-input="nearest">
                                                    <input type="text" name="sampai" class="form-control datetimepicker-input" data-target="#reservationdatetimee" />
                                                    <div class="input-group-append" data-target="#reservationdatetimee" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/dataretur/cetaknomorretur" method="POST">
                                            <div class="form-group">
                                                <label>Nomor Retur</label>
                                                <select class="form-control" name="noretur" id="noretur" placeholder="Nomor Retur" required>
                                                    <option>&nbsp;</option>
                                                    <?php foreach ($nort as $a) :  ?>
                                                        <option value="<?= $a->no_retur ?>"><?= $a->no_retur ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Model Edit -->
                                        <?php
                                        foreach ($rtg->result_array() as $b) :
                                            $id = $b['no_retur'];
                                            $nm = $b['nama_barang'];
                                            $kode = $b['kode_barang'];
                                            $jml = $b['jumlah'];
                                            $harga = $b['hargapokok'];
                                            $tglretur = $b['tanggal_retur'];
                                        ?>
                                            <div class="modal fade bd-example-modal-lg" id="ModalEdit<?= $id ?><?= $kode ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="<?= base_url(); ?>index.php/dataretur/update" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="returno">Nomor Retur</label>
                                                                    <input type="text" class="form-control" id="returno" name="returno" value="<?= $id ?>" placeholder="Nomor Retur" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama">Nama Barang</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nm ?>" placeholder="Nama Barang" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kode">Kode Barang</label>
                                                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $kode ?>" placeholder="Kode Barang" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jumlah">Jumlah</label>
                                                                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $jml ?>" placeholder="Jumlah" required>
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
                                        <?php endforeach; ?>
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No. Retur</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Tanggal Retur</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($rtg->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['no_retur'];
                                                        $nm = $b['nama_barang'];
                                                        $kode = $b['kode_barang'];
                                                        $jml = $b['jumlah'];
                                                        $harga = $b['hargapokok'];
                                                        $tglretur = $b['tanggal_retur'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $id ?></td>
                                                            <td><?= $kode ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $jml ?></td>
                                                            <td>Rp. <?= number_format("$harga", 2, ",", ".") ?></td>
                                                            <td><?= $tglretur ?></td>
                                                            <!-- <td>
                                                                <a href="#ModalEdit<?= $id ?><?= $kode ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </td> -->
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
        <!-- Select2 -->
        <script src="<?= base_url(); ?>/assets/select2/js/select2.full.min.js"></script>

        <!-- InputMask -->
        <script src="<?= base_url(); ?>/assets/moment/moment.min.js"></script>
        <script src="<?= base_url(); ?>/assets/inputmask/jquery.inputmask.min.js"></script>
        <!-- date-range-picker -->
        <script src="<?= base_url(); ?>/assets/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="<?= base_url(); ?>/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?= base_url(); ?>/assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Page specific script -->
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
                })
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {
                    'placeholder': 'mm/dd/yyyy'
                })
                //Money Euro
                $('[data-mask]').inputmask()

                //Date picker
                $('#reservationdate').datetimepicker({
                    format: 'YYYY/MM/DD'
                });
                //Date picker
                $('#reservationdatee').datetimepicker({
                    format: 'YYYY/MM/DD'
                });

                //Date and time picker
                $('#reservationdatetime').datetimepicker({
                    format: 'YYYY/MM/DD hh:mm A',
                    icons: {
                        time: 'flaticon-time',
                    }

                });

                $('#reservationdatetimee').datetimepicker({
                    icons: {
                        time: 'flaticon-time'
                    },
                    format: 'YYYY/MM/DD hh:mm A'
                });
                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
                })


                //Timepicker
                $('#timepicker').datetimepicker({
                    format: 'LT'
                })

                //Bootstrap Duallistbox
                $('.duallistbox').bootstrapDualListbox()

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                //color picker with addon
                $('.my-colorpicker2').colorpicker()

                $('.my-colorpicker2').on('colorpickerChange', function(event) {
                    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                })

                $("input[data-bootstrap-switch]").each(function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                })

            })
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
                            <h4 class="page-title">DataReturGudang</h4>
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
                                    <a href="<?= base_url(); ?>index.php/dataretur">DataReturGudang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/dataretur/laporanreturtgl" target="_blank" method="POST">
                                            <div class="form-group">
                                                <label>Dari Tanggal:</label>
                                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                    <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                                                    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sampai:</label>
                                                <div class="input-group date" id="reservationdatetimee" data-target-input="nearest">
                                                    <input type="text" name="sampai" class="form-control datetimepicker-input" data-target="#reservationdatetimee" />
                                                    <div class="input-group-append" data-target="#reservationdatetimee" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/dataretur/cetaknomorretur" method="POST">
                                            <div class="form-group">
                                                <label>Nomor Retur</label>
                                                <select class="form-control" name="noretur" id="noretur" placeholder="Nomor Retur" required>
                                                    <option>&nbsp;</option>
                                                    <?php foreach ($nort as $a) :  ?>
                                                        <option value="<?= $a->no_retur ?>"><?= $a->no_retur ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Model Edit -->
                                        <?php
                                        foreach ($rtg->result_array() as $b) :
                                            $id = $b['no_retur'];
                                            $nm = $b['nama_barang'];
                                            $kode = $b['kode_barang'];
                                            $jml = $b['jumlah'];
                                            $harga = $b['hargapokok'];
                                            $tglretur = $b['tanggal_retur'];
                                        ?>
                                            <div class="modal fade bd-example-modal-lg" id="ModalEdit<?= $id ?><?= $kode ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="<?= base_url(); ?>index.php/dataretur/update" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="returno">Nomor Retur</label>
                                                                    <input type="text" class="form-control" id="returno" name="returno" value="<?= $id ?>" placeholder="Nomor Retur" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama">Nama Barang</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nm ?>" placeholder="Nama Barang" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kode">Kode Barang</label>
                                                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $kode ?>" placeholder="Kode Barang" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jumlah">Jumlah</label>
                                                                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $jml ?>" placeholder="Jumlah" required>
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
                                        <?php endforeach; ?>
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No. Retur</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Tanggal Retur</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($rtg->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['no_retur'];
                                                        $nm = $b['nama_barang'];
                                                        $kode = $b['kode_barang'];
                                                        $jml = $b['jumlah'];
                                                        $harga = $b['hargapokok'];
                                                        $tglretur = $b['tanggal_retur'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $id ?></td>
                                                            <td><?= $kode ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $jml ?></td>
                                                            <td>Rp. <?= number_format("$harga", 2, ",", ".") ?></td>
                                                            <td><?= $tglretur ?></td>
                                                            <!-- <td>
                                                                <a href="#ModalEdit<?= $id ?><?= $kode ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </td> -->
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
        <!-- Select2 -->
        <script src="<?= base_url(); ?>/assets/select2/js/select2.full.min.js"></script>

        <!-- InputMask -->
        <script src="<?= base_url(); ?>/assets/moment/moment.min.js"></script>
        <script src="<?= base_url(); ?>/assets/inputmask/jquery.inputmask.min.js"></script>
        <!-- date-range-picker -->
        <script src="<?= base_url(); ?>/assets/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="<?= base_url(); ?>/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?= base_url(); ?>/assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Page specific script -->
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
                })
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {
                    'placeholder': 'mm/dd/yyyy'
                })
                //Money Euro
                $('[data-mask]').inputmask()

                //Date picker
                $('#reservationdate').datetimepicker({
                    format: 'YYYY/MM/DD'
                });
                //Date picker
                $('#reservationdatee').datetimepicker({
                    format: 'YYYY/MM/DD'
                });

                //Date and time picker
                $('#reservationdatetime').datetimepicker({
                    format: 'YYYY/MM/DD hh:mm A',
                    icons: {
                        time: 'flaticon-time',
                    }

                });

                $('#reservationdatetimee').datetimepicker({
                    icons: {
                        time: 'flaticon-time'
                    },
                    format: 'YYYY/MM/DD hh:mm A'
                });
                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
                })


                //Timepicker
                $('#timepicker').datetimepicker({
                    format: 'LT'
                })

                //Bootstrap Duallistbox
                $('.duallistbox').bootstrapDualListbox()

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                //color picker with addon
                $('.my-colorpicker2').colorpicker()

                $('.my-colorpicker2').on('colorpickerChange', function(event) {
                    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                })

                $("input[data-bootstrap-switch]").each(function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                })

            })
        </script>

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
                            <h4 class="page-title">DataReturGudang</h4>
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
                                    <a href="<?= base_url(); ?>index.php/dataretur">DataReturGudang</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/dataretur/laporanreturtgl" target="_blank" method="POST">
                                            <div class="form-group">
                                                <label>Dari Tanggal:</label>
                                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                    <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                                                    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sampai:</label>
                                                <div class="input-group date" id="reservationdatetimee" data-target-input="nearest">
                                                    <input type="text" name="sampai" class="form-control datetimepicker-input" data-target="#reservationdatetimee" />
                                                    <div class="input-group-append" data-target="#reservationdatetimee" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/dataretur/cetaknomorretur" method="POST">
                                            <div class="form-group">
                                                <label>Nomor Retur</label>
                                                <select class="form-control" name="noretur" id="noretur" placeholder="Nomor Retur" required>
                                                    <option>&nbsp;</option>
                                                    <?php foreach ($nort as $a) :  ?>
                                                        <option value="<?= $a->no_retur ?>"><?= $a->no_retur ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Model Edit -->
                                        <?php
                                        foreach ($rtg->result_array() as $b) :
                                            $id = $b['no_retur'];
                                            $nm = $b['nama_barang'];
                                            $kode = $b['kode_barang'];
                                            $jml = $b['jumlah'];
                                            $harga = $b['hargapokok'];
                                            $tglretur = $b['tanggal_retur'];
                                        ?>
                                            <div class="modal fade bd-example-modal-lg" id="ModalEdit<?= $id ?><?= $kode ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="<?= base_url(); ?>index.php/dataretur/update" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="returno">Nomor Retur</label>
                                                                    <input type="text" class="form-control" id="returno" name="returno" value="<?= $id ?>" placeholder="Nomor Retur" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama">Nama Barang</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nm ?>" placeholder="Nama Barang" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kode">Kode Barang</label>
                                                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $kode ?>" placeholder="Kode Barang" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jumlah">Jumlah</label>
                                                                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $jml ?>" placeholder="Jumlah" required>
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
                                        <?php endforeach; ?>
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No. Retur</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Tanggal Retur</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    foreach ($rtg->result_array() as $b) :
                                                        $no++;
                                                        $id = $b['no_retur'];
                                                        $nm = $b['nama_barang'];
                                                        $kode = $b['kode_barang'];
                                                        $jml = $b['jumlah'];
                                                        $harga = $b['hargapokok'];
                                                        $tglretur = $b['tanggal_retur'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $id ?></td>
                                                            <td><?= $kode ?></td>
                                                            <td><?= $nm ?></td>
                                                            <td><?= $jml ?></td>
                                                            <td>Rp. <?= number_format("$harga", 2, ",", ".") ?></td>
                                                            <td><?= $tglretur ?></td>
                                                            <!-- <td>
                                                                <a href="#ModalEdit<?= $id ?><?= $kode ?>" class="btn btn-link btn-primary" data-toggle="modal" data-original-title="Edit Task">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </td> -->
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
        <!-- Select2 -->
        <script src="<?= base_url(); ?>/assets/select2/js/select2.full.min.js"></script>

        <!-- InputMask -->
        <script src="<?= base_url(); ?>/assets/moment/moment.min.js"></script>
        <script src="<?= base_url(); ?>/assets/inputmask/jquery.inputmask.min.js"></script>
        <!-- date-range-picker -->
        <script src="<?= base_url(); ?>/assets/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="<?= base_url(); ?>/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?= base_url(); ?>/assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Page specific script -->
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
                })
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {
                    'placeholder': 'mm/dd/yyyy'
                })
                //Money Euro
                $('[data-mask]').inputmask()

                //Date picker
                $('#reservationdate').datetimepicker({
                    format: 'YYYY/MM/DD'
                });
                //Date picker
                $('#reservationdatee').datetimepicker({
                    format: 'YYYY/MM/DD'
                });

                //Date and time picker
                $('#reservationdatetime').datetimepicker({
                    format: 'YYYY/MM/DD hh:mm A',
                    icons: {
                        time: 'flaticon-time',
                    }

                });

                $('#reservationdatetimee').datetimepicker({
                    icons: {
                        time: 'flaticon-time'
                    },
                    format: 'YYYY/MM/DD hh:mm A'
                });
                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
                })


                //Timepicker
                $('#timepicker').datetimepicker({
                    format: 'LT'
                })

                //Bootstrap Duallistbox
                $('.duallistbox').bootstrapDualListbox()

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                //color picker with addon
                $('.my-colorpicker2').colorpicker()

                $('.my-colorpicker2').on('colorpickerChange', function(event) {
                    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                })

                $("input[data-bootstrap-switch]").each(function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                })

            })
        </script>

    </body>

    </html>

<?php } ?>