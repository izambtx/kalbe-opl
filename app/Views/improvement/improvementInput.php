<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <div class="card p-5">

        <?php if (!empty(session()->getFlashdata('validation'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Invalid Input Data Detected! :</strong>
                <br>
                <?= session()->getFlashdata('validation'); ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between">
            <!-- <a href="<?= base_url('ListImprovement/' . user()->id); ?>" type="button" class="d-flex btn btn-outline-secondary mb-5 px-5">
                <div class="arrow mr-5 mt-3 p-0">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                &nbsp;
                Back to List
            </a> -->
            <a href="<?= base_url('ListImprovement/' . user()->id); ?>" type="button" class="btn btn-outline-primary mb-5"><i class="fas fa-chevron-circle-left"></i>&nbsp; Back to List</a>
            <h4 class="text-gray-900">Add New <span class="font-weight-bold">One Point Lesson</span></h4>
        </div>

        <form action="" method="get">
            <?php csrf_field(); ?>

            <div class="form-group row">
                <div class="form-row col-sm-12 px-0">
                    <div class="form-group col-sm-3">
                        <label for="jumlahFoto" class="align-middle mt-2 text-gray-900 font-weight-bold">Jumlah Foto OPL</label>
                    </div>
                    <div class="form-group col-sm-5">
                        <input type="number" min="0" max="15" class="form-control rounded-sm <?= ($validation->hasError('jumlahFoto')) ? 'is-invalid' : ''; ?>" id="jumlahFoto" name="jumlahFoto" placeholder="Masukan Jumlah Foto OPL Yang Diperlukan" value="<?= $inputFotoIM; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" value="gambar" name="submit" class="rounded-circle px-0 ml-4 form-control btn btn-success"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <!-- <div class="d-flex justify-content-center border rounded-lg mb-5">
            <button type="button" id="add-field" onclick="add_more_field()" class="btn btn-outline-success w-100 py-4 rounded-lg">
                <i class="fas fa-plus"></i>
                &nbsp;
                Add More Image
            </button>
        </div> -->
            </div>
        </form>

        <!-- Form Input -->
        <form action="/ListImprovement/SaveImprovement" method="post" enctype="multipart/form-data">
            <?php csrf_field(); ?>

            <?php $jumlahFoto = $inputFotoIM ?>
            <?php for ($i = 1; $i <= $jumlahFoto; $i++) : ?>
                <div id="inputImage">
                    <div class="media mb-4">
                        <div class="d-block my-auto col-sm-3 border-0" id="row">
                            <img src="/img/default.jpg" id="img" class="img-thumbnail col-sm-12 p-0 sebelum-preview<?= $i; ?> rounded" alt="Generic placeholder image">
                        </div>
                        <div class="media-body mx-3">
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-900 font-weight-bold align-middle my-3">Gambar <?= $i; ?></h5>
                                <div class="custom-file col-sm-10 my-2">
                                    <input type="file" accept="image/*" class="custom-file-input <?= ($validation->hasError('foto_sebelum')) ? 'is-invalid' : ''; ?>" id="foto_sebelum<?= $i; ?>" name="foto_sebelum<?= $i; ?>" value="<?= old('foto_sebelum'); ?>" onchange="preview_sebelum<?= $i; ?>()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto_sebelum'); ?>
                                    </div>
                                    <label class="custom-file-label" id="label_sebelum<?= $i; ?>" name="label_sebelum<?= $i; ?>" for="foto_sebelum<?= $i; ?>">Choose image / Drop image here</label>
                                </div>
                            </div>
                            <textarea class="form-control mt-2 rounded bg-light" rows="6" id="ket_foto<?= $i; ?>" placeholder="Keterangan Foto <?= $i; ?>" name="ket_foto<?= $i; ?>" value="<?= old('ket_foto'); ?>"></textarea>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>

            <div class="form-group mb-5">
                <label for="tema" class=" text-gray-900 font-weight-bold">Tema</label>
                <input type="text" required class="form-control rounded-sm <?= ($validation->hasError('tema')) ? 'is-invalid' : ''; ?>" id="tema" name="tema" placeholder="Tema One Point Lesson" autofocus value="<?= old('tema'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('tema'); ?>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="jumlahFileFoto" name="jumlahFileFoto" value="<?= $inputFotoIM; ?>">
            </div>
            <div class="form-group mb-5">
                <input type="hidden" class="form-control" id="pembuat" name="pembuat" value="<?= user()->id; ?>">
            </div>
            <div class="form-group mb-5">
                <input type="hidden" class="form-control" id="counter" name="counter" value="<?= $countOPL + 1; ?>">
            </div>
            <div class="form-group mb-5">
                <label for="tujuan" class=" text-gray-900 font-weight-bold">Tujuan</label>
                <div class="invalid-feedback">
                    <?= $validation->getError('tujuan'); ?>
                </div>
                <textarea class="form-control rounded" required rows="5" id="tujuan" placeholder="Keterangan Tujuan" name="tujuan"><?= old('tujuan'); ?></textarea>
            </div>
            <div class="form-group mb-5">
                <label for="fungsi" class=" text-gray-900 font-weight-bold">Fungsi</label>
                <div class="invalid-feedback">
                    <?= $validation->getError('fungsi'); ?>
                </div>
                <textarea class="form-control rounded" required rows="5" id="fungsi" placeholder="Keterangan Fungsi" name="fungsi"><?= old('fungsi'); ?></textarea>
            </div>
            <div class="form-group mb-5">
                <label for="penjelasan" class=" text-gray-900 font-weight-bold">Prosedur / Penjelasan</label>
                <div class="invalid-feedback">
                    <?= $validation->getError('penjelasan'); ?>
                </div>
                <textarea class="form-control rounded" required rows="5" id="penjelasan" placeholder="Keterangan Prosedur / Penjelasan" name="penjelasan"><?= old('penjelasan'); ?></textarea>
            </div>
            <div class="form-group mb-5">
                <label for="dampak" class=" text-gray-900 font-weight-bold">Dampak Bila Tidak Dilakukan</label>
                <div class="invalid-feedback">
                    <?= $validation->getError('dampak'); ?>
                </div>
                <textarea class="form-control rounded" required rows="5" id="dampak" placeholder="Keterangan Dampak Bila Tidak Dilakukan" name="dampak"><?= old('dampak'); ?></textarea>
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
                        <option value="1" selected>NA - (Non Mesin)</option>
                        <?php foreach ($mesin as $m) : ?>
                            <?php if ($m['nama_mesin'] == 'NA') : ?>
                            <?php else : ?>
                                <option value="<?= $m['id'];  ?>" <?= old('mesin') == $m['id'] ? 'selected' : '' ?>><?= $m['nama_mesin'];  ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group mb-5">
                <label for="distribusi" class=" text-gray-900 font-weight-bold">Daftar Department</label>
                <!-- <input type="number" class="form-control" id="distribusi" name="distribusi" placeholder="distribusi One Point Lesson"> -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="distribusi">Options</label>
                    </div>
                    <select class="custom-select" required id="distribusi" name="distribusi">
                        <option selected disabled hidden>Choose...</option>
                        <?php foreach ($distribusi as $d) : ?>
                            <option value="<?= $d['id'];  ?>"><?= $d['nama_distribusi'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-5">
                <div class="col-row justify-content-end">
                    <button class="btn btn-success px-sm-5" type="submit">Send &nbsp;&nbsp;<i class="fas fa-paper-plane"></i></button>
                    <button class="btn btn-outline-secondary" type="reset"><i class="fas fa-sync"></i>
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