<?php $this->extend('auth/template/index'); ?>

<?php $this->section('content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-middle">

        <div class=" col-md-6">

            <div class="rounded-md o-hidden border-0 shadow-lg my-5">
                <div class=" p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row-register">
                        <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                        <div class="col-lg-12">
                            <div class="px-5 pt-5 pb-3 mt-4">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 font-weight-bold"><?= lang('Auth.register') ?></h1>
                                    <hr class="my-2 mx-5">
                                    <small class="small font-weight-bold text-gray-900">Be Part Of The Community</small>
                                </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <form class="user" action="<?= url_to('register') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="number" class="form-control bg-light form-control-user <?php if (session('errors.NIK')) : ?>is-invalid<?php endif ?>" name="NIK" placeholder="NIK" value="<?= old('NIK') ?>" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-light form-control-user <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" placeholder="Fullname" value="<?= old('fullname') ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-light form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Aliases" value="<?= old('username') ?>">
                                    </div>
                                    <div class="form-group row-password">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control bg-light form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="exampleInputPassword" name="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control bg-light form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" id="exampleRepeatPassword" name="pass_confirm" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <button type="submit" class="font-weight-bold btn btn-success btn-user btn-block">
                                        REGISTER
                                    </button>
                                </form>
                                <div class="text-center mt-3">
                                    <p>
                                        <a class="small font-weight-bold text-gray-900" href="<?= url_to('login') ?>">
                                            <?= lang('Auth.alreadyRegistered') ?>
                                            <?= lang('Auth.signIn') ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>