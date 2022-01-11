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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title">Tambah Data Coa</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/coa/insert" method="POST">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Pilih Akun</label>
                                                <select name="kode" id="kode" onchange="akun()" class="kode form-control" id="exampleFormControlSelect1">
                                                    <option value="">&nbsp;</option>
                                                    <?php foreach ($c as $row) : ?>
                                                        <option value="<?= $row->kode_akun ?>"><?= $row->kode_akun ?> | <?= $row->nama_akun ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Sub Kode Akun</label>
                                                <select name="subkodeakun" id="subkodeakun" class="subkodeakun form-control" id="exampleFormControlSelect1">
                                                    <option value="0">&nbsp;</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Input Nama Akun</label>
                                                <input name="namaakun" id="namaakun" type="text" class="form-control form-control" id="defaultInput" placeholder="Nama Akun" required>
                                                <input name="iskodeakun" id="iskodeakun" type="hidden" class="form-control form-control" id="defaultInput" placeholder="Nama Akun">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success">Submit</button>
                                                <button class="btn btn-danger">Cancel</button>
                                            </div>
                                        </form>
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
        <script src="<?= base_url(); ?>/assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            function akun() {
                var tes = document.getElementById("kode").value;
                document.getElementById("iskodeakun").value = tes;
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#kode').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/coa/getsubakun",
                        method: "POST",
                        data: {
                            kode: id
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {

                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_akun + '>' + data[i].kode_akun + ' | ' + data[i].nama_akun + '</option>';
                            }
                            $('#subkodeakun').html(html);

                        }
                    });
                    return false;
                });

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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title">Tambah Data Coa</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url(); ?>index.php/coa/insert" method="POST">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Pilih Akun</label>
                                                <select name="kode" id="kode" onchange="akun()" class="kode form-control" id="exampleFormControlSelect1">
                                                    <option value="">&nbsp;</option>
                                                    <?php foreach ($c as $row) : ?>
                                                        <option value="<?= $row->kode_akun ?>"><?= $row->kode_akun ?> | <?= $row->nama_akun ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Sub Kode Akun</label>
                                                <select name="subkodeakun" id="subkodeakun" class="subkodeakun form-control" id="exampleFormControlSelect1">
                                                    <option value="0">&nbsp;</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Input Nama Akun</label>
                                                <input name="namaakun" id="namaakun" type="text" class="form-control form-control" id="defaultInput" placeholder="Nama Akun" required>
                                                <input name="iskodeakun" id="iskodeakun" type="hidden" class="form-control form-control" id="defaultInput" placeholder="Nama Akun">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success">Submit</button>
                                                <button class="btn btn-danger">Cancel</button>
                                            </div>
                                        </form>
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
        <script src="<?= base_url(); ?>/assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            function akun() {
                var tes = document.getElementById("kode").value;
                document.getElementById("iskodeakun").value = tes;
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#kode').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/coa/getsubakun",
                        method: "POST",
                        data: {
                            kode: id
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {

                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_akun + '>' + data[i].kode_akun + ' | ' + data[i].nama_akun + '</option>';
                            }
                            $('#subkodeakun').html(html);

                        }
                    });
                    return false;
                });

            });
        </script>
    </body>

    </html>

<?php } ?>