<?php if (in_groups('supervisor') || in_groups('engineer')) : ?>
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

        <!-- Content Row -->
        <div class="row">

            <?php if (in_groups('supervisor') || in_groups('engineer')) : ?>
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
                            <?php foreach ($troubleshooting as $ts) : ?>
                                <?php if (in_groups('engineer')) : ?>
                                    <?php if ($ts['id_distribusi'] == '1' && $ts['status'] == 'Created' || $ts['status'] == 'Approved Supervisor' && $ts['realisasi'] == 'FALSE') : ?>
                                        <tr>
                                            <td class="align-middle" scope="row"><?= $i++; ?></td>
                                            <td class="w-50 align-middle"><?= $ts['tema'];  ?></td>
                                            <td class="align-middle"><?= $ts['nama_distribusi'];  ?></td>
                                            <?php if ($ts['mesin'] == '1') : ?>
                                                <td class="align-middle"><?= $ts['nama_mesin'];  ?></td>
                                            <?php else : ?>
                                                <td class="align-middle"><span class="small font-weight-bold text-gray-900"><?= $ts['nama_mesin'];  ?></span></td>
                                            <?php endif; ?>
                                            <?php if ($ts['status'] == 'Created') : ?>
                                                <td class="align-middle"><span class="badge badge-primary"><?= $ts['status'];  ?></span></td>
                                            <?php elseif ($ts['status'] == 'Updated') : ?>
                                                <td class="align-middle"><span class="badge badge-warning"><?= $ts['status'];  ?></span></td>
                                            <?php elseif ($ts['status'] == 'Approved Supervisor') : ?>
                                                <td class="align-middle"><span class="badge badge-info"><?= $ts['status'];  ?></span></td>
                                            <?php elseif ($ts['status'] == 'Approved Engineer') : ?>
                                                <td class="align-middle"><span class="badge badge-success"><?= $ts['status'];  ?></span></td>
                                            <?php elseif ($ts['status'] == 'Returned Supervisor') : ?>
                                                <td class="align-middle"><span class="badge badge-warning"><?= $ts['status'];  ?></span></td>
                                            <?php elseif ($ts['status'] == 'Rejected Supervisor') : ?>
                                                <td class="align-middle"><span class="badge badge-danger"><?= $ts['status'];  ?></span></td>
                                            <?php elseif ($ts['status'] == 'Returned Engineer') : ?>
                                                <td class="align-middle"><span class="badge badge-warning"><?= $ts['status'];  ?></span></td>
                                            <?php elseif ($ts['status'] == 'Rejected Engineer') : ?>
                                                <td class="align-middle"><span class="badge badge-danger"><?= $ts['status'];  ?></span></td>
                                            <?php endif; ?>
                                            <td class="align-middle"><?= date('d M Y', strtotime($ts['created_at'])); ?></td>
                                            <td class="align-middle">
                                                <a class="btn btn-sm rounded-circle" href="/TroubleShooting/DetailsTroubleShooting/<?= $ts['id']; ?>" role="button">
                                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                                    <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#121331,primary:#231e2d,secondary:#545454,tertiary:#ebe6ef" style="width:25px;height:25px">
                                                    </lord-icon>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                        </tr>
                                    <?php endif; ?>
                                <?php elseif (in_groups('supervisor')) : ?>
                                    <tr>
                                        <td class="align-middle" scope="row"><?= $i++; ?></td>
                                        <td class="w-50 align-middle"><?= $ts['tema'];  ?></td>
                                        <td class="align-middle"><?= $ts['nama_distribusi'];  ?></td>
                                        <?php if ($ts['mesin'] == '1') : ?>
                                            <td class="align-middle"><?= $ts['nama_mesin'];  ?></td>
                                        <?php else : ?>
                                            <td class="align-middle"><span class="small font-weight-bold text-gray-900"><?= $ts['nama_mesin'];  ?></span></td>
                                        <?php endif; ?>
                                        <?php if ($ts['status'] == 'Created') : ?>
                                            <td class="align-middle"><span class="badge badge-primary"><?= $ts['status'];  ?></span></td>
                                        <?php elseif ($ts['status'] == 'Updated') : ?>
                                            <td class="align-middle"><span class="badge badge-warning"><?= $ts['status'];  ?></span></td>
                                        <?php elseif ($ts['status'] == 'Approved Supervisor') : ?>
                                            <td class="align-middle"><span class="badge badge-info"><?= $ts['status'];  ?></span></td>
                                        <?php elseif ($ts['status'] == 'Approved Engineer') : ?>
                                            <td class="align-middle"><span class="badge badge-success"><?= $ts['status'];  ?></span></td>
                                        <?php elseif ($ts['status'] == 'Returned Supervisor') : ?>
                                            <td class="align-middle"><span class="badge badge-warning"><?= $ts['status'];  ?></span></td>
                                        <?php elseif ($ts['status'] == 'Rejected Supervisor') : ?>
                                            <td class="align-middle"><span class="badge badge-danger"><?= $ts['status'];  ?></span></td>
                                        <?php elseif ($ts['status'] == 'Returned Engineer') : ?>
                                            <td class="align-middle"><span class="badge badge-warning"><?= $ts['status'];  ?></span></td>
                                        <?php elseif ($ts['status'] == 'Rejected Engineer') : ?>
                                            <td class="align-middle"><span class="badge badge-danger"><?= $ts['status'];  ?></span></td>
                                        <?php endif; ?>
                                        <td class="align-middle"><?= date('d M Y', strtotime($ts['created_at'])); ?></td>
                                        <td class="align-middle">
                                            <a class="btn btn-sm rounded-circle" href="/TroubleShooting/DetailsTroubleShooting/<?= $ts['id']; ?>" role="button">
                                                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                                <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#121331,primary:#231e2d,secondary:#545454,tertiary:#ebe6ef" style="width:25px;height:25px">
                                                </lord-icon>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
                </div>
            <?php endif; ?>
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