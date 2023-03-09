<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <?php if ($user->username) : ?>
        <h1 class="h3 mb-4 text-gray-800 font-weight-bold">
            Details Of <?= $user->username; ?>
        </h1>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?= base_url('/img/' . $user->user_image); ?>" alt="<?= $user->username ?>">
                <div class="card-body">

                    <p class="card-text"><?= $user->username; ?>
                        <span class="badge badge-<?= ($user->name == 'admin') ? 'success' : 'warning'; ?>"><?= $user->name; ?></span>
                    </p>

                    <h5 class="card-title"></h5>
                    <p class="card-text"><?= $user->email; ?></p>

                </div>
                <div class="card-header">
                    <span class="font-weight-bold text-gray-800">Action :</span>
                    <a href="<?= base_url('admin') ?>" class="btn btn-success ml-4">
                        <i class="fas fa-reply"></i></a>
                    <a href="/admin/edit/<?= $user->UI; ?>" class="btn btn-warning ml-2">
                        <i class="fas fa-edit"></i> </a>
                    <a href="/admin/delete/<?= $user->UI; ?>" class="btn btn-danger ml-2" onclick="return confirm('apakah anda yakin?');">
                        <i class="far fa-trash-alt"></i> </a>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>