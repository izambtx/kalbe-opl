<?php if ($pengetahuandasarUser['pembuat'] == user()->id && in_groups('user')) : ?>

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
                                <td scope="col" rowspan="4" class="align-middle">
                                    <img src="/img/kalbe.png" width="70" height="30" alt="Logo Kalbe">
                                </td>
                                <td scope="col" class="font-weight-bold align-middle" style="width: 35%;">ONE POINT LESSON (OPL)</td>
                                <td scope="col" rowspan="4">
                                    <small class="font-weight-bold" style="width: 50%;">Dibuat Oleh</small>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['created_at'])); ?></small>
                                    <br>
                                    <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['created_at'])); ?></small>
                                    <br>
                                    <br>
                                    <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser['username']; ?></span>
                                </td>
                                <td scope="col" rowspan="4">
                                    <small class="font-weight-bold">Disetujui Oleh</small>
                                    <br>

                                    <?php if (in_groups('supervisor')) : ?>
                                        <?php if (empty($pengetahuandasarUser['approved_at']) || empty($pengetahuandasarUser['penyetuju'])) : ?>
                                            <?php if ($pengetahuandasarUser['status'] == 'Rejected Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($pengetahuandasarUser['status'] == 'Returned Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['approved_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['approved_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser2['username']; ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (empty($pengetahuandasarUser['approved_at']) || empty($pengetahuandasarUser['penyetuju'])) : ?>
                                            <?php if ($pengetahuandasarUser['status'] == 'Rejected Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($pengetahuandasarUser['status'] == 'Returned Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <span class="h4 font-weight-bold">NA</span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['approved_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['approved_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser2['username']; ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td scope="col" rowspan="4">
                                    <small class="font-weight-bold">Engineer</small>
                                    <br>
                                    <?php if (in_groups('engineer')) : ?>
                                        <?php if (empty($pengetahuandasarUser['checked_at']) || empty($pengetahuandasarUser['engineer'])) : ?>
                                            <?php if ($pengetahuandasarUser['status'] == 'Rejected Engineer') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($pengetahuandasarUser['status'] == 'Returned Engineer') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['checked_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['checked_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser3['username']; ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (empty($pengetahuandasarUser['checked_at']) || empty($pengetahuandasarUser['engineer'])) : ?>
                                            <?php if ($pengetahuandasarUser['status'] == 'Rejected Engineer') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($pengetahuandasarUser['status'] == 'Returned Engineer') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <span class="h4 font-weight-bold">NA</span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['checked_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['checked_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser3['username']; ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>

                                <td scope="col" class=" align-middle"><small class="font-weight-bold" style="width: 10%;">SD/WI No.</small></td>
                                <td scope=" col" class=" align-middle"><small class="font-weight-bold" style="width: 10%;"><?= $pengetahuandasarUser['sd/wi_no']; ?></small></td>
                            </tr>
                            <tr>
                                <td scope=" row" class="align-middle"><small class="font-weight-bold">Tema : <?= $pengetahuandasarUser['tema']; ?></small></td>
                                <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">OPL No.</small></td>
                                <?php if ($pengetahuandasarUser['status'] == 'Created' || $pengetahuandasarUser['status'] == 'Returned Supervisor') : ?>
                                    <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">NA</small></td>
                                <?php else : ?>
                                    <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold"><?= $pengetahuandasarUser['opl_no']; ?></small></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td scope="row">
                                    <small class="font-weight-bold">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" checked disabled>
                                            <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox1"><small><small>Pengetahuan Dasar</small></small></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" disabled>
                                            <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox2"><small><small>Improvement</small></small></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                            <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox3"><small><small>Trouble Shooting</small></small></label>
                                        </div>
                                    </small>

                                </td>
                                <td class="font-weight-bold"><small class="font-weight-bold">Tanggal</small></td>
                                <td class="font-weight-bold"><small class="font-weight-bold"><?= date('d M Y', strtotime($pengetahuandasarUser['updated_at'])); ?></small></td>
                            </tr>
                        </tbody>
                        <?php if ($pengetahuandasarUser['status'] == 'Rejected Supervisor' || $pengetahuandasarUser['status'] == 'Returned Supervisor' || $pengetahuandasarUser['status'] == 'Rejected Engineer' || $pengetahuandasarUser['status'] == 'Returned Engineer') : ?>
                            <tfoot>
                                <tr>
                                    <td scope="col" class="align-middle">
                                        <h6 class="font-weight-bold text-gray-900">Alasan :</h6>
                                    </td>
                                    <td scope="col" colspan="4" class="align-middle border-right-0">
                                        <span class="small font-weight-bold"><?= $pengetahuandasarUser['alasan']; ?></span>
                                    </td>
                                    <td scope="col" colspan="2" class="align-middle border-left-0">
                                        <?php if ($pengetahuandasarUser['status'] == 'Returned Supervisor' || $pengetahuandasarUser['status'] == 'Returned Engineer') : ?>
                                            <a href="/ListPengetahuanDasar/Edit/DetailsUserPengetahuanDasar/<?= $pengetahuandasarUser['id']; ?>" class="cssbuttons-io-button">
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
                            <?php foreach ($foto_pdU as $foto) : ?>
                                <?php if ($foto['foto_pd'] == 'default.jpg') : ?>
                                <?php else : ?>
                                    <div class="col-sm-3 d-flex flex-wrap align-items-center mx-auto d-block ">
                                        <div class="card border-0">
                                            <img class="card-img-top img-fluid rounded p-0 m-0" style="object-fit: contain; height: 250px;" src="/img/<?= $foto['foto_pd'];  ?>" alt="Foto Pengetahuan Dasar">
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
                                    <?php if ($pengetahuandasarUser['mesin'] == '1') : ?>
                                    <?php else : ?>
                                        <tr id="noHover">
                                            <td scope="col" colspan="1"><small class="font-weight-bold">Mesin :</small></td>
                                            <td scope="col" colspan="3"><small class="font-weight-bold"><?= $pengetahuandasarUser['nama_mesin']; ?></small></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr id="noHover">
                                        <td scope="col" style="width: 25%;"><small class="font-weight-bold">Tujuan :</small></td>
                                        <td scope="col"><small class="font-weight-bold">Penjelasan :</small></td>
                                        <td scope="col"><small class="font-weight-bold">Fungsi :</small></td>
                                        <td scope="col" style="width: 25%;"><small class="font-weight-bold">Dampak :</small></td>
                                    </tr>
                                    <tr class="text-left">
                                        <td><?= $pengetahuandasarUser['tujuan']; ?></td>
                                        <td scope="row"><?= $pengetahuandasarUser['penjelasan']; ?></td>
                                        <td><?= $pengetahuandasarUser['fungsi']; ?></td>
                                        <td><?= $pengetahuandasarUser['dampak']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="container">

                    <?php if ($pengetahuandasarUser['realisasi'] == 'TRUE' && $pengetahuandasarUser['pembuat'] == user_id()) : ?>

                        <div class="col-sm-3 mb-5">
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
                            <!-- <button onclick="window.open('<?= base_url('PengetahuanDasar/printpdf/' . $pengetahuandasarUser['id']); ?>', 'blank')" class="download-button">
                                <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line y2="13" x2="8" y1="13" x1="16"></line>
                                        <line y2="17" x2="8" y1="17" x1="16"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg> Download .PDF</div>
                                <div class="download">
                                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line y2="3" x2="12" y1="15" x1="12"></line>
                                    </svg>
                                </div>
                            </button> -->
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
                                    <?php foreach ($realisasiPD as $rpd) : ?>
                                        <tr>
                                            <td class="align-middle" scope="row"><?= $i++; ?></td>
                                            <td class="align-middle" scope="row"><?= date('d M Y', strtotime($rpd['tanggal_training'])); ?></td>
                                            <td class="align-middle" scope="row"><?= $rpd['username']; ?></td>
                                            <td class="align-middle" scope="row"><?= $rpd['paraf_trainee']; ?></td>
                                            <?php if (empty($rpd['id_trainer'])) : ?>
                                                <td class="align-middle" scope="row"></td>
                                                <td class="align-middle" scope="row">
                                                    <form class="d-inline" action="/ListPengetahuanDasar/DetailsUserPengetahuanDasar/ParafTrainer/<?= $pengetahuandasarUser['id']; ?>" method="post">
                                                        <input type="hidden" name="id" id="id" value="<?= $rpd['id']; ?>">
                                                        <button type="submit" class="px-4 btn btn-primary"><i class="fas fa-check"></i></button>
                                                    </form>
                                                    <form class="d-inline" action="/ListPengetahuanDasar/DetailsUserPengetahuanDasar/<?= $pengetahuandasarUser['id']; ?>" method="post">
                                                        <?php csrf_field(); ?>
                                                        <input type="hidden" name="id" id="id" value="<?= $rpd['id']; ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="tombol-hapus px-4 btn btn-danger"><i class="fas fa-times"></i></button>
                                                    </form>
                                                </td>
                                            <?php else : ?>
                                                <td class="align-middle" scope="row"><?= user()->username; ?></td>
                                                <td class="align-middle" scope="row"><?= $rpd['paraf_trainer']; ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td scope="row" colspan="4">Daftar Distribusi</td>
                                        <td scope="row" colspan="4"><?= $pengetahuandasarUser['nama_distribusi']; ?></td>
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
                                <td scope="col" rowspan="4" class="align-middle">
                                    <img src="/img/kalbe.png" width="70" height="30" alt="Logo Kalbe">
                                </td>
                                <td scope="col" class="font-weight-bold align-middle" style="width: 35%;">ONE POINT LESSON (OPL)</td>
                                <td scope="col" rowspan="4">
                                    <small class="font-weight-bold" style="width: 50%;">Dibuat Oleh</small>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['created_at'])); ?></small>
                                    <br>
                                    <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['created_at'])); ?></small>
                                    <br>
                                    <br>
                                    <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser['username']; ?></span>
                                </td>
                                <td scope="col" rowspan="4">
                                    <small class="font-weight-bold">Disetujui Oleh</small>
                                    <br>

                                    <?php if (in_groups('supervisor')) : ?>
                                        <?php if (empty($pengetahuandasarUser['approved_at']) || empty($pengetahuandasarUser['penyetuju'])) : ?>
                                            <?php if ($pengetahuandasarUser['status'] == 'Rejected Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($pengetahuandasarUser['status'] == 'Returned Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['approved_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['approved_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser2['username']; ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (empty($pengetahuandasarUser['approved_at']) || empty($pengetahuandasarUser['penyetuju'])) : ?>
                                            <?php if ($pengetahuandasarUser['status'] == 'Rejected Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($pengetahuandasarUser['status'] == 'Returned Supervisor') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <span class="h4 font-weight-bold">NA</span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['approved_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['approved_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser2['username']; ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td scope="col" rowspan="4">
                                    <small class="font-weight-bold">Engineer</small>
                                    <br>
                                    <?php if (in_groups('engineer')) : ?>
                                        <?php if (empty($pengetahuandasarUser['checked_at']) || empty($pengetahuandasarUser['engineer'])) : ?>
                                            <?php if ($pengetahuandasarUser['status'] == 'Rejected Engineer') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($pengetahuandasarUser['status'] == 'Returned Engineer') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['checked_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['checked_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser3['username']; ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (empty($pengetahuandasarUser['checked_at']) || empty($pengetahuandasarUser['engineer'])) : ?>
                                            <?php if ($pengetahuandasarUser['status'] == 'Rejected Engineer') : ?>
                                                <br>
                                                <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                            <?php elseif ($pengetahuandasarUser['status'] == 'Returned Engineer') : ?>
                                                <br>
                                                <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <span class="h4 font-weight-bold">NA</span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasarUser['checked_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasarUser['checked_at'])); ?></small>
                                            <br>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $pengetahuandasarUser3['username']; ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>

                                <td scope="col" class=" align-middle"><small class="font-weight-bold" style="width: 10%;">SD/WI No.</small></td>
                                <td scope=" col" class=" align-middle"><small class="font-weight-bold" style="width: 10%;"><?= $pengetahuandasarUser['sd/wi_no']; ?></small></td>
                            </tr>
                            <tr>
                                <td scope=" row" class="align-middle"><small class="font-weight-bold">Tema : <?= $pengetahuandasarUser['tema']; ?></small></td>
                                <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">OPL No.</small></td>
                                <?php if ($pengetahuandasarUser['status'] == 'Created' || $pengetahuandasarUser['status'] == 'Returned Supervisor') : ?>
                                    <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">NA</small></td>
                                <?php else : ?>
                                    <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold"><?= $pengetahuandasarUser['opl_no']; ?></small></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td scope="row">
                                    <small class="font-weight-bold">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" checked disabled>
                                            <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox1"><small><small>Pengetahuan Dasar</small></small></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" disabled>
                                            <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox2"><small><small>Improvement</small></small></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                            <label class="form-check-label font-weight-bold text-gray-900" for="inlineCheckbox3"><small><small>Trouble Shooting</small></small></label>
                                        </div>
                                    </small>

                                </td>
                                <td class="font-weight-bold"><small class="font-weight-bold">Tanggal</small></td>
                                <td class="font-weight-bold"><small class="font-weight-bold"><?= date('d M Y', strtotime($pengetahuandasarUser['updated_at'])); ?></small></td>
                            </tr>
                        </tbody>
                        <?php if ($pengetahuandasarUser['status'] == 'Rejected Supervisor' || $pengetahuandasarUser['status'] == 'Returned Supervisor' || $pengetahuandasarUser['status'] == 'Rejected Engineer' || $pengetahuandasarUser['status'] == 'Returned Engineer') : ?>
                            <tfoot>
                                <tr>
                                    <td scope="col" class="align-middle">
                                        <h6 class="font-weight-bold text-gray-900">Alasan :</h6>
                                    </td>
                                    <td scope="col" colspan="4" class="align-middle border-right-0">
                                        <span class="small font-weight-bold"><?= $pengetahuandasarUser['alasan']; ?></span>
                                    </td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                    <div class="container mt-5">
                        <div class="row">
                            <?php $x = 1; ?>
                            <?php foreach ($foto_pdU as $foto) : ?>
                                <?php if ($foto['foto_pd'] == 'default.jpg') : ?>
                                <?php else : ?>
                                    <div class="col-sm-3 d-flex flex-wrap align-items-center mx-auto d-block ">
                                        <div class="card border-0">
                                            <img class="card-img-top img-fluid rounded p-0 m-0" style="object-fit: contain; height: 250px;" src="/img/<?= $foto['foto_pd'];  ?>" alt="Foto Pengetahuan Dasar">
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
                                    <?php if ($pengetahuandasarUser['mesin'] == '1') : ?>
                                    <?php else : ?>
                                        <tr id="noHover">
                                            <td scope="col" colspan="1"><small class="font-weight-bold">Mesin :</small></td>
                                            <td scope="col" colspan="3"><small class="font-weight-bold"><?= $pengetahuandasarUser['nama_mesin']; ?></small></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr id="noHover">
                                        <td scope="col" style="width: 25%;"><small class="font-weight-bold">Tujuan :</small></td>
                                        <td scope="col"><small class="font-weight-bold">Penjelasan :</small></td>
                                        <td scope="col"><small class="font-weight-bold">Fungsi :</small></td>
                                        <td scope="col" style="width: 25%;"><small class="font-weight-bold">Dampak :</small></td>
                                    </tr>
                                    <tr class="text-left">
                                        <td><?= $pengetahuandasarUser['tujuan']; ?></td>
                                        <td scope="row"><?= $pengetahuandasarUser['penjelasan']; ?></td>
                                        <td><?= $pengetahuandasarUser['fungsi']; ?></td>
                                        <td><?= $pengetahuandasarUser['dampak']; ?></td>
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
                                <?php foreach ($realisasiPD as $rpd) : ?>
                                    <tr>
                                        <td class="align-middle" scope="row"><?= $i++; ?></td>
                                        <td class="align-middle" scope="row"><?= date('d M Y', strtotime($rpd['tanggal_training'])); ?></td>
                                        <td class="align-middle" scope="row"><?= $rpd['username']; ?></td>
                                        <td class="align-middle" scope="row"><?= $rpd['paraf_trainee']; ?></td>
                                        <td class="align-middle" scope="row"></td>
                                        <td class="align-middle" scope="row"><?= $rpd['paraf_trainer']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td scope="row" colspan="4">Daftar Distribusi</td>
                                    <td scope="row" colspan="4"><?= $pengetahuandasarUser['nama_distribusi']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
                </div>
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