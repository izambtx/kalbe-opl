<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5">


    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <?php endif; ?>

    <!-- Page Heading -->
    <div class="row d-flex justify-content-center">
        <div class="custom-card pt-1">
            <h1 class="h3 mt-4 text-gray-800 font-weight-bold">User Profile</h1>
            <div class="img text-center align-middle">
                <img class="w-100 p-3" src="<?= base_url('img/' . user()->user_image); ?>" alt="<?= user()->username ?>">
            </div>
            <div class="info mt-4">
                <span><?= $user->username; ?></span><br>
                <span><?= $user->fullname; ?></span><br>
                <span><?= $user->NIK; ?></span>
                <p class="mb-0"><?= $user->name; ?></p>
            </div>
            <div class="mt-5">
                <button class="btn-back">
                    <a class="px-3" href="<?= base_url('/admin'); ?>" role="button">
                        <i class="fas fa-reply"></i>
                    </a>
                </button>
                <?php if (user_id() == $user->id) : ?>
                <?php else : ?>
                    <button class="btn-edit">
                        <a class="px-3" href="<?= base_url('/admin/edit/' . $user->UI) ?>" role="button">
                            <i class="fas fa-edit"></i>
                        </a>
                    </button>
                    <button class="btn-password">
                        <a class="px-3" href="<?= base_url('/admin/change-password/' . $user->UI); ?>" role="button">
                            <i class="fas fa-key"></i>
                        </a>
                    </button>
                    <button class="btn-sampah">
                        <a class="px-3" href="<?= base_url('/admin/delete/' . $user->UI); ?>" role="button">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </button>
                <?php endif ?>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>