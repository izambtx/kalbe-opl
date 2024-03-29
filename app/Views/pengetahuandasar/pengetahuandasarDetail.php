<?php if ($pengetahuandasar['id_distribusi'] == user()->distribusi && in_groups('supervisor') || in_groups('engineer')) : ?>

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
                            <td scope="col" rowspan="4" class="align-middle">
                                <img src="/img/kalbe.png" width="70" height="30" alt="">
                            </td>
                            <td scope="col" class="font-weight-bold align-middle" style="width: 35%;">ONE POINT LESSON (OPL)</td>
                            <td scope="col" rowspan="4">
                                <small class="font-weight-bold" style="width: 50%;">Dibuat Oleh</small>
                                <br>
                                <br>
                                <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasar['created_at'])); ?></small>
                                <br>
                                <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasar['created_at'])); ?></small>
                                <br>
                                <br>
                                <span class="font-weight-bold text-gray-900"><?= $pengetahuandasar['username']; ?></span>
                            </td>
                            <td scope="col" rowspan="4">
                                <small class="font-weight-bold">Disetujui Oleh</small>
                                <br>

                                <?php if (in_groups('supervisor')) : ?>
                                    <?php if (empty($pengetahuandasar['penyetuju'])) : ?>
                                        <?php if ($pengetahuandasar['status'] == 'Rejected Supervisor') : ?>
                                            <br>
                                            <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                        <?php elseif ($pengetahuandasar['status'] == 'Returned Supervisor') : ?>
                                            <br>
                                            <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                        <?php else : ?>
                                            <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                            <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasar['approved_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasar['approved_at'])); ?></small>
                                        <br>
                                        <br>
                                        <span class="font-weight-bold text-gray-900"><?= $pengetahuandasar2['username']; ?></span>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (empty($pengetahuandasar['penyetuju'])) : ?>
                                        <br>
                                        <br>
                                        <span class="h4 font-weight-bold">NA</span>
                                    <?php else : ?>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasar['approved_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasar['approved_at'])); ?></small>
                                        <br>
                                        <br>
                                        <span class="font-weight-bold text-gray-900"><?= $pengetahuandasar2['username']; ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td scope="col" rowspan="4">
                                <small class="font-weight-bold">Engineer</small>
                                <br>
                                <?php if (in_groups('engineer')) : ?>
                                    <?php if (empty($pengetahuandasar['checked_at']) || empty($pengetahuandasar['engineer'])) : ?>
                                        <?php if ($pengetahuandasar['status'] == 'Rejected Engineer') : ?>
                                            <br>
                                            <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                        <?php elseif ($pengetahuandasar['status'] == 'Returned Engineer') : ?>
                                            <br>
                                            <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                        <?php elseif ($pengetahuandasar['id_distribusi'] != 1) : ?>
                                            <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                            <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                        <?php elseif (in_groups('engineer') && $pengetahuandasar['id_distribusi'] == 1 && empty($pengetahuandasar['checked_at']) || empty($pengetahuandasar['engineer'])) : ?>
                                            <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                            <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                        <?php else : ?>
                                            <br>
                                            <br>
                                            <span class="h4 font-weight-bold">NA</span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasar['checked_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasar['checked_at'])); ?></small>
                                        <br>
                                        <br>
                                        <span class="font-weight-bold text-gray-900"><?= $pengetahuandasar3['username']; ?></span>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (empty($pengetahuandasar['checked_at']) || empty($pengetahuandasar['engineer'])) : ?>
                                        <br>
                                        <br>
                                        <span class="h4 font-weight-bold"><?= $pengetahuandasar['engineer']; ?></span>
                                    <?php else : ?>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('d M Y', strtotime($pengetahuandasar['checked_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-primary"><?= date('H : i : s', strtotime($pengetahuandasar['checked_at'])); ?></small>
                                        <br>
                                        <br>
                                        <span class="font-weight-bold text-gray-900"><?= $pengetahuandasar3['username']; ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                            <td scope="col" class=" align-middle"><small class="font-weight-bold" style="width: 10%;">SD/WI No.</small></td>
                            <td scope=" col" class=" align-middle"><small class="font-weight-bold" style="width: 10%;"><?= $pengetahuandasar['sd/wi_no']; ?></small></td>
                        </tr>
                        <tr>
                            <td scope=" row" class="align-middle"><small class="font-weight-bold">Tema : <?= $pengetahuandasar['tema']; ?></small></td>
                            <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">OPL No.</small></td>
                            <?php if ($pengetahuandasar['status'] == 'Created' || $pengetahuandasar['status'] == 'Updated' || $pengetahuandasar['status'] == 'Returned Supervisor' || $pengetahuandasar['status'] == 'Updated') : ?>
                                <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold">NA</small></td>
                            <?php else : ?>
                                <td class="font-weight-bold align-middle" style="width: 10%;"><small class="font-weight-bold"><?= $pengetahuandasar['opl_no']; ?></small></td>
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
                            <td class="font-weight-bold"><small class="font-weight-bold"><?= date('d M Y', strtotime($pengetahuandasar['updated_at'])); ?></small></td>
                        </tr>
                    </tbody>
                    <?php if ($pengetahuandasar['status'] == 'Rejected Supervisor' || $pengetahuandasar['status'] == 'Returned Supervisor' || $pengetahuandasar['status'] == 'Rejected Engineer' || $pengetahuandasar['status'] == 'Returned Engineer') : ?>
                        <tfoot>
                            <tr>
                                <td scope="col" class="align-middle">
                                    <h6 class="font-weight-bold text-gray-900">Alasan :</h6>
                                </td>
                                <td scope="col" colspan="6" class="align-middle">
                                    <span class="small font-weight-bold"><?= $pengetahuandasar['alasan']; ?></span>
                                </td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>

                <div class="container my-5">
                    <div class="row">
                        <?php $x = 1; ?>
                        <?php foreach ($foto_pd as $foto) : ?>
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
                                <?php if ($pengetahuandasar['mesin'] == '1') : ?>
                                <?php else : ?>
                                    <tr id="noHover">
                                        <td scope="col" colspan="1"><small class="font-weight-bold">Mesin :</small></td>
                                        <td scope="col" colspan="3"><small class="font-weight-bold"><?= $pengetahuandasar['nama_mesin']; ?></small></td>
                                    </tr>
                                <?php endif; ?>
                                <tr id="noHover">
                                    <td scope="col" style="width: 25%;"><small class="font-weight-bold">Tujuan :</small></td>
                                    <td scope="col"><small class="font-weight-bold">Penjelasan :</small></td>
                                    <td scope="col"><small class="font-weight-bold">Fungsi :</small></td>
                                    <td scope="col" style="width: 25%;"><small class="font-weight-bold">Dampak :</small></td>
                                </tr>
                                <tr class="text-left">
                                    <td><?= $pengetahuandasar['tujuan']; ?></td>
                                    <td scope="row"><?= $pengetahuandasar['penjelasan']; ?></td>
                                    <td><?= $pengetahuandasar['fungsi']; ?></td>
                                    <td><?= $pengetahuandasar['dampak']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container">

                    <?php if ($pengetahuandasar['realisasi'] == 'TRUE' && $pengetahuandasar['pembuat'] == user_id()) : ?>
                        <div class="row p-3">
                            <table class="table table-hover table-bordered text-gray-900">
                                <tbody>
                                    <tr class="bg-success" id="noHover">
                                        <td scope="col" colspan="6" class="align-middle">Realisasi</td>
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
                                    <tr>
                                        <td scope="row">1</td>
                                        <td>1/26/2023</td>
                                        <td>Otto</td>
                                        <td>1/26/2023</td>
                                        <td>Mark</td>
                                        <td>1/26/2023</td>
                                    </tr>
                                    <tr>
                                        <td scope="row" colspan="4">Daftar Distribusi</td>
                                        <td scope="row" colspan="4"><?= $pengetahuandasar['nama_distribusi']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <ul class="d-flex justify-content-center" id="ul">
                            <li class="disabled" id="li"><a href="" id="a"><i class="fas fa-backward"></i></a></li>
                            <li id="li"><a href="" id="a" class="aktif"> 1 </a></li>
                            <li id="li"><a href="" id="a"> 2 </a></li>
                            <li id="li"><a href="" id="a"> 3 </a></li>
                            <li id="li"><a href="" id="a"> <i class="fas fa-forward"></i> </a></li>
                        </ul>
                    <?php endif; ?>
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
                        <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                        <?php if (in_groups('supervisor')) : ?>
                            <form action="/PengetahuanDasar/returnSupervisor/<?= $pengetahuandasar['id']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group row mb-0 mt-5">
                                    <label for="alasanreturn" class="col-sm-4 col-form-label">Reason Return </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" required id="alasanreturn" name="alasanreturn"></textarea>
                                        <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglreturn" name="tglreturn"></input>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="returnopl" class="col-sm-4 col-form-label">Returned By </label>
                                    <div class="col-sm-8">
                                        <input type="hidden" value="<?= user()->id; ?>" id="returnopl" name="returnopl"></input>
                                        <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary px-4 mx-2 mt-5" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning px-4 mx-2 mt-5">Return</button>
                                </div>
                            </form>

                        <?php elseif (in_groups('engineer')) : ?>
                            <form action="/PengetahuanDasar/returnEngineer/<?= $pengetahuandasar['id']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group row mb-0 mt-5">
                                    <label for="alasanreturn" class="col-sm-4 col-form-label">Reason Return </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" required id="alasanreturn" name="alasanreturn"></textarea>
                                        <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglreturn" name="tglreturn"></input>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="returnopl" class="col-sm-4 col-form-label">Returned By </label>
                                    <div class="col-sm-8">
                                        <input type="hidden" value="<?= user()->id; ?>" id="returnopl" name="returnopl"></input>
                                        <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary px-4 mx-2 mt-5" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning px-4 mx-2 mt-5">Return</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
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
                        <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                        <?php if (in_groups('supervisor')) : ?>
                            <form action="/PengetahuanDasar/rejectSupervisor/<?= $pengetahuandasar['id']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group row mb-0 mt-5">
                                    <label for="alasanreject" class="col-sm-4 col-form-label">Reason Reject </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" required id="alasanreject" name="alasanreject"></textarea>
                                        <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglreject" name="tglreject"></input>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="rejectopl" class="col-sm-4 col-form-label">Rejected By </label>
                                    <div class="col-sm-8">
                                        <input type="hidden" value="<?= user()->id; ?>" id="rejectopl" name="rejectopl"></input>
                                        <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary px-4 mx-2 mt-5" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger px-4 mx-2 mt-5">Reject</button>
                                </div>
                            </form>

                        <?php elseif (in_groups('engineer')) : ?>
                            <form action="/PengetahuanDasar/rejectEngineer/<?= $pengetahuandasar['id']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group row mb-0 mt-5">
                                    <label for="alasanreject" class="col-sm-4 col-form-label">Reason Reject </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" required id="alasanreject" name="alasanreject"></textarea>
                                        <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglreject" name="tglreject"></input>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="rejectopl" class="col-sm-4 col-form-label">Rejected By </label>
                                    <div class="col-sm-8">
                                        <input type="hidden" value="<?= user()->id; ?>" id="rejectopl" name="rejectopl"></input>
                                        <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary px-4 mx-2 mt-5" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger px-4 mx-2 mt-5">Reject</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
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
                            <form action="/PengetahuanDasar/approve/<?= $pengetahuandasar['id']; ?>" method="post">
                                <?= csrf_field();  ?>
                                <div class="form-group row mb-0 mt-5">
                                    <label for="temaopl" class="col-sm-3 col-form-label">Tema OPL </label>
                                    <div class="col-sm-9">
                                        <textarea readonly rows="4" id="temaopl" name="temaopl" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= $pengetahuandasar['tema']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="noopl" class="col-sm-3 col-form-label">OPL No. </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="noopl" name="noopl" readonly value="OPL1-<?= $pengetahuandasar['singkatan']; ?>.<?= $pengetahuandasar['opl_no']; ?>.<?= $pengetahuandasar['revisi']; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="approveopl" class="col-sm-3 col-form-label">Approver </label>
                                    <div class="col-sm-9">
                                        <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                        <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="sdwi" class="col-sm-3 col-form-label">SD/WI No. </label>
                                    <div class="col-sm-9">
                                        <?php if (empty($pengetahuandasar['sd/wi_no'])) : ?>
                                            <input type="text" id="sdwi" name="sdwi" class="form-control rounded-sm" placeholder="Masukan SD/WI No. Jika Ada"></input>
                                        <?php else : ?>
                                            <input type="text" id="sdwi" name="sdwi" readonly class="form-control font-weight-bold text-gray-900 border-0 bg-white" value="<?= $pengetahuandasar['sd/wi_no']; ?>"></input>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if ($pengetahuandasar['mesin'] == '1') : ?>
                                    <input type="hidden" class="border-0 d-block" value="TRUE" id="statusrealisasi" name="statusrealisasi">
                                <?php else : ?>
                                    <?php if ($pengetahuandasar['id_distribusi'] == '1') : ?>
                                        <input type="hidden" class="border-0 d-block" value="TRUE" id="statusrealisasi" name="statusrealisasi">
                                    <?php else : ?>
                                        <input type="hidden" class="border-0 d-block" value="FALSE" id="statusrealisasi" name="statusrealisasi">
                                    <?php endif; ?>
                                <?php endif; ?>
                                <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglapprove" name="tglapprove"></input>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary px-4 mx-2 mt-5" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                                </div>
                            </form>

                        <?php elseif (in_groups('engineer')) : ?>
                            <form action="/PengetahuanDasar/check/<?= $pengetahuandasar['id']; ?>" method="post">
                                <?= csrf_field();  ?>
                                <div class="form-group row mb-0 mt-5">
                                    <label for="temaopl" class="col-sm-3 col-form-label">Tema OPL </label>
                                    <div class="col-sm-9">
                                        <textarea readonly rows="4" id="temaopl" name="temaopl" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= $pengetahuandasar['tema']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="mesin" class="col-sm-3 col-form-label">Mesin </label>
                                    <div class="col-sm-9">
                                        <p id="mesin" name="mesin" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= $pengetahuandasar['nama_mesin']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="noopl" class="col-sm-3 col-form-label">OPL No. </label>
                                    <div class="col-sm-9">
                                        <?php if ($pengetahuandasar['approved_at'] || $pengetahuandasar['penyetuju']) : ?>
                                            <input type="text" id="noopl" name="noopl" readonly value="<?= $pengetahuandasar['opl_no']; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                        <?php else : ?>
                                            <input type="text" id="noopl" name="noopl" readonly value="OPL1-<?= $pengetahuandasar['singkatan']; ?>.<?= $pengetahuandasar['opl_no']; ?>.<?= $pengetahuandasar['revisi']; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="approveopl" class="col-sm-3 col-form-label">Approver </label>
                                    <div class="col-sm-9">
                                        <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                        <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                    </div>
                                </div>
                                <input type="hidden" class="border-0 d-block" value="TRUE" id="statusrealisasi" name="statusrealisasi">
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