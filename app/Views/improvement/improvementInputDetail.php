<?php if ($improvementUser['pembuat'] == user()->id && in_groups('user')) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Card -->
            <div class="card text-center shadow mx-auto table-responsive">
                <div class="bg-white" id="contentOPL">
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
                                    <span class="font-weight-bold text-gray-900"><?= $improvementUser['username']; ?></span>
                                </th>
                                <td scope="col" rowspan="4">
                                    <small class="font-weight-bold">Disetujui Oleh</small>
                                    <br>

                                    <?php if (in_groups('supervisor')) : ?>
                                        <?php if (empty($improvementUser['approved_at']) || empty($improvementUser['penyetuju'])) : ?>
                                            <?php if ($improvementUser['status'] == 'Rejected Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($improvementUser['status'] == 'Returned Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['approved_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['approved_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $improvementUser2['username']; ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (empty($improvementUser['approved_at']) || empty($improvementUser['penyetuju'])) : ?>
                                            <?php if ($improvementUser['status'] == 'Rejected Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($improvementUser['status'] == 'Returned Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <span class="h4 font-weight-bold">NA</span>
                                            <?php endif; ?>
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
                                            <?php if ($improvementUser['status'] == 'Rejected Engineer') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($improvementUser['status'] == 'Returned Engineer') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['checked_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['checked_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $improvementUser3['username']; ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (empty($improvementUser['checked_at']) || empty($improvementUser['engineer'])) : ?>
                                            <?php if ($improvementUser['status'] == 'Rejected Engineer') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($improvementUser['status'] == 'Returned Engineer') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <span class="h4 font-weight-bold">NA</span>
                                            <?php endif; ?>
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
                                <?php if ($improvementUser['status'] == 'Created' || $improvementUser['status'] == 'Updated' || $improvementUser['status'] == 'Returned Supervisor') : ?>
                                    <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">NA</small></td>
                                <?php else : ?>
                                    <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold"><?= $improvementUser['opl_no']; ?></small></td>
                                <?php endif; ?>
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
                        <?php if ($improvementUser['status'] == 'Rejected Supervisor' || $improvementUser['status'] == 'Returned Supervisor' || $improvementUser['status'] == 'Rejected Engineer' || $improvementUser['status'] == 'Returned Engineer') : ?>
                            <tfoot>
                                <tr>
                                    <td scope="col" class="align-middle">
                                        <h6 class="font-weight-bold text-gray-900">Alasan :</h6>
                                    </td>
                                    <td scope="col" colspan="4" class="align-middle border-right-0">
                                        <span class="small font-weight-bold"><?= $improvementUser['alasan']; ?></span>
                                    </td>
                                    <td scope="col" colspan="2" class="align-middle border-left-0">
                                        <?php if ($improvementUser['status'] == 'Returned Supervisor' || $improvementUser['status'] == 'Returned Engineer') : ?>
                                            <a href="/ListImprovement/Edit/DetailsUserImprovement/<?= $improvementUser['id']; ?>" class="cssbuttons-io-button">
                                                <span class="font-weight-bold">update OPL</span>
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                                        <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                    <div class="container mt-5">
                        <div class="row">
                            <?php $x = 1; ?>
                            <?php foreach ($foto_imU as $foto) : ?>
                                <?php if ($foto['foto_im'] == 'default.jpg') : ?>
                                <?php else : ?>
                                    <div class="col-sm-3 d-flex flex-wrap align-items-center mx-auto d-block ">
                                        <div class="card border-0">
                                            <img class="card-img-top img-fluid rounded p-0 m-0" style="object-fit: contain; height: 250px;" src="/img/<?= $foto['foto_im'];  ?>" alt="Foto Improvement">
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
                </div>
                <div class="container">

                    <?php if ($improvementUser['realisasi'] != 'FALSE' && $improvementUser['pembuat'] == user_id()) : ?>

                        <div class="col-auto d-flex mb-5">
                            <div class="col-auto my-auto">
                                <button id="downloadOPL" class="download-button">
                                    <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line y2="13" x2="8" y1="13" x1="16"></line>
                                            <line y2="17" x2="8" y1="17" x1="16"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg> Download .PNG</div>
                                    <div class="download">
                                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line y2="3" x2="12" y1="15" x1="12"></line>
                                        </svg>
                                    </div>
                                </button>
                            </div>


                            <?php if ($improvementUser['realisasi'] == 'TRUE') : ?>
                                <div class="col-auto">
                                    <form action="/ListImprovement/DetailsUserImprovement/CloseSosialisasi/<?= $improvementUser['id']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <button class="noselect" type="submit">
                                            <span class="text">Close</span>
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            <?php elseif ($improvementUser['realisasi'] == 'CLOSED') : ?>
                                <div class="col-auto">
                                    <form action="/ListImprovement/DetailsUserImprovement/OpenSosialisasi/<?= $improvementUser['id']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <button class="select" type="submit">
                                            <span class="text">Open</span>
                                            <span class="icon">
                                                <i class="fas fa-check" style="color: #ffffff;"></i>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row p-3">
                            <table class="table table-hover table-bordered text-gray-900">
                                <tbody>
                                    <tr class="bg-success" id="noHover">
                                        <td scope="col" colspan="6" class="align-middle">Sosialisasi OPL</td>
                                    </tr>
                                    <tr class="bg-success" id="noHover">
                                        <!-- <td scope="col" rowspan="11" class="align-middle">Realisasi</td> -->
                                        <td scope="col"><small class="font-weight-bold">No.</small></td>
                                        <td scope="col"><small class="font-weight-bold">Tanggal Training</small></td>
                                        <td scope="col"><small class="font-weight-bold">Nama Trainee</small></td>
                                        <td scope="col"><small class="font-weight-bold">Paraf Trainee</small></td>
                                        <td scope="col"><small class="font-weight-bold">Nama Trainer</small></td>
                                        <td scope="col"><small class="font-weight-bold">Paraf Trainer</small></td>
                                    </tr>
                                    <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                                    <?php foreach ($realisasiIM as $rim) : ?>
                                        <tr>
                                            <td class="align-middle" scope="row"><?= $i++; ?></td>
                                            <td class="align-middle" scope="row"><?= date('d M Y', strtotime($rim['tanggal_training'])); ?></td>
                                            <td class="align-middle" scope="row"><?= $rim['username']; ?></td>
                                            <td class="align-middle" scope="row"><?= $rim['paraf_trainee']; ?></td>
                                            <?php if (empty($rim['id_trainer'])) : ?>
                                                <td class="align-middle" scope="row"></td>
                                                <td class="align-middle" scope="row">
                                                    <form class="d-inline" action="/ListImprovement/DetailsUserImprovement/ParafTrainer/<?= $improvementUser['id']; ?>" method="post">
                                                        <input type="hidden" name="id" id="id" value="<?= $rim['id']; ?>">
                                                        <button type="submit" class="px-4 btn btn-primary"><i class="fas fa-check"></i></button>
                                                    </form>
                                                    <form class="d-inline" action="/ListImprovement/DetailsUserImprovement/<?= $improvementUser['id']; ?>" method="post">
                                                        <?php csrf_field(); ?>
                                                        <input type="hidden" name="id" id="id" value="<?= $rim['id']; ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="px-4 btn btn-danger"><i class="fas fa-times"></i></button>
                                                    </form>
                                                </td>
                                            <?php else : ?>
                                                <td class="align-middle" scope="row"><?= user()->username; ?></td>
                                                <td class="align-middle" scope="row"><?= $rim['paraf_trainer']; ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td scope="row" colspan="4">Daftar Distribusi</td>
                                        <td scope="row" colspan="4"><?= $improvementUser['nama_distribusi']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>

<?php elseif (in_groups('admin')) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Card -->
            <div class="card text-center shadow mx-auto table-responsive">
                <div class="bg-white" id="contentOPL">
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
                                    <span class="font-weight-bold text-gray-900"><?= $improvementUser['username']; ?></span>
                                </th>
                                <td scope="col" rowspan="4">
                                    <small class="font-weight-bold">Disetujui Oleh</small>
                                    <br>

                                    <?php if (in_groups('supervisor')) : ?>
                                        <?php if (empty($improvementUser['approved_at']) || empty($improvementUser['penyetuju'])) : ?>
                                            <?php if ($improvementUser['status'] == 'Rejected Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($improvementUser['status'] == 'Returned Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['approved_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['approved_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $improvementUser2['username']; ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (empty($improvementUser['approved_at']) || empty($improvementUser['penyetuju'])) : ?>
                                            <?php if ($improvementUser['status'] == 'Rejected Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($improvementUser['status'] == 'Returned Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <span class="h4 font-weight-bold">NA</span>
                                            <?php endif; ?>
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
                                            <?php if ($improvementUser['status'] == 'Rejected Engineer') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($improvementUser['status'] == 'Returned Engineer') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($improvementUser['checked_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($improvementUser['checked_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $improvementUser3['username']; ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (empty($improvementUser['checked_at']) || empty($improvementUser['engineer'])) : ?>
                                            <?php if ($improvementUser['status'] == 'Rejected Engineer') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($improvementUser['status'] == 'Returned Engineer') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <span class="h4 font-weight-bold">NA</span>
                                            <?php endif; ?>
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
                                <?php if ($improvementUser['status'] == 'Created' || $improvementUser['status'] == 'Returned Supervisor') : ?>
                                    <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">NA</small></td>
                                <?php else : ?>
                                    <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold"><?= $improvementUser['opl_no']; ?></small></td>
                                <?php endif; ?>
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
                        <?php if ($improvementUser['status'] == 'Rejected Supervisor' || $improvementUser['status'] == 'Returned Supervisor' || $improvementUser['status'] == 'Rejected Engineer' || $improvementUser['status'] == 'Returned Engineer') : ?>
                            <tfoot>
                                <tr>
                                    <td scope="col" class="align-middle">
                                        <h6 class="font-weight-bold text-gray-900">Alasan :</h6>
                                    </td>
                                    <td scope="col" colspan="4" class="align-middle border-right-0">
                                        <span class="small font-weight-bold"><?= $improvementUser['alasan']; ?></span>
                                    </td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                    <div class="container mt-5">
                        <div class="row">
                            <?php $x = 1; ?>
                            <?php foreach ($foto_imU as $foto) : ?>
                                <?php if ($foto['foto_im'] == 'default.jpg') : ?>
                                <?php else : ?>
                                    <div class="col-sm-3 d-flex flex-wrap align-items-center mx-auto d-block ">
                                        <div class="card border-0">
                                            <img class="card-img-top img-fluid rounded p-0 m-0" style="object-fit: contain; height: 250px;" src="/img/<?= $foto['foto_im'];  ?>" alt="Foto Improvement">
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
                </div>
                <div class="container">
                    <div class="row p-3">
                        <table class="table table-hover table-bordered text-gray-900">
                            <tbody>
                                <tr class="bg-success" id="noHover">
                                    <td scope="col" colspan="6" class="align-middle">Sosialisasi OPL</td>
                                </tr>
                                <tr class="bg-success" id="noHover">
                                    <!-- <td scope="col" rowspan="11" class="align-middle">Realisasi</td> -->
                                    <td scope="col"><small class="font-weight-bold">No.</small></td>
                                    <td scope="col"><small class="font-weight-bold">Tanggal Training</small></td>
                                    <td scope="col"><small class="font-weight-bold">Nama Trainee</small></td>
                                    <td scope="col"><small class="font-weight-bold">Paraf Trainee</small></td>
                                    <td scope="col"><small class="font-weight-bold">Nama Trainer</small></td>
                                    <td scope="col"><small class="font-weight-bold">Paraf Trainer</small></td>
                                </tr>
                                <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                                <?php foreach ($realisasiIM as $rim)
                                    foreach ($realisasiTrainerIM as $rimt) : ?>
                                    <tr>
                                        <td class="align-middle" scope="row"><?= $i++; ?></td>
                                        <td class="align-middle" scope="row"><?= date('d M Y', strtotime($rim['tanggal_training'])); ?></td>
                                        <td class="align-middle" scope="row"><?= $rim['username']; ?></td>
                                        <td class="align-middle" scope="row"><?= $rim['paraf_trainee']; ?></td>
                                        <td class="align-middle" scope="row"><?= $rimt['username']; ?></td>
                                        <td class="align-middle" scope="row"><?= $rim['paraf_trainer']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td scope="row" colspan="4">Daftar Distribusi</td>
                                    <td scope="row" colspan="4"><?= $improvementUser['nama_distribusi']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Start of Modal -->

    <!-- Return Modal -->
    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Return One Point Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <img src="/img/caution.gif" class="w-25 mx-auto d-block">
                        <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Return This OPL?</h4>
                        <label for="message-text text-left" class="col-form-label">Alasan Return :</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning px-4">Return</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Reject One Point Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <img src="/img/reject.gif" class="w-25 mx-auto d-block">
                        <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Reject This OPL?</h4>
                        <label for="message-text text-left" class="col-form-label">Alasan Reject :</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger px-4">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Aprrove Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content mb-0">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Approve One Point Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <img src="/img/sending.gif" class="w-25 mx-auto d-block">
                        <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Approve This OPL?</h4>
                        <h6 class="small text-center text-gray-900">Make Sure The Data Below is Correct</h6>

                        <?php if (in_groups('supervisor')) : ?>
                            <form action="/TroubleShooting/approve/<?= $improvementUser['id']; ?>" method="post">
                                <?= csrf_field();  ?>
                                <div class="form-group row mb-0 mt-5">
                                    <label for="temaopl" class="col-sm-3 col-form-label">Tema OPL </label>
                                    <div class="col-sm-9">
                                        <textarea readonly rows="4" id="temaopl" name="temaopl" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= $improvementUser['tema']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="noopl" class="col-sm-3 col-form-label">OPL No. </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="noopl" name="noopl" readonly value="OPL3-<?= $improvementUser['singkatan']; ?>-<?= $improvementUser['id']; ?>-<?= $improvementUser['revisi']; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="approveopl" class="col-sm-3 col-form-label">Approver </label>
                                    <div class="col-sm-9">
                                        <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                        <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <input type="hidden" class="border-0 d-block" value="Approved" id="statusopl" name="statusopl">
                                <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglapprove" name="tglapprove"></input>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary px-4 mx-2 mt-5" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                                </div>
                            </form>

                        <?php elseif (in_groups('engineer')) : ?>
                            <form action="/TroubleShooting/check/<?= $improvementUser['id']; ?>" method="post">
                                <?= csrf_field();  ?>
                                <div class="form-group row mb-0 mt-5">
                                    <label for="temaopl" class="col-sm-3 col-form-label">Tema OPL </label>
                                    <div class="col-sm-9">
                                        <textarea readonly rows="4" id="temaopl" name="temaopl" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= $improvementUser['tema']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="noopl" class="col-sm-3 col-form-label">Mesin </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="noopl" name="noopl" readonly value="<?= $improvementUser['mesin']; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="approveopl" class="col-sm-3 col-form-label">Approver </label>
                                    <div class="col-sm-9">
                                        <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                        <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <input type="hidden" class="border-0 d-block" value="Done" id="statusopl" name="statusopl">
                                <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglcheck" name="tglcheck"></input>

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary px-4 mx-2 mt-5" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
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