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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <h1>Masukkan Kode OTP</h1>
                                        <?php if ($this->session->flashdata('gagal')) { ?>
                                            <div class="alert alert-danger" role="alert"><span style="color: red;"><?php echo $this->session->flashdata('gagal'); ?></span></div>
                                        <?php } ?>

                                        <?php if ($this->session->flashdata('sukses')) { ?>
                                            <div class="alert alert-success" role="alert"><span style="color: green;"><?= $this->session->flashdata('sukses'); ?></span></div>
                                        <?php } ?>
                                        <form action="<?php echo base_url(); ?>index.php/user/updatedata" method="post">
                                            <div class="form-group">
                                                <input type="text" name="kodeotp" placeholder="Masukkan kode OTP" required><br>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info" name="validasi">Verifikasi</button>
                                            </div>
                                            <div class="form-group">
                                                <p>
                                                    batas waktu <span id="waktu"></span><br>
                                                    Tidak menerima sms kode otp? <a href="<?= base_url('index.php/user/kirimulang') ?>">kirim ulang</a><br>
                                                    <a href="<?= base_url(); ?>index.php/user">Kembali</a>
                                                </p>
                                            </div>
                                        </form>
                                        <!--menghitung mundur waktu selama 10 menit, ganti value minutesToAdd utuk mengubah waktu-->
                                        <script>
                                            var minutesToAdd = 10;
                                            var currentDate = new Date();
                                            var countDownDate = new Date(currentDate.getTime() + minutesToAdd * 60000);

                                            var x = setInterval(function() {

                                                var now = new Date().getTime();

                                                var distance = countDownDate - now;

                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                document.getElementById("waktu").innerHTML = minutes + ":" + seconds;

                                                if (distance < 0) {
                                                    clearInterval(x);
                                                    document.getElementById("waktu").innerHTML = "00:00";
                                                }
                                            }, 1000);
                                        </script>
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