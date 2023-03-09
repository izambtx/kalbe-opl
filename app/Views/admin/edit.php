<?= $this->extend('header/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">
        Edit The User
    </h1>

    <div class="row">
        <div class="col-lg-8">
            <?= view('Myth\Auth\Views\_message_block') ?>
            <form class="user" action="<?= site_url('admin/' . $users->id) ?>" method="post">
                <?= csrf_field() ?>

                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= $users->username ?>">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="exampleInputEmail" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= $users->email ?>">
                </div>
                <a class="btn btn-primary font-weight-bold btn btn-success btn-user" href="<?= base_url('admin') ?>" role="button" id="TomEdL">
                    <i class="fas fa-reply-all"></i>&nbsp;&nbsp;Go Back
                </a>
                <button type="reset" value="Reset" class="font-weight-bold btn btn-secondary btn-user" id="TomEdC">
                    <i class="fas fa-undo-alt"></i>&nbsp;&nbsp;Undo
                </button>
                <button type="submit" class="font-weight-bold btn btn-warning btn-user" id="TomEdR">
                    <i class="far fa-save"></i>&nbsp;&nbsp;Confirm
                </button>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>