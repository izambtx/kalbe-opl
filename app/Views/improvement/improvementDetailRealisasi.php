<?php if (in_groups('user') && $improvementUser['id_distribusi'] == user()->distribusi) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <!-- Content Card -->
            <div class="card text-center shadow mx-auto table-responsive">
                <table class="table table-bordered text-gray-900">
                    <tbody>
                        <tr>
                            <th scope="col" rowspan="4" class="align-middle">
                                <img src="/img/kalbe.png" width="70" height="30" alt="">
                            </th>
                            <th scope="col" class="font-weight-bold align-middle" style="width: 35%;">ONE POINT LESSON (OPL)</th>
                            <th scope="col" rowspan="4">
                                <small class="font-weight-bold" style="width: 50%;">Dibuat Oleh</small>
                                <br>
                                <br>
                                <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['created_at'])); ?></small>
                                <br>
                                <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['created_at'])); ?></small>
                                <br>
                                <br>
                                <?= user()->username; ?>
                            </th>
                            <td scope="col" rowspan="4">
                                <small class="font-weight-bold">Disetujui Oleh</small>
                                <br>

                                <?php if (in_groups('supervisor')) : ?>
                                    <?php if (empty($improvementUser['penyetuju'])) : ?>
                                        <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                        <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                    <?php else : ?>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['approved_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['approved_at'])); ?></small>
                                        <br>
                                        <br>
                                        <?= user()->username; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (empty($improvementUser['penyetuju'])) : ?>
                                        <br>
                                        <br>
                                        <span class="h4 font-weight-bold">NA</span>
                                    <?php else : ?>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['approved_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['approved_at'])); ?></small>
                                        <br>
                                        <br>
                                        <span class="font-weight-bold text-gray-900"><?= $improvementUser2['username']; ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td scope="col" rowspan="4">
                                <small class="font-weight-bold">Engineering</small>
                                <br>
                                <?php if (in_groups('engineer')) : ?>
                                    <?php if (empty($improvementUser['checked_at']) || empty($improvementUser['engineer'])) : ?>
                                        <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                        <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                    <?php else : ?>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['checked_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['checked_at'])); ?></small>
                                        <br>
                                        <br>
                                        <?= user()->username; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (empty($improvementUser['checked_at']) || empty($improvementUser['engineer'])) : ?>
                                        <br>
                                        <br>
                                        <span class="h4 font-weight-bold"><?= $improvementUser['engineer']; ?></span>
                                    <?php else : ?>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['checked_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['checked_at'])); ?></small>
                                        <br>
                                        <br>
                                        <span class="font-weight-bold text-gray-900"><?= $improvementUser3['username']; ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                            <th scope="col" class=" align-middle"><small class="font-weight-bold" style="width: 10%;">SD/WI No.</small></th>
                            <th scope=" col" class=" align-middle"><small class="font-weight-bold" style="width: 10%;"><?= $improvementUser['sd/wi_no']; ?></small></th>
                        </tr>
                        <tr>
                            <th scope=" row" class="align-middle"><small class="font-weight-bold">Tema : <?= $improvementUser['tema']; ?></small></th>
                            <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">OPL No.</small></td>
                            <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold"><?= $improvementUser['opl_no']; ?></small></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <small class="font-weight-bold">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" disabled>
                                        <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox1"><small><small>Pengetahuan Dasar</small></small></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" checked disabled>
                                        <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox2"><small><small>Improvement</small></small></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                        <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox3"><small><small>Trouble Shooting</small></small></label>
                                    </div>
                                </small>

                            </th>
                            <td class="font-weight-bold"><small class="font-weight-bold">Tanggal</small></td>
                            <td class="font-weight-bold"><small class="font-weight-bold"><?= date('d M Y', strtotime($improvementUser['updated_at'])); ?></small></td>
                        </tr>
                    </tbody>
                </table>

                <div class="container my-5">
                    <div class="row">
                        <?php $x = 1; ?>
                        <?php foreach ($foto_imU as $foto) : ?>
                            <?php if ($foto['foto_im'] == 'default.jpg') : ?>
                            <?php else : ?>
                                <div class="col-sm-3 d-flex flex-wrap align-items-center mx-auto d-block ">
                                    <div class="card border-0">
                                        <img class="card-img-top img-fluid rounded p-0 m-0" style="object-fit: contain; height: 250px;" src="/img/<?= $foto['foto_im'];  ?>" alt="Foto Pengetahuan Dasar">
                                        <div class="card-block">
                                            <h4 class="mt-4 text-center card-title font-weight-bold text-gray-900">Gambar <?= $x++; ?>.</h4>
                                            <p class="mb-4 card-text text-center text-gray-900"><?= $foto['keterangan'];  ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="row p-3 mt-3">
                        <table class="table table-bordered text-gray-900">
                            <tbody>
                                <?php if ($improvementUser['mesin'] == '1') : ?>
                                <?php else : ?>
                                    <tr id="noHover">
                                        <td scope="col" colspan="1"><small class="font-weight-bold">Mesin :</small></td>
                                        <td scope="col" colspan="3"><small class="font-weight-bold"><?= $improvementUser['nama_mesin']; ?></small></td>
                                    </tr>
                                <?php endif; ?>
                                <tr id="noHover">
                                    <td scope="col" style="width: 25%;"><small class="font-weight-bold">Tujuan :</small></td>
                                    <td scope="col"><small class="font-weight-bold">Penjelasan :</small></td>
                                    <td scope="col"><small class="font-weight-bold">Fungsi :</small></td>
                                    <td scope="col" style="width: 25%;"><small class="font-weight-bold">Dampak :</small></td>
                                </tr>
                                <tr class="text-left">
                                    <td><?= $improvementUser['tujuan']; ?></td>
                                    <td scope="row"><?= $improvementUser['penjelasan']; ?></td>
                                    <td><?= $improvementUser['fungsi']; ?></td>
                                    <td><?= $improvementUser['dampak']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if (empty($realisasi['id_trainee'])) : ?>
                    <?php if ($improvementUser['realisasi'] == 'CLOSED') : ?>
                        <div class="container">
                            <div class="d-flex justify-content-start p-3 mb-4">
                                <h5 class="text-danger font-weight-bold">
                                    Sosialisasi OPL
                                    <span class="text-gray-900"><?= $improvementUser['tema']; ?></span>
                                    Telah Ditutup
                                </h5>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="container">
                            <div class="form-check">
                                <div class="col-sm-5">
                                    <form action="/List-Sosialisasi-Improvement/Detail-Sosialisasi-Improvement/ParafTrainee/<?= $improvementUser['id']; ?>" method="post">
                                        <?= csrf_field();  ?>
                                        <div class="form-check form-switch d-flex justify-content-start text-gray-900 align-middle mb-4">
                                            <input class="form-check-input cekbox mr-1" type="checkbox" id="checkbox1" onchange="document.getElementById('submitBtn').disabled = !this.checked;">
                                            <label class="form-check-label font-weight-bold ml-5 mt-2 align-middle" for="checkbox1">Saya Telah Membaca dan Memahami</label>
                                        </div>
                                        <button type="submit" class="btn btn-success mt-3 my-4 px-5 d-flex justify-content-start rounded ml-0" disabled id="submitBtn">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php elseif ($realisasi['id_trainee'] == user_id()) : ?>
                    <?php if ($improvementUser['realisasi'] == 'CLOSED') : ?>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="container">
                        <div class="form-check">
                            <div class="col-sm-5">
                                <form action="/List-Sosialisasi-Improvement/Detail-Sosialisasi-Improvement/ParafTrainee/<?= $improvementUser['id']; ?>" method="post">
                                    <?= csrf_field();  ?>
                                    <div class="form-check form-switch d-flex justify-content-start text-gray-900 align-middle mb-4">
                                        <input class="form-check-input cekbox mr-1" type="checkbox" id="checkbox1" onchange="document.getElementById('submitBtn').disabled = !this.checked;">
                                        <label class="form-check-label font-weight-bold ml-5 mt-2 align-middle" for="checkbox1">Saya Telah Membaca dan Memahami</label>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3 my-4 px-5 d-flex justify-content-start rounded ml-0" disabled id="submitBtn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- End Of Modal -->
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