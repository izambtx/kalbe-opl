<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light rounded-bottom-lg text-white topbar rounded-bottom mb-5 ml-5 mr-5 static-top shadow" style="background-color: #33353b;">

    <h3 class="font-weight-bold pt-2 ml-3">
        One Point Lesson | <span class="h6 font-weight-normal">Edit My Profile</span>
    </h3>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow">
            <!-- <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
            <lord-icon src="https://cdn.lordicon.com/ccwgfhfg.json" trigger="hover" colors="outline:#ffffff,primary:#92140c,secondary:#4bb3fd,tertiary:#e4e4e4" style="width:25px;height:25px">
            </lord-icon> -->
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                <lord-icon src="https://cdn.lordicon.com/msetysan.json" trigger="hover" colors="primary:#ffffff" style="width:25px;height:25px">
                </lord-icon>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header bg-success border-success">
                    Notifications
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-info">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2019</div>
                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="">Show All Alerts</a>
            </div>
        </li>
    </ul>

</nav>


<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-800 font-weight-bold">Update Profile</h1>
    <br>

    <div class="row">
        <div class="col">
            <?= view('Myth\Auth\Views\_message_block') ?>
            <img class="rounded mx-auto d-block w-50" src="<?= base_url('/img/' . user()->user_image); ?>" alt="<?= user()->username ?>">
        </div>
        <div class="col" id="cardMP">

            <form class="user" action="" method="post">
                <?= csrf_field() ?>

                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="exampleInputNIK1" class="font-weight-bold text-gray-900">NIK</label>
                    <input type="text" disabled class="form-control form-control-user <?php if (session('errors.NIK')) : ?>is-invalid<?php endif ?>" name="NIK" value="<?= user()->NIK ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1" class="font-weight-bold text-gray-900">Username</label>
                    <input type="text" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" value="<?= user()->username ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold text-gray-900">Email address</label>
                    <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="exampleInputEmail" name="email" value="<?= user()->email; ?>">
                </div>
                <a class="btn btn-primary font-weight-bold btn btn-success btn-user" href="<?= base_url() ?>" role="button" id="TomEdL">
                    <i class="fas fa-reply-all"></i>&nbsp;&nbsp;Go Back
                </a>
                <button type="reset" value="Reset" class="font-weight-bold btn btn-secondary btn-user" id="TomEdC">
                    <i class="fas fa-undo-alt"></i>&nbsp;&nbsp;Reset
                </button>
                <button type="submit" class="font-weight-bold btn btn-warning btn-user" id="TomEdR" disabled>
                    <i class="far fa-save"></i>&nbsp;&nbsp;Confirm
                </button>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>