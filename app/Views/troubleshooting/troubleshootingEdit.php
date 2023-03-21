<?php if (in_groups('user') && $troubleshooting['pembuat'] == user_id()) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">

        <?php if (empty($inputFotoTS)) : ?>
            <?php $jumlahFoto = $countFotoTS + $inputFotoTS; ?>
        <?php else : ?>
            <?php $jumlahFoto = $countFotoTS + $inputFotoTS - $countFotoTS; ?>
        <?php endif; ?>

        <div class="card p-5">

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/ListTroubleShooting/DetailsUserTroubleShooting/' . $troubleshooting['id']); ?>" type="button" class="btn btn-outline-primary mb-5"><i class="fas fa-chevron-circle-left"></i>&nbsp; Back to Detail</a>
                <h4 class="text-gray-900">Update Returned <span class="font-weight-bold">One Point Lesson</span></h4>
            </div>

            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="" method="get">
                <?php csrf_field(); ?>

                <div class="form-group row">
                    <div class="form-row col-sm-12 px-0">
                        <div class="form-group col-sm-3">
                            <label for="jumlahFoto" class="align-middle mt-2 text-gray-900 font-weight-bold">Jumlah Foto OPL</label>
                        </div>
                        <div class="form-group col-sm-5">
                            <input type="number" disabled min="<?= $countFotoTS; ?>" max="15" autofocus class="form-control rounded-sm" id="jumlahFoto" name="jumlahFoto" placeholder="Masukan Jumlah Foto OPL Yang Diperlukan" value="<?= $jumlahFoto; ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" disabled value="gambar" name="submit" class="rounded-circle px-0 ml-4 form-control btn btn-success"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Form Input -->
            <form action="/ListTroubleShooting/UpdateTroubleShooting/<?= $troubleshooting['id']; ?>" method="post" enctype="multipart/form-data">
                <?php csrf_field(); ?>

                <?php $i = 1; ?>
                <?php foreach ($fotoTS as $FTS) : ?>
                    <div id="inputImage">
                        <div class="media mb-4">
                            <div class="d-block my-auto col-sm-3 border-0" id="row">
                                <img src="/img/<?= $FTS['foto_ts']; ?>" id="img" class="img-thumbnail col-sm-12 p-0 sebelum-preview<?= $i; ?> rounded" alt="Gambar Pengetahuan Dasar">
                            </div>
                            <div class="media-body mx-3">
                                <div class="d-flex justify-content-between">
                                    <h5 class="text-gray-900 font-weight-bold align-middle my-3">Gambar <?= $i; ?></h5>
                                    <div class="custom-file col-sm-10 my-2">
                                        <input type="file" accept="image/*" class="custom-file-input" id="foto_sebelum<?= $i; ?>" name="foto_sebelum<?= $i; ?>" value="<?= $FTS['foto_ts']; ?>" onchange="preview_sebelum<?= $i; ?>()">
                                        <label class="custom-file-label" id="label_sebelum<?= $i; ?>" name="label_sebelum<?= $i; ?>" for="foto_sebelum<?= $i; ?>"><?= $FTS['foto_ts']; ?></label>
                                    </div>
                                    <input type="hidden" value="<?= $FTS['foto_ts']; ?>" name="fotoLama<?= $i; ?>">
                                    <input type="hidden" value="<?= $FTS['id']; ?>" name="fotoID<?= $i; ?>">
                                </div>
                                <textarea class="form-control mt-2 rounded bg-light" rows="6" id="ket_foto<?= $i; ?>" placeholder="Keterangan Foto <?= $i; ?>" name="ket_foto<?= $i; ?>" value="<?= old('ket_foto'); ?>"><?= $FTS['keterangan']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>

                <div class="form-group mb-5">
                    <label for="tema" class=" text-gray-900 font-weight-bold">Tema</label>
                    <input type="text" class="form-control rounded-sm <?php if (session('validation.tema')) : ?>is-invalid<?php endif ?>" id="tema" name="tema" placeholder="Tema One Point Lesson" autofocus value="<?= $troubleshooting['tema']; ?>">
                    <div class="invalid-feedback">
                        <?= session('validation.tema') ?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="jumlahFileFoto" name="jumlahFileFoto" value="<?= $jumlahFoto; ?>">
                </div>
                <div class="form-group mb-5">
                    <input type="hidden" class="form-control" id="status" name="status" value="<?= $troubleshooting['status']; ?>">
                </div>
                <div class="form-group mb-5">
                    <input type="hidden" class="form-control" id="revisi" name="revisi" value="<?= $troubleshooting['revisi'] + 1; ?>">
                </div>
                <div class="form-group mb-5">
                    <label for="tujuan" class="text-gray-900 font-weight-bold">Tujuan</label>
                    <textarea class="<?php if (session('validation.tujuan')) : ?>is-invalid<?php endif ?> form-control rounded" rows="5" id="tujuan" placeholder="Keterangan Tujuan" name="tujuan" value="<?= $troubleshooting['tujuan']; ?>"><?= $troubleshooting['tujuan']; ?></textarea>
                    <div class="invalid-feedback">
                        <?= session('validation.tujuan') ?>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="fungsi" class="text-gray-900 font-weight-bold">Fungsi</label>
                    <textarea class="<?php if (session('validation.fungsi')) : ?>is-invalid<?php endif ?> form-control rounded" rows="5" id="fungsi" placeholder="Keterangan Fungsi" name="fungsi" value="<?= $troubleshooting['fungsi']; ?>"><?= $troubleshooting['fungsi']; ?></textarea>
                    <div class="invalid-feedback">
                        <?= session('validation.fungsi') ?>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="penjelasan" class="text-gray-900 font-weight-bold">Prosedur / Penjelasan</label>
                    <textarea class="<?php if (session('validation.penjelasan')) : ?>is-invalid<?php endif ?> form-control rounded" rows="5" id="penjelasan" placeholder="Keterangan Prosedur / Penjelasan" name="penjelasan" value="<?= $troubleshooting['penjelasan']; ?>"><?= $troubleshooting['penjelasan']; ?></textarea>
                    <div class="invalid-feedback">
                        <?= session('validation.penjelasan') ?>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="dampak" class="text-gray-900 font-weight-bold">Dampak Bila Tidak Dilakukan</label>
                    <textarea class="<?php if (session('validation.dampak')) : ?>is-invalid<?php endif ?> form-control rounded" rows="5" id="dampak" placeholder="Keterangan Dampak Bila Tidak Dilakukan" name="dampak" value="<?= $troubleshooting['dampak']; ?>"><?= $troubleshooting['dampak']; ?></textarea>
                    <div class="invalid-feedback">
                        <?= session('validation.dampak') ?>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="sdwi" class=" text-gray-900 font-weight-bold">SD/WI No. (optional)</label>
                    <input type="text" class="form-control rounded-sm" id="sdwi" name="sdwi" placeholder="Masukan Nomor SD/WI" value="<?= $troubleshooting['sd/wi_no']; ?>" autofocus>
                </div>
                <div class="form-group mb-5">
                    <label for="mesin" class=" text-gray-900 font-weight-bold">Daftar Mesin</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="mesin">Options</label>
                        </div>
                        <select class="custom-select" required id="mesin" name="mesin">
                            <option value="1">NA - (Non Mesin)</option>
                            <?php foreach ($mesin as $m) : ?>
                                <option value="<?= $m['id'];  ?>" <?= $troubleshooting['mesin'] == $m['id'] ? 'selected' : null; ?>>
                                    <?= $m['nama_mesin'];  ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="department" class=" text-gray-900 font-weight-bold">Daftar Department</label>
                    <!-- <input type="number" class="form-control" id="distribusi" name="distribusi" placeholder="distribusi One Point Lesson"> -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="department">Options</label>
                        </div>
                        <select class="<?php if (session('validation.department')) : ?>is-invalid<?php endif ?> custom-select" id="department" name="department">
                            <option selected disabled hidden>Choose...</option>
                            <?php foreach ($distribusi as $d) : ?>
                                <option value="<?= $d['id'];  ?>" <?= $troubleshooting['id_distribusi'] == $d['id'] ? 'selected' : null; ?>><?= $d['nama_distribusi'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('validation.department') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-row justify-content-end">
                        <button class="btn btn-success px-sm-4" type="submit">Send &nbsp;&nbsp;<i class="fas fa-paper-plane"></i></button>
                        <button class="btn btn-outline-dark px-sm-4" type="reset">Reset &nbsp;&nbsp;<i class="fas fa-sync"></i>
                            <!-- <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/nxooksci.json" trigger="hover" colors="primary:#242424" style="width:20px;height:20px" class="align-midlle">
                        </lord-icon> -->
                        </button>
                    </div>
                </div>
            </form>
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