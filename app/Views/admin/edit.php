<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-middle">

        <div class=" col-md-6">

            <div class="rounded-md o-hidden border-0 shadow-lg mb-5">
                <div class=" p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row-register">
                        <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                        <div class="col-lg-12">
                            <div class="px-5 pt-5 pb-3 my-4">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 font-weight-bold">Update</h1>
                                    <hr class="my-2 mx-5">
                                    <small class="small font-weight-bold text-gray-900">Edit The User Communities Data</small>
                                </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <form class="user" action="<?= site_url('admin/' . $user->id) ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="text" class="form-control bg-light form-control-user <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" placeholder="Fullname" value="<?= $user->fullname; ?>" autofocus>
                                    </div>
                                    <div class="form-group row-password">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control bg-light form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Aliases" value="<?= $user->username; ?>">
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control bg-light form-control-user <?php if (session('errors.NIK')) : ?>is-invalid<?php endif ?>" name="NIK" placeholder="NIK" value="<?= $user->NIK; ?>">
                                            <div class="invalid-feedback">
                                                Please choose a NIK.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="department">Options</label>
                                        </div>
                                        <select class="custom-select" required id="department" name="department">
                                            <option selected disabled hidden>Choose...</option>
                                            <?php foreach ($distribusi as $d) : ?>
                                                <option value="<?= $d['id'];  ?>" <?= $user->distribusi == $d['id'] ? 'selected' : null; ?>><?= $d['nama_distribusi'];  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="groups">Options</label>
                                        </div>
                                        <select class="custom-select" required id="groups" name="groups">
                                            <option selected disabled hidden>Choose...</option>
                                            <?php foreach ($groupsUser as $g) : ?>
                                                <option value="<?= $g['id'];  ?>" <?= $user->group_id == $g['id'] ? 'selected' : null; ?>><?= $g['name'];  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="font-weight-bold btn btn-success btn-user btn-block">
                                        UPDATE
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>