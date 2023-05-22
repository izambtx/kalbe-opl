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
            <div class="bg-white rounded-sm rounded-bottom-lg col-auto mx-0 px-0">
                <form action="" method="post">
                    <div class="form-inline">

                        <div class="input-group">
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
                        <div class="input-group ml-1">
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
                    </div>
                    <button type="submit" class="btn-cari-date rounded border-0 btn-block mt-1">
                        <i class="fas fa-search"></i>
                        <span class="text-white">Search By Date</span>
                    </button>
                </form>
            </div>
            <div class="col-auto">
                <h6 class="text-gray-900 font-weight-bold d-flex justify-content-center mr-3">Filter By Date or Search It Up!</h6>
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
                            <td scope="col" class="w-25">Mesin</td>
                            <td scope="col">Pembuat</td>
                            <td scope="col">Status</td>
                            <td scope="col">Gambar</td>
                            <td scope="col" class="w-25">Tanggal Dibuat</td>
                            <td scope="col">Action</td>
                        </tr>
                    </thead>
                    <tbody class="text-gray-900">
                        <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                        <?php foreach ($improvementUserMesin as $imU) : ?>
                            <tr>
                                <td class="align-middle" scope="row"><?= $i++; ?></td>
                                <td class="w-50 align-middle"><?= $imU['tema'];  ?></td>
                                <?php if ($imU['mesin'] == '1') : ?>
                                    <td class="align-middle"><?= $imU['nama_mesin'];  ?></td>
                                <?php else : ?>
                                    <td class="align-middle"><span class="small font-weight-bold text-gray-900"><?= $imU['nama_mesin'];  ?></span></td>
                                <?php endif; ?>
                                <td class="align-middle"><?= $imU['username'];  ?></td>

                                <td class="align-middle">
                                    <?php foreach ($realisasi as $r) : ?>
                                        <?php if ($r['id_im'] == $imU['id'] && $imU['realisasi'] == 'TRUE') : ?>
                                            <span class="badge badge-primary">DONE</span>
                                        <?php elseif ($r['id_im'] == $imU['id'] && $imU['realisasi'] == 'CLOSED') : ?>
                                            <?php if (empty($r['id_trainee'])) : ?>
                                                <span class="badge badge-danger">CLOSED</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">CLOSED</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>

                                <td class="align-middle w-25">
                                    <?php foreach ($foto_imU as $f) : ?>
                                        <?php if ($f['id_im'] == $imU['id']) : ?>
                                            <img src="/img/<?= $f['foto_im']; ?>" style="aspect-ratio: 2/1; object-fit:fill;" class="img-thumbnail m-0 p-0" alt="Gambar OPL">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <!-- <img src="img/default.jpg" class="img-thumbnail m-0 p-0"> -->
                                </td>
                                <td class="align-middle"><?= date('d M Y', strtotime($imU['created_at'])); ?></td>
                                <td class="align-middle">
                                    <a class="btn btn-sm rounded-circle" href="/List-Sosialisasi-Improvement/Detail-Sosialisasi-Improvement/<?= $imU['id']; ?>" role="button">
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
                                    <td class="align-middle">
                                        <a class="btn btn-sm rounded-circle" href="/ListImprovement/DetailsUserImprovement/<?= $im['id']; ?>" role="button">
                                            <i class="far fa-eye"></i>
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