<?php if (in_groups('user')) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">

        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

        <!-- Page Heading -->
        <div class="row mb-4">
            <div class="col-auto mr-auto">

            </div>
            <!-- <div class="col-auto">
                <div class="col-auto">
                    <div class="form-check form-switch text-gray-900 align-middle mt-1 mr-5">
                        <label class="form-check-label font-weight-bold mr-3 mt-1 align-middle" for="flexSwitchCheckDefault">Sort By Machine</label>
                        <input class="form-check-input cekbox ml-1" type="checkbox" id="flexSwitchCheckDefault">
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

        <?php if (in_groups('user')) : ?>

            <!-- Content Card -->
            <div class="card text-center shadow mx-auto table-responsive">
                <table class="table table-striped table-bordered font-weight-bold">
                    <thead class="text-success">
                        <tr>
                            <td scope="col">No</td>
                            <td scope="col">Tema</td>
                            <td scope="col">Department</td>
                            <td scope="col">Status</td>
                            <td scope="col">Sosialisasi</td>
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
                                <?php if ($imU['status'] == 'Created') : ?>
                                    <td class="align-middle"><span class="badge badge-primary"><?= $imU['status'];  ?></span></td>
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
                                <?php if ($imU['realisasi'] == 'TRUE') : ?>
                                    <td class="align-middle"><span class="badge badge-primary">Ongoing</span></td>
                                <?php elseif ($imU['realisasi'] == 'FALSE') : ?>
                                    <td class="align-middle"><span class="badge badge-secondary">Unready</span></td>
                                <?php elseif ($imU['realisasi'] == 'CLOSED') : ?>
                                    <td class="align-middle"><span class="badge badge-danger">Closed</span></td>
                                <?php endif; ?>
                                <td class="align-middle"><?= date('d M Y', strtotime($imU['created_at'])); ?></td>
                                <td class="align-middle p-0 m-0 border-left-0 border-right-0">
                                    <?php if ($imU['status'] == 'Returned Supervisor' || $imU['status'] == 'Returned Engineer') : ?>
                                        <a class="btn btn-sm rounded-circle" role="button" href="/ListImprovement/DetailsUserImprovement/<?= $imU['id']; ?>">
                                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                            <lord-icon src="https://cdn.lordicon.com/alzqexpi.json" trigger="hover" style="width:25px;height:25px">
                                            </lord-icon>
                                        </a>
                                    <?php elseif ($imU['status'] == 'Rejected Supervisor' || $imU['status'] == 'Rejected Engineer' || $imU['status'] == 'Approved Supervisor' || $imU['status'] == 'Approved Engineer') : ?>
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
        <?php else : ?>
            <!-- Content Row -->
            <div class="row">
                <!-- Content Card -->
                <div class="card text-center shadow mx-auto table-responsive">
                    <table class="table table-striped table-bordered font-weight-bold">
                        <thead class="text-success">
                            <tr>
                                <td scope="col">No</td>
                                <td scope="col">Tema</td>
                                <td scope="col">Status</td>
                                <td scope="col" class="w-25">Created At</td>
                                <td scope="col" class="w-25">Last Updated At</td>
                                <td scope="col">Action</td>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900">
                            <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                            <?php foreach ($improvement as $im) : ?>
                                <tr>
                                    <th class="align-middle" scope="row"><?= $i++; ?></th>
                                    <td class="w-50 align-middle"><?= $im['tema'];  ?></td>
                                    <?php if ($im['status'] == 'Created') : ?>
                                        <td class="align-middle"><span class="badge badge-primary"><?= $im['status'];  ?></span></td>
                                    <?php elseif ($im['status'] == 'Approved Supervisor') : ?>
                                        <td class="align-middle"><span class="badge badge-info"><?= $im['status'];  ?></span></td>
                                    <?php elseif ($im['status'] == 'Approved Engineer') : ?>
                                        <td class="align-middle"><span class="badge badge-success"><?= $im['status'];  ?></span></td>
                                    <?php elseif ($im['status'] == 'Returned Supervisor') : ?>
                                        <td class="align-middle"><span class="badge badge-warning"><?= $im['status'];  ?></span></td>
                                    <?php elseif ($im['status'] == 'Rejected Supervisor') : ?>
                                        <td class="align-middle"><span class="badge badge-danger"><?= $im['status'];  ?></span></td>
                                    <?php elseif ($im['status'] == 'Returned Engineer') : ?>
                                        <td class="align-middle"><span class="badge badge-warning"><?= $im['status'];  ?></span></td>
                                    <?php elseif ($im['status'] == 'Rejected Engineer') : ?>
                                        <td class="align-middle"><span class="badge badge-danger"><?= $im['status'];  ?></span></td>
                                    <?php endif; ?>
                                    <td class="align-middle"><?= date('d M Y', strtotime($im['created_at'])); ?></td>
                                    <td class="align-middle"><?= date('d M Y', strtotime($im['updated_at'])); ?></td>
                                    <td class="align-middle p-0 m-0 border-left-0 border-right-0">
                                        <a class="btn btn-sm rounded-circle" href="/ListImprovement/DetailsUserImprovement/<?= $im['id']; ?>" role="button">
                                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                            <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#121331,primary:#231e2d,secondary:#545454,tertiary:#ebe6ef" style="width:25px;height:25px">
                                            </lord-icon>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
                </div>
            </div>
        <?php endif; ?>
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