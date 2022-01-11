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

        <!-- End Sidebar -->
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <h4 class="page-title">User Profile</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-with-nav">
                                <div class="card-header">
                                    <div class="row row-nav-line">
                                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profile</a> </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?=
                                                                                                                                $this->session->userdata('nama');
                                                                                                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Username</label>
                                                <input type="username" class="form-control" name="username" placeholder="username" value="<?=
                                                                                                                                            $this->session->userdata('username');
                                                                                                                                            ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group form-group-default">
                                                <label>Gender</label>
                                                <select class="form-control" id="gender">
                                                    <option><?=
                                                            $this->session->userdata('jk');
                                                            ?></option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-group-default">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" value="<?=
                                                                                                $this->session->userdata('telpon');
                                                                                                ?>" name="phone" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-group-default">
                                                <label>Level</label>
                                                <input type="text" class="form-control" value="<?=
                                                                                                $this->session->userdata('lvl');
                                                                                                ?>" name="phone" placeholder="Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default">
                                                <label>Address</label>
                                                <input type="text" class="form-control" value="<?=
                                                                                                $this->session->userdata('almt');
                                                                                                ?>" name="address" placeholder="Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-profile card-secondary">
                                <div class="card-header" style="background-image: url('<?= base_url(); ?>/assets/img/examples/product2.jpg')">
                                    <div class="profile-picture">
                                        <div class="avatar avatar-xl">
                                            <img src="<?= base_url(); ?>/assets/img/examples/product1.jpg" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="user-profile text-center">
                                        <div class="name"><?=
                                                            $this->session->userdata('nama');
                                                            ?></div>
                                        <div class="job"><?=
                                                            $this->session->userdata('lvl');
                                                            ?></div>
                                        <div class="desc"><?=
                                                            $this->session->userdata('jk');
                                                            ?></div>
                                        <div class="social-media">
                                            <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                                                <span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
                                            </a>
                                            <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                                <span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span>
                                            </a>
                                            <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
                                                <span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
                                            </a>
                                            <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                                <span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span>
                                            </a>
                                        </div>
                                        <div class="view-profile">
                                            <a href="#" class="btn btn-secondary btn-block"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row user-stats text-center">
                                        <div class="col">
                                            <div class="number">125</div>
                                            <div class="title">Post</div>
                                        </div>
                                        <div class="col">
                                            <div class="number">25K</div>
                                            <div class="title">Followers</div>
                                        </div>
                                        <div class="col">
                                            <div class="number">134</div>
                                            <div class="title">Following</div>
                                        </div>
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