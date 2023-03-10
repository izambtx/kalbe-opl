<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>One Point Lesson</title>

    <link rel="icon" type="img/x-icon" href="/img/favicon.ico">
    <!-- Custom fonts for this template-->
    <link href="<?php base_url(); ?>/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <link href="<?php base_url(); ?>/css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark position-fixed accordion shadow" style="background-color: #393b42; z-index: 1;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>/">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <img class="img-profile rounded-circle mx-auto d-block w-25" src="<?php base_url(); ?>/img/<?= user()->user_image; ?>">
            <!-- <a class="nav-link text-center text-white" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <h6 class="mr-2 d-none d-lg-inline text-white font-weight-bold"><?= user()->fullname; ?></h6>
                <i class="fas fa-cog"></i>
            </a> -->
            <a class="nav-link text-center text-white" href="<?= base_url('/view_profile'); ?>" role="button">
                <h6 class="mr-2 d-none d-lg-inline text-white font-weight-bold"><?= user()->fullname; ?></h6>
                <i class="fas fa-cog"></i>
            </a>

            <div class="collapse" id="collapseExample">

                <span class="badge badge-light mx-5 mb-3 d-flex justify-content-center bg-success font-weight-bold"><?= user()->NIK; ?></span>
                <li class="nav-item ml-3 mr-3 rounded-top" style="background-color: #474952;">
                    <a class="nav-link ml-1" href="<?= base_url('/view_profile'); ?>">
                        <i class="fas fa-user mr-2"></i>
                        <span>&nbsp;&nbsp;My Profile</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider ml-3 mr-3 mb-0 border-secondary">

                <?php if (in_groups('admin')) : ?>
                    <li class="nav-item ml-3 mr-3" style="background-color: #474952;">
                        <a class="nav-link ml-1" href="<?= base_url('/change-my-profile'); ?>">
                            <i class="fas fa-user-edit mr-2"></i>
                            <span> Edit Profile</span></a>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider ml-3 mr-3 mb-0 border-secondary">

                    <li class="nav-item ml-3 mr-3" style="background-color: #474952;">
                        <a class="nav-link ml-1" href="<?= base_url('admin'); ?>">
                            <i class="fas fa-users-cog mr-2"></i>
                            <span>User Management</span></a>
                        </a>
                    </li>
                <?php else : ?>
                    <!-- <li class="nav-item ml-3 mr-3" style="background-color: #474952;">
                        <a class="nav-link ml-1" href="<?= base_url('/update-my-profile'); ?>">
                            <i class="fas fa-user-edit mr-2"></i>
                            <span>Edit Profile</span></a>
                        </a>
                    </li> -->
                <?php endif; ?>
                <!-- Divider -->
                <hr class="sidebar-divider ml-3 mr-3 mb-0 border-secondary">
                <li class="nav-item ml-3 mr-3 rounded-bottom" style="background-color: #474952;">
                    <a class="nav-link ml-1" href="<?= base_url('/change-password'); ?>">
                        <i class="fas fa-user-lock mr-2"></i>
                        <span>Change Password</span></a>
                    </a>
                </li>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <?php if (in_groups('admin') || in_groups('supervisor') || in_groups('engineer')) : ?>

                <!-- Nav Item - Approve OPL Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-file-signature"></i>
                        <span>One Point Lesson</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-dark py-2 collapse-inner rounded">
                            <h6 class="collapse-header text-gray-200">Kategori :</h6>
                            <a class="collapse-item text-gray-400" href="<?= base_url('PengetahuanDasar/' . user()->id); ?>">Pengetahuan Dasar</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('Improvement/' . user()->id); ?>">Improvement</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('TroubleShooting/' . user()->id); ?>">Trouble Shooting</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if (in_groups('admin') || in_groups('user')) : ?>
                <!-- Nav Item - Add OPL Menu -->
                <li class="nav-item rounded-lg">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-file-medical"></i>
                        <span>One Point Lesson</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-dark py-2 collapse-inner rounded">
                            <h6 class="collapse-header text-gray-200">Kategori :</h6>
                            <a class="collapse-item text-gray-400" href="<?= base_url('ListPengetahuanDasar/' . user()->id); ?>">Pengetahuan Dasar</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('ListImprovement/' . user()->id); ?>">Improvement</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('ListTroubleShooting/' . user()->id); ?>">Trouble Shooting</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if (in_groups('supervisor') || in_groups('engineer')) : ?>
                <!-- Nav Item - Approve OPL Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-history"></i>
                        <span>History OPL</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-dark py-2 collapse-inner rounded">
                            <h6 class="collapse-header text-gray-200">Kategori :</h6>
                            <a class="collapse-item text-gray-400" href="<?= base_url('/PengetahuanDasar/History/' . user()->id); ?>">Pengetahuan Dasar</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('/Improvement/History/' . user()->id); ?>">Improvement</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('/TroubleShooting/History/' . user()->id); ?>">Trouble Shooting</a>
                        </div>
                    </div>
                </li>
            <?php elseif (in_groups('user')) : ?>

                <!-- Nav Item - Rewrite OPL Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <i class="fas fa-history"></i>
                        <span>Status OPL</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-dark py-2 collapse-inner rounded">
                            <h6 class="collapse-header text-gray-200">Kategori :</h6>
                            <a class="collapse-item text-gray-400" href="<?= base_url('/ListPengetahuanDasar/Status/' . user()->id); ?>">Pengetahuan Dasar</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('/ListImprovement/Status/' . user()->id); ?>">Improvement</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('/ListTroubleShooting/Status/' . user()->id); ?>">Trouble Shooting</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Realisasi OPL Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-file-upload"></i>
                        <span>Sosialisasi OPL
                            <!-- <span class="badge badge-danger badge-counter"><?= $countRIM + $countRPD + $countRTS; ?></span> -->
                        </span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-dark py-2 collapse-inner rounded">
                            <h6 class="collapse-header text-gray-200">Kategori :</h6>
                            <a class="collapse-item text-gray-400" href="<?= base_url('List-Sosialisasi-PengetahuanDasar/'); ?>">Pengetahuan Dasar</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('List-Sosialisasi-Improvement/'); ?>">Improvement</a>
                            <a class="collapse-item text-gray-400" href="<?= base_url('List-Sosialisasi-TroubleShooting/'); ?>">Trouble Shooting</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                Support
            </div>

            <?php if (in_groups('admin') || in_groups('user')) : ?>
                <!-- Nav Item - How To Write OPL -->
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="">
                        <i class="fas fa-video"></i>
                        <span>How To Write OPL</span></a>
                </li>
            <?php endif; ?>

            <?php if (in_groups('admin') || in_groups('supervisor') || in_groups('engineer')) : ?>

                <!-- Nav Item - How To Approve OPL -->
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="">
                        <i class="fas fa-video"></i>
                        <span>How To Approve OPL</span></a>
                </li>

            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - LOGOUT -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal" style="background-color: #9c2727;">
                    <i class="fas fa-door-open"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline mt-4">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light rounded-bottom-lg text-white topbar rounded-bottom mb-5 mx-5 static-top shadow bg-gradient-lime">

                <h3 class="font-weight-bold pt-2 ml-3">
                    <!-- <i class="far fa-address-book mx-2 rotate-n-15"></i> -->
                    One Point Lesson | <span class="h6 font-weight-normal"><?= $title; ?></span>
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
                            <?php if (!empty($countRIM + $countRPD + $countRTS)) : ?>
                                <span class="badge badge-danger badge-counter"><?= $countRIM + $countRPD + $countRTS; ?></span>
                            <?php endif; ?>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header bg-success border-success">
                                Notifications
                            </h6>
                            <?php if (!empty($countRIM + $countRPD + $countRTS)) : ?>
                                <?php if (in_groups('user')) : ?>
                                    <?php if ($countRPD > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/ListPengetahuanDasar/Status/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRPD; ?> new returned OPL <span class="font-weight-bold text-success">Pengetahuan Dasar</span> is waiting your update!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($countRIM > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/ListImprovement/Status/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRIM; ?> new returned OPL <span class="font-weight-bold text-success">Improvement</span> is waiting your update!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($countRTS > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/ListTroubleShooting/Status/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRTS; ?> new returned OPL <span class="font-weight-bold text-success">Trouble Shooting</span> is waiting your update!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php elseif (in_groups('supervisor')) : ?>
                                    <?php if ($countRPD > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/PengetahuanDasar/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRPD; ?> new report OPL <span class="font-weight-bold text-success">Pengetahuan Dasar</span> is waiting your approve!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($countRIM > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/Improvement/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRIM; ?> new report OPL <span class="font-weight-bold text-success">Improvement</span> is waiting your approve!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($countRTS > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/TroubleShooting/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRTS; ?> new report OPL <span class="font-weight-bold text-success">Trouble Shooting</span> is waiting your approve!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php elseif (in_groups('engineer')) : ?>
                                    <?php if ($countRPD > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/PengetahuanDasar/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRPD; ?> new report OPL <span class="font-weight-bold text-success">Pengetahuan Dasar</span> is waiting your approve!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($countRIM > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/Improvement/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRIM; ?> new report OPL <span class="font-weight-bold text-success">Improvement</span> is waiting your approve!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($countRTS > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/TroubleShooting/<?= user_id(); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $countRTS; ?> new report OPL <span class="font-weight-bold text-success">Trouble Shooting</span> is waiting your approve!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <p class="mt-3 text-center small text-gray-500">Check out the updated OPL above</p>
                            <?php else : ?>
                                <p class="mt-3 text-center small text-gray-900 font-weight-bold">There is no OPL to updated yet</p>
                            <?php endif; ?>
                        </div>
                    </li>

                    <?php if (in_groups('user')) : ?>
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/uvlzcswc.json" trigger="boomerang" colors="primary:#ffffff" style="width:25px;height:25px">
                                </lord-icon>
                                <?php
                                $jumlahCTSPD = $countTSPD - $countSPD;
                                $jumlahCTSIM = $countTSIM - $countSIM;
                                $jumlahCTSTS = $countTSTS - $countSTS;
                                $totalJumlahSOPL = $jumlahCTSPD + $jumlahCTSIM + $jumlahCTSTS;
                                ?>
                                <?php if (!empty($totalJumlahSOPL)) : ?>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter"><?= $totalJumlahSOPL; ?></span>
                                <?php endif; ?>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header bg-success border-success">
                                    socializations
                                </h6>
                                <?php if (!empty($totalJumlahSOPL)) : ?>
                                    <?php if ($jumlahCTSPD > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/List-Sosialisasi-PengetahuanDasar">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $jumlahCTSPD; ?> UNREAD socialized OPL <span class="font-weight-bold text-success">Pengetahuan Dasar</span> is ready to trained!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($jumlahCTSIM > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/List-Sosialisasi-Improvement">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $jumlahCTSIM; ?> UNREAD socialized OPL <span class="font-weight-bold text-success">Improvement</span> is ready to trained!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($jumlahCTSTS > '0') : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="/List-Sosialisasi-TroubleShooting">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                                <span class="font-weight-bold"><?= $jumlahCTSTS; ?> UNREAD socialized OPL <span class="font-weight-bold text-success">Trouble Shooting</span> is ready to trained!</span>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <p class="mt-3 text-center small text-gray-500" href="#">Check out the socialized OPL above</p>
                                <?php else : ?>
                                    <p class="mt-3 text-center small text-gray-900 font-weight-bold" href="#">There is no socialized OPL yet</p>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <?= $this->renderSection('page-content'); ?>
                <!-- /.container-fluid -->




            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; onepointlesson.site 2023</span>
                        <span class="d-flex justify-content-end">V1.0</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>

    </div>
    <!-- End of Content Wrapper -->

    <!-- <div class="loader-wrapper row align-items-center justify-content-center">
        <div class="loader"></div>
    </div> -->
    <div class="loader-wrapper row align-items-center justify-content-center">
        <div class="loader">
            <div>
                <ul>
                    <li>
                        <svg fill="currentColor" viewBox="0 0 90 120">
                            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                        </svg>
                    </li>
                    <li>
                        <svg fill="currentColor" viewBox="0 0 90 120">
                            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                        </svg>
                    </li>
                    <li>
                        <svg fill="currentColor" viewBox="0 0 90 120">
                            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                        </svg>
                    </li>
                    <li>
                        <svg fill="currentColor" viewBox="0 0 90 120">
                            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                        </svg>
                    </li>
                    <li>
                        <svg fill="currentColor" viewBox="0 0 90 120">
                            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                        </svg>
                    </li>
                    <li>
                        <svg fill="currentColor" viewBox="0 0 90 120">
                            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                        </svg>
                    </li>
                </ul>
            </div><span>Loading...</span>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded-circle" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <button class="close d-flex justify-content-end mt-3 mr-3" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <img class="img-profile rounded-circle mx-auto d-block w-25" src="<?php base_url(); ?>/img/logout.gif">
                <div class="modal-body h4 text-center mb-0 font-weight-bold text-gray-900">Ready to Leave?</div>
                <h6 class="text-center mt-0 mb-4">You are going to logout from here</h6>
                <a class="btn btn-danger py-2 rounded mx-5 mt-2" href="<?= base_url('logout'); ?>">Yes, Logout</a>
                <button class="btn text-danger border-0 py-2 rounded mx-5 mt-2 mb-4" type="button" data-dismiss="modal">Keep Login</button>
            </div>
        </div>
    </div>

    <script src="<?php base_url(); ?>/js/script.js"></script>
    <script src="<?php base_url(); ?>/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="<?php base_url(); ?>/js/sweetalert2.min.css">

    <!-- Bootstrap core JavaScript-->
    <script src="<?php base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php base_url(); ?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php base_url(); ?>/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php base_url(); ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?php base_url(); ?>/js/demo/chart-pie-demo.js"></script>
    <script src="<?php base_url(); ?>/js/demo/chart-bar-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="<?php base_url(); ?>/js/myalert.js"></script>

    <!-- 
    <script>
        const currentLocation = location.href;
        const menuItem = document.querySelectorAll('a');
        const menuLength = menuItem.length
        for (let i = 0; i < menuLength; i++) {
            if (menuItem[i].href === currentLocation) {
                menuItem[i].className = "aktif sidebar-brand d-flex align-items-center justify-content-center"
            }
        }
    </script> -->
    <script>
        const tombolError = document.querySelector('#tombolError');
        tombolError.addEventListener('click', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data OPL Yang Akan di Export Masih Kosong',
                showConfirmButton: false,
                timer: 2500,
                customClass: 'animated tada rounded-md'
            });
        });
    </script>
    <script>
        const tombolSuccess = document.querySelector('#tombolSuccess');
        tombolSuccess.addEventListener('click', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data OPL Yang Akan di Export Masih Kosong',
                showConfirmButton: false,
                timer: 2500,
                customClass: 'animated tada rounded-md'
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', 'nav ol li', function() {
            $(this).addClass('active bg-success rounded-sm px-2').siblings().removeClass('active bg-success rounded-sm px-2')
        })
    </script>

    <?php for ($i = 1; $i <= 10; $i++) : ?>
        <script>
            function preview_sebelum<?= $i; ?>() {
                counter += 1;
                const foto_sebelum = document.querySelector('#foto_sebelum<?= $i; ?>');
                const foto_sebelum_label = document.querySelector('#label_sebelum<?= $i; ?>');
                const foto_sebelum_preview = document.querySelector('.sebelum-preview<?= $i; ?>');

                foto_sebelum_label.textContent = foto_sebelum.files[0].name;

                const file_foto_sebelum = new FileReader();
                file_foto_sebelum.readAsDataURL(foto_sebelum.files[0]);

                file_foto_sebelum.onload = function(e) {
                    foto_sebelum_preview.src = e.target.result;
                }
            }
        </script>
    <?php endfor; ?>
    <script>
        function preview_sesudah() {
            const foto_sesudah = document.querySelector('#foto_sesudah');
            const foto_sesudah_label = document.querySelector('#label_sesudah');
            const foto_sesudah_preview = document.querySelector('.sesudah-preview');

            foto_sesudah_label.textContent = foto_sesudah.files[0].name;

            const file_foto_sesudah = new FileReader();
            file_foto_sesudah.readAsDataURL(foto_sesudah.files[0]);

            file_foto_sesudah.onload = function(e) {
                foto_sesudah_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        function preview_foto3() {
            const foto3 = document.querySelector('#foto3');
            const foto3_label = document.querySelector('#label_foto3');
            const foto3_preview = document.querySelector('.foto3-preview');

            foto3_label.textContent = foto3.files[0].name;

            const file_foto3 = new FileReader();
            file_foto3.readAsDataURL(foto3.files[0]);

            file_foto3.onload = function(e) {
                foto3_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        function preview_foto4() {
            const foto4 = document.querySelector('#foto4');
            const foto4_label = document.querySelector('#label_foto4');
            const foto4_preview = document.querySelector('.foto4-preview');

            foto4_label.textContent = foto4.files[0].name;

            const file_foto4 = new FileReader();
            file_foto4.readAsDataURL(foto4.files[0]);

            file_foto4.onload = function(e) {
                foto4_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>

</body>

</html>
