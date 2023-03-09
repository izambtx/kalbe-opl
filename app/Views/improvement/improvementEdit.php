<?php if (in_groups('user') && $improvement['pembuat'] == user_id()) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">

        <?php if (empty($inputFotoIM)) : ?>
            <?php $jumlahFoto = $countFotoIM + $inputFotoIM; ?>
        <?php else : ?>
            <?php $jumlahFoto = $countFotoIM + $inputFotoIM - $countFotoIM; ?>
        <?php endif; ?>

        <div class="card p-5">

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/ListImprovement/Status/' . user()->id); ?>" type="button" class="btn btn-outline-primary mb-5"><i class="fas fa-chevron-circle-left"></i>&nbsp; Back to List</a>
                <h4 class="text-gray-900">Update Returned <span class="font-weight-bold">One Point Lesson</span></h4>
            </div>

            <form action="" method="get">
                <?php csrf_field(); ?>

                <div class="form-group row">
                    <div class="form-row col-sm-12 px-0">
                        <div class="form-group col-sm-3">
                            <label for="jumlahFoto" class="align-middle mt-2 text-gray-900 font-weight-bold">Jumlah Foto OPL</label>
                        </div>
                        <div class="form-group col-sm-5">
                            <input type="number" disabled min="<?= $countFotoIM; ?>" max="15" autofocus class="form-control rounded-sm <?= ($validation->hasError('jumlahFoto')) ? 'is-invalid' : ''; ?>" id="jumlahFoto" name="jumlahFoto" placeholder="Masukan Jumlah Foto OPL Yang Diperlukan" value="<?= $jumlahFoto; ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" disabled value="gambar" name="submit" class="rounded-circle px-0 ml-4 form-control btn btn-success"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Form Input -->
            <form action="/ListImprovement/UpdateImprovement/<?= $improvement['id']; ?>" method="post" enctype="multipart/form-data">
                <?php csrf_field(); ?>

                <?php $i = 1; ?>
                <?php foreach ($fotoIM as $FIM) : ?>
                    <div id="inputImage">
                        <div class="media mb-4">
                            <div class="d-block my-auto col-sm-3 border-0" id="row">
                                <img src="/img/<?= $FIM['foto_im']; ?>" id="img" class="img-thumbnail col-sm-12 p-0 sebelum-preview<?= $i; ?> rounded" alt="Gambar Pengetahuan Dasar">
                            </div>
                            <div class="media-body mx-3">
                                <div class="d-flex justify-content-between">
                                    <h5 class="text-gray-900 font-weight-bold align-middle my-3">Gambar <?= $i; ?></h5>
                                    <div class="custom-file col-sm-10 my-2">
                                        <input type="file" accept="image/*" class="custom-file-input <?= ($validation->hasError('foto_sebelum')) ? 'is-invalid' : ''; ?>" id="foto_sebelum<?= $i; ?>" name="foto_sebelum<?= $i; ?>" value="<?= old('foto_sebelum'); ?>" onchange="preview_sebelum<?= $i; ?>()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('foto_sebelum'); ?>
                                        </div>
                                        <label class="custom-file-label" id="label_sebelum<?= $i; ?>" name="label_sebelum<?= $i; ?>" for="foto_sebelum<?= $i; ?>"><?= $FIM['foto_im']; ?></label>
                                    </div>
                                    <input type="hidden" value="<?= $FIM['foto_im']; ?>" name="fotoLama<?= $i; ?>">
                                    <input type="hidden" value="<?= $FIM['id']; ?>" name="fotoID<?= $i; ?>">
                                </div>
                                <textarea class="form-control mt-2 rounded bg-light" rows="6" id="ket_foto<?= $i; ?>" placeholder="Keterangan Foto <?= $i; ?>" name="ket_foto<?= $i; ?>" value="<?= old('ket_foto'); ?>"><?= $FIM['keterangan']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>

                <?php if (!empty(session()->getFlashdata('validation'))) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Invalid Input Data Detected! :</strong>
                        <br>
                        <?= session()->getFlashdata('validation'); ?>
                    </div>
                <?php endif; ?>

                <div class="form-group mb-5">
                    <label for="tema" class=" text-gray-900 font-weight-bold">Tema</label>
                    <input type="text" required class="form-control rounded-sm <?= ($validation->hasError('tema')) ? 'is-invalid' : ''; ?>" id="tema" name="tema" placeholder="Tema One Point Lesson" autofocus value="<?= $improvement['tema']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tema'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="jumlahFileFoto" name="jumlahFileFoto" value="<?= $jumlahFoto; ?>">
                </div>
                <div class="form-group mb-5">
                    <input type="hidden" class="form-control" id="status" name="status" value="<?= $improvement['status']; ?>">
                </div>
                <div class="form-group mb-5">
                    <input type="hidden" class="form-control" id="revisi" name="revisi" value="<?= $improvement['revisi'] + 1; ?>">
                </div>
                <div class="form-group mb-5">
                    <label for="tujuan" class=" text-gray-900 font-weight-bold">Tujuan</label>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tujuan'); ?>
                    </div>
                    <textarea class="form-control rounded" required rows="5" id="tujuan" placeholder="Keterangan Tujuan" name="tujuan" value="<?= $improvement['tujuan']; ?>"><?= $improvement['tujuan']; ?></textarea>
                </div>
                <div class="form-group mb-5">
                    <label for="fungsi" class=" text-gray-900 font-weight-bold">Fungsi</label>
                    <div class="invalid-feedback">
                        <?= $validation->getError('fungsi'); ?>
                    </div>
                    <textarea class="form-control rounded" required rows="5" id="fungsi" placeholder="Keterangan Fungsi" name="fungsi" value="<?= $improvement['fungsi']; ?>"><?= $improvement['fungsi']; ?></textarea>
                </div>
                <div class="form-group mb-5">
                    <label for="penjelasan" class=" text-gray-900 font-weight-bold">Prosedur / Penjelasan</label>
                    <div class="invalid-feedback">
                        <?= $validation->getError('penjelasan'); ?>
                    </div>
                    <textarea class="form-control rounded" required rows="5" id="penjelasan" placeholder="Keterangan Prosedur / Penjelasan" name="penjelasan" value="<?= $improvement['penjelasan']; ?>"><?= $improvement['penjelasan']; ?></textarea>
                </div>
                <div class="form-group mb-5">
                    <label for="dampak" class=" text-gray-900 font-weight-bold">Dampak Bila Tidak Dilakukan</label>
                    <div class="invalid-feedback">
                        <?= $validation->getError('dampak'); ?>
                    </div>
                    <textarea class="form-control rounded" required rows="5" id="dampak" placeholder="Keterangan Dampak Bila Tidak Dilakukan" name="dampak" value="<?= $improvement['dampak']; ?>"><?= $improvement['dampak']; ?></textarea>
                </div>
                <div class="form-group mb-5">
                    <!-- <div class="form-check">
                    <input class="form-check-input cekbox ml-1" type="checkbox" name="mesin" id="mesin" value="Mesin">
                    <label class="form-check-label text-gray-900 align-middle font-weight-bold mt-1 mb-4 ml-5 pl-4" for="mesin">Berkaitan dengan mesin (click jika benar)</label>
                </div> -->
                    <label for="mesin" class=" text-gray-900 font-weight-bold">Daftar Mesin</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="mesin">Options</label>
                        </div>
                        <select class="custom-select" required id="mesin" name="mesin">
                            <option value="1">NA - (Non Mesin)</option>
                            <?php foreach ($mesin as $m) : ?>
                                <option value="<?= $m['id'];  ?>" <?= $improvement['mesin'] == $m['id'] ? 'selected' : null; ?>>
                                    <?= $m['nama_mesin'];  ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="distribusi" class=" text-gray-900 font-weight-bold">Daftar Distribusi</label>
                    <!-- <input type="number" class="form-control" id="distribusi" name="distribusi" placeholder="distribusi One Point Lesson"> -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="distribusi">Options</label>
                        </div>
                        <select class="custom-select" required id="distribusi" name="distribusi">
                            <option selected disabled hidden>Choose...</option>
                            <?php foreach ($distribusi as $d) : ?>
                                <option value="<?= $d['id'];  ?>" <?= $improvement['id_distribusi'] == $d['id'] ? 'selected' : null; ?>><?= $d['nama_distribusi'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- <div class="mb-3 border rounded p-3">
                    <?php foreach ($distribusi as $d) : ?>
                        <div class="">
                            <label>
                                <input type="radio" id="distribusi" name="distribusi" value="<?= $d['id'];  ?>">
                                <?= $d['nama_distribusi'];  ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div> -->
                </div>
                <div class="form-group row mt-5">
                    <div class="col-row justify-content-end">
                        <button class="btn btn-success px-sm-5" type="submit">Send &nbsp;&nbsp;<i class="fas fa-paper-plane"></i></button>
                        <button class="btn btn-outline-dark px-sm-5" type="reset">Reset &nbsp;&nbsp;<i class="fas fa-sync"></i>
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
        <img src="/img/404.png" style="width: 100%; height: 100%; object-fit:cover; z-index: index 0;; position:absolute;">
        <a class="btn btn-outline-light px-4 m-0 font-weight-bold" href="/<?php base_url() ?>" style="position:absolute;z-index:1;left:45%;top:65%;">GO HOME</a>
    </body>

    </html>
<?php endif; ?>