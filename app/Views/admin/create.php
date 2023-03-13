<?= $this->extend('header/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">
        Add New User
    </h1>

    <div class="row">
        <div class="col-lg-8">

            <?= view('Myth\Auth\Views\_message_block') ?>


            <div class="d-flex justify-content-between mb-5 mt-4">
                <form class="user" action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" placeholder="<?= lang('Fullname') ?>" value="<?= old('fullname') ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="exampleInputEmail" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                    </div>
                    <div class="form-group row-register">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="exampleInputPassword" name="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" id="exampleRepeatPassword" name="pass_confirm" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>
                        <small id="passwordHelpBlock" class="form-text text-muted ml-3">
                            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                        </small>
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect01">
                            <option selected hidden>Choose Level...</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                            <option value="3">Atasan</option>
                            <option value="4">Engineer</option>
                        </select>
                    </div>
                    <a class="btn btn-primary font-weight-bold btn btn-success btn-user" href="<?= base_url('admin') ?>" role="button" id="TomEdL">
                        <i class="fas fa-reply"></i>&nbsp;&nbsp;Go Back
                    </a>
                    <button type="reset" class="font-weight-bold btn btn-secondary btn-user" id="TomEdC">
                        <i class="fas fa-undo-alt"></i>&nbsp;&nbsp;Clear
                    </button>
                    <button type="submit" class="font-weight-bold btn btn-warning btn-user" id="TomEdR">
                        <i class="far fa-save"></i>&nbsp;&nbsp;Send
                    </button>
                </form>
                <div class="">
                    <h5 class="text-gray-900 text-center mt-3 font-weight-bold">Profile Picture</h5>
                    <img src="/img/default.jpg" class="img-thumbnail mx-auto d-block my-0 p-0 sebelum-preview">
                    <div class="custom-file col-sm-7 mx-auto d-block">
                        <input type="file" class="custom-file-input" id="foto_sebelum" name="foto_sebelum" value="<?= old('foto_sebelum'); ?>" onchange="preview_sebelum()">
                        <label class="custom-file-label" id="label_sebelum" for="foto_sebelum">Choose image</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>