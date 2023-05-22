<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5">

    <!-- Page Heading -->

    <div class="row d-flex justify-content-center">
        <div class="custom-card pt-1">
            <h1 class="h3 mt-4 text-gray-800 font-weight-bold">My Profile</h1>
            <div class="img text-center align-middle">
                <img class="w-100 p-3" src="<?= base_url('img/' . user()->user_image); ?>" alt="<?= user()->username ?>">
            </div>
            <div class="info mt-4">
                <span><?= user()->username ?></span><br>
                <span><?= user()->fullname ?></span><br>
                <span><?= user()->NIK ?></span>
                <?php if (in_groups('supervisor')) : ?>
                    <p class="mb-0">Supervisor</p>
                <?php elseif (in_groups('admin')) : ?>
                    <p class="mb-0">Admin</p>
                <?php elseif (in_groups('engineer')) : ?>
                    <p class="mb-0">Engineer</p>
                <?php else : ?>
                    <p class="mb-0">User</p>
                <?php endif; ?>
            </div>
            <a href="<?= base_url('/change-password'); ?>" class="mt-4 pl-4"><i class="fas fa-key mr-2"></i> Change Password</a>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>