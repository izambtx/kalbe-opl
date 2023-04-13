<?php if (in_groups('user') && $id_user == user_id()) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">

        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

        <!-- Page Heading -->
        <div class="row mb-4">
            <div class="col-auto mr-auto">
                <a href="/ListImprovement/CreateImprovement" type="button" class="btn btn-outline-primary"><i class="fas fa-plus-circle"> </i> Write New</a>
            </div>
            <!-- <div class="col-auto">
                <div class="col-auto">
                    <div class="form-check form-switch text-gray-900 align-middle mt-1 mr-5">
                        <label class="form-check-label font-weight-bold mr-3 mt-1 align-middle" for="mesin">Sort By Machine</label>
                        <input class="form-check-input cekbox ml-1" type="checkbox" id="mesin" name="mesin" value="1">
                    </div>
                </div>
            </div> -->
            <div class="col-auto">
                <form action="" method="post" class="form-inline border border-secondary rounded-lg bg-white mr-3">
                    <button type="submit" class="btn-cari border-0 rounded-circle m-1"><i class="fas fa-search"></i></button>
                    <input name="keyword" value="<?= $keyword; ?>" class="pl-1 form-control rounded-right-lg border-0" placeholder="Search" type="search" aria-label="Search">
                </form>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Card -->
            <div class="card text-center shadow mx-auto table-responsive">
                <table class="table table-striped table-bordered font-weight-bold">
                    <thead class="text-success">
                        <tr>
                            <td scope="col">No</td>
                            <td scope="col">Tema</td>
                            <td scope="col">Department</td>
                            <td scope="col" class="w-25">Mesin</td>
                            <td scope="col">Status</td>
                            <td scope="col" class="w-25">Tanggal Dibuat</td>
                            <td scope="col">Action</td>
                        </tr>
                    </thead>
                    <tbody class="text-gray-900">
                        <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                        <?php foreach ($improvementUser as $imU) : ?>
                            <tr>
                                <th class="align-middle" scope="row"><?= $i++; ?></th>
                                <td class="w-50 align-middle"><?= $imU['tema'];  ?></td>
                                <td class="align-middle"><?= $imU['nama_distribusi'];  ?></td>
                                <?php if ($imU['mesin'] == '1') : ?>
                                    <td class="align-middle"><?= $imU['nama_mesin'];  ?></td>
                                <?php else : ?>
                                    <td class="align-middle"><span class="small font-weight-bold text-gray-900"><?= $imU['nama_mesin'];  ?></span></td>
                                <?php endif; ?>
                                <?php if ($imU['status'] == 'Created') : ?>
                                    <td class="align-middle"><span class="badge badge-primary"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Updated') : ?>
                                    <td class="align-middle"><span class="badge badge-warning"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Approved Supervisor') : ?>
                                    <td class="align-middle"><span class="badge badge-info"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Approved Engineer') : ?>
                                    <td class="align-middle"><span class="badge badge-success"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Returned Supervisor') : ?>
                                    <td class="align-middle"><span class="badge badge-warning"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Rejected Supervisor') : ?>
                                    <td class="align-middle"><span class="badge badge-danger"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Returned Engineer') : ?>
                                    <td class="align-middle"><span class="badge badge-warning"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Rejected Engineer') : ?>
                                    <td class="align-middle"><span class="badge badge-danger"><?= $imU['status'];  ?></span></td>
                                <?php endif; ?>
                                <td class="align-middle"><?= $noopl;  ?></td>
                                <td class="align-middle"><?= date('d M Y', strtotime($imU['created_at'])); ?></td>
                                <td class="align-middle p-0 m-0 border-left-0 border-right-0">
                                    <?php if ($imU['status'] == 'Returned' || $imU['status'] == 'Rejected') : ?>
                                        <a class="btn btn-sm rounded-circle" href="/ListImprovement/DetailsUserImprovement/<?= $imU['id']; ?>" role="button">
                                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                            <lord-icon src="https://cdn.lordicon.com/alzqexpi.json" trigger="hover" style="width:25px;height:25px">
                                            </lord-icon>
                                        </a>
                                    <?php else : ?>
                                        <a class="btn btn-sm rounded-circle" href="/ListImprovement/DetailsUserImprovement/<?= $imU['id']; ?>" role="button">
                                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                            <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#121331,primary:#231e2d,secondary:#545454,tertiary:#ebe6ef" style="width:25px;height:25px">
                                            </lord-icon>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>

<?php elseif (in_groups('admin')) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">

        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

        <!-- Page Heading -->
        <div class="row mb-4">

            <!-- Filter Dropdown -->
            <div class="col-auto mx-auto">
                <div class="col-sm-12 d-flex justify-content-center px-0">
                    <?php if ($month || $year || $distribusi || $users) : ?>
                        <form action="" method="post" class="form-inline bg-white py-3 px-1 rounded-top">
                        <?php else : ?>
                            <form action="" method="post" class="form-inline bg-white py-3 px-1 rounded">
                            <?php endif; ?>
                            <div class="input-group col-sm-4">
                                <?php
                                $selected_month = date('m'); //current month

                                echo '<select class="custom-select text-gray-900 font-weight-bold" id="month" name="month">' . "\n";
                                echo '<option selected disabled hidden>Choose Month</option>' . "\n";
                                for ($i_month = 1; $i_month <= 12; $i_month++) {
                                    $selected = ($selected_month == $i_month ? ' selected' : '');
                                    echo '<option value="' . $i_month . '"' . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                                }
                                echo '</select>' . "\n";
                                ?>
                            </div>
                            <div class="input-group col-sm-3">
                                <?php
                                $year_start  = 2023;
                                $year_end = date('Y'); // current Year
                                $user_selected_year = 1992; // user date of birth year

                                echo '<select class="custom-select text-gray-900 font-weight-bold" id="year" name="year">' . "\n";
                                echo '<option selected disabled hidden value="$year_end">Choose Year</option>' . "\n";
                                for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                                    $selected = ($user_selected_year == $i_year ? ' selected' : '');
                                    echo '<option value="' . $i_year . '"' . '>' . $i_year . '</option>' . "\n";
                                }
                                echo '</select>' . "\n";
                                ?>
                            </div>
                            <div class="input-group col-sm-5">
                                <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="distribusi" name="distribusi">
                                    <option selected disabled hidden>Choose Department</option>
                                    <?php foreach ($distribusiList as $d) : ?>
                                        <option value="<?= $d['id'];  ?>" <?= old('distribusi') == $d['id'] ? 'selected' : '' ?>><?= $d['nama_distribusi'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search-plus"></i></button>
                            </div>
                            </form>
                            <div class="col-auto my-auto">
                                <form action="" method="post" class="form-inline border border-secondary rounded-lg bg-white mr-3">
                                    <button type="submit" class="btn-cari border-0 rounded-circle m-1"><i class="fas fa-search"></i></button>
                                    <input name="keyword" value="<?= $keyword; ?>" class="pl-1 form-control rounded-right-lg border-0" placeholder="Search" type="search" aria-label="Search">
                                </form>
                            </div>
                </div>
                <?php if ($month || $year || $distribusi) : ?>
                    <?php if ($month && $year && $distribusi) : ?>
                        <div class="mb-3 bg-white px-3 pb-4 rounded-bottom-end">
                            <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                            <div class="form-inline border border-success mx-2 rounded">
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= $year; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= $distribusiNama['nama_distribusi']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($distribusi && $year) : ?>
                        <div class="mb-3 bg-white px-3 pb-4 rounded-bottom-end">
                            <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                            <div class="form-inline border border-success mx-2 rounded">
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= $year; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= $distribusiNama['nama_distribusi']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($distribusi && $month) : ?>
                        <div class="mb-3 bg-white px-3 pb-4 rounded-bottom-end">
                            <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                            <div class="form-inline border border-success mx-2 rounded">
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= $distribusiNama['nama_distribusi']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($month && $year) : ?>
                        <div class="mb-3 bg-white px-3 pb-4 rounded-bottom-end">
                            <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                            <div class="form-inline border border-success mx-2 rounded">
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= $year; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($month) : ?>
                        <div class="mb-3 bg-white px-3 pb-4 rounded-bottom-end">
                            <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                            <div class="form-inline border border-success mx-2 rounded">
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($year) : ?>
                        <div class="mb-3 bg-white px-3 pb-4 rounded-bottom-end">
                            <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                            <div class="form-inline border border-success mx-2 rounded">
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= $year; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($distribusi) : ?>
                        <div class="mb-3 bg-white px-3 pb-4 rounded-bottom-end">
                            <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                            <div class="form-inline border border-success mx-2 rounded">
                                <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                    <span class="mt-1 align-middle">
                                        <i class="fas fa-tags mr-2"></i><?= $distribusiNama['nama_distribusi']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Card -->
            <div class="card text-center shadow mx-auto table-responsive">
                <table class="table table-striped table-bordered font-weight-bold">
                    <thead class="text-success">
                        <tr>
                            <td scope="col">No</td>
                            <td scope="col">Tema</td>
                            <td scope="col">Department</td>
                            <td scope="col" class="w-25">Mesin</td>
                            <td scope="col">Status</td>
                            <td scope="col" class="w-25">OPL No.</td>
                            <td scope="col" class="w-25">Tanggal Dibuat</td>
                            <td scope="col">Action</td>
                        </tr>
                    </thead>
                    <tbody class="text-gray-900">
                        <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                        <?php foreach ($improvementUser as $imU) : ?>
                            <tr>
                                <th class="align-middle" scope="row"><?= $i++; ?></th>
                                <td class="w-50 align-middle"><?= $imU['tema'];  ?></td>
                                <td class="align-middle"><?= $imU['nama_distribusi'];  ?></td>
                                <?php if ($imU['mesin'] == '1') : ?>
                                    <td class="align-middle"><?= $imU['nama_mesin'];  ?></td>
                                <?php else : ?>
                                    <td class="align-middle"><span class="small font-weight-bold text-gray-900"><?= $imU['nama_mesin'];  ?></span></td>
                                <?php endif; ?>
                                <?php if ($imU['status'] == 'Created') : ?>
                                    <td class="align-middle"><span class="badge badge-primary"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Updated') : ?>
                                    <td class="align-middle"><span class="badge badge-warning"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Approved Supervisor') : ?>
                                    <td class="align-middle"><span class="badge badge-info"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Approved Engineer') : ?>
                                    <td class="align-middle"><span class="badge badge-success"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Returned Supervisor') : ?>
                                    <td class="align-middle"><span class="badge badge-warning"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Rejected Supervisor') : ?>
                                    <td class="align-middle"><span class="badge badge-danger"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Returned Engineer') : ?>
                                    <td class="align-middle"><span class="badge badge-warning"><?= $imU['status'];  ?></span></td>
                                <?php elseif ($imU['status'] == 'Rejected Engineer') : ?>
                                    <td class="align-middle"><span class="badge badge-danger"><?= $imU['status'];  ?></span></td>
                                <?php endif; ?>
                                <?php

                                if (stripos($imU['opl_no'], 'OPL') !== FALSE) {
                                    $noopl = $imU['opl_no'];
                                } else {
                                    $noopl = 'NA';
                                }

                                ?>
                                <td class="align-middle"><?= $noopl; ?></td>
                                <td class="align-middle"><?= date('d M Y', strtotime($imU['created_at'])); ?></td>
                                <td class="align-middle p-0 m-0 border-left-0 border-right-0">
                                    <?php if ($imU['status'] == 'Returned' || $imU['status'] == 'Rejected') : ?>
                                        <a class="btn btn-sm rounded-circle" href="/ListImprovement/DetailsUserImprovement/<?= $imU['id']; ?>" role="button">
                                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                            <lord-icon src="https://cdn.lordicon.com/alzqexpi.json" trigger="hover" style="width:25px;height:25px">
                                            </lord-icon>
                                        </a>
                                    <?php else : ?>
                                        <a class="btn btn-sm rounded-circle" href="/ListImprovement/DetailsUserImprovement/<?= $imU['id']; ?>" role="button">
                                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                            <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#121331,primary:#231e2d,secondary:#545454,tertiary:#ebe6ef" style="width:25px;height:25px">
                                            </lord-icon>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>
<?php else : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <link rel="icon" type="img/x-icon" href="/img/favicon.ico">
        <link href="<?php base_url(); ?>/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="<?php base_url(); ?>/css/sb-admin-2.css" rel="stylesheet">
        <title>One Point Lesson</title>
    </head>

    <body style="margin:0;">
        <img draggable="false" src="/img/404.png" style="width: 100%; height: 100%; object-fit:cover; z-index: index 0; position:absolute;">
        <a class="btn btn-outline-light px-4 m-0 font-weight-bold" href="/<?php base_url() ?>" style="position:absolute;z-index:1;left:50%;top:70%; transform:translate(-50%, -50%)">GO HOME</a>
    </body>

    </html>
<?php endif; ?>