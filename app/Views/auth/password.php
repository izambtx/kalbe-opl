<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            <div class="card shadow mb-5 px-3 pb-4">
                <h2 class="d-flex justify-content-center mt-5 font-weight-bold text-gray-900">Update Password</h2>
                <div class="card-body">

                    <?php if (!empty(session()->getFlashdata('validation'))) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Invalid Input Data Detected! :</strong>
                            <br>
                            <?= session()->getFlashdata('validation'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
                    <?php endif; ?>

                    <!-- <p><?= lang('Auth.enterCodeEmailPassword') ?></p> -->

                    <form action="<?php echo base_url('update-password'); ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="old-password">Old Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control rounded-left-lg border-right-0" name="old-password" id="old-password" type="password" autofocus aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-prepend border-left-0">
                                    <span class="input-group-text rounded-right-lg bg-white border-left-0" id="basic-addon1">
                                        <button type="button" class="bg-abu text-dark border-0 bg-white" onclick="showOldPassword()"><i id="eyeOld" class="fas fa-eye"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control rounded-left-lg border-right-0" name="new-password" id="new-password" type="password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-prepend border-left-0">
                                    <span class="input-group-text rounded-right-lg bg-white border-left-0" id="basic-addon1">
                                        <button type="button" class="bg-abu text-dark border-0 bg-white" onclick="showNewPassword()"><i id="eyeNew" class="fas fa-eye"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm-new-password">Confirm Password</label>
                            <div class="input-group mb-3">
                                <input class="form-control rounded-left-lg border-right-0" name="password" id="confirm-new-password" type="password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-prepend border-left-0">
                                    <span class="input-group-text rounded-right-lg bg-white border-left-0" id="basic-addon1">
                                        <button type="button" class="bg-abu text-dark border-0 bg-white" onclick="showConfirmPassword()"><i id="eyeConfirm" class="fas fa-eye"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-success rounded-lg btn-block">Update Password</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function showOldPassword() {
        var x = document.getElementById("old-password");
        var y = document.getElementById("eyeOld");
        if (x.type === "password" && y.className === "fas fa-eye") {
            x.type = "text";
            y.className = "fas fa-eye-slash";
        } else {
            x.type = "password";
            y.className = "fas fa-eye";
        }
    }
</script>

<script>
    function showNewPassword() {
        var x = document.getElementById("new-password");
        var y = document.getElementById("eyeNew");
        if (x.type === "password" && y.className === "fas fa-eye") {
            x.type = "text";
            y.className = "fas fa-eye-slash";
        } else {
            x.type = "password";
            y.className = "fas fa-eye";
        }
    }
</script>

<script>
    function showConfirmPassword() {
        var x = document.getElementById("confirm-new-password");
        var y = document.getElementById("eyeConfirm");
        if (x.type === "password" && y.className === "fas fa-eye") {
            x.type = "text";
            y.className = "fas fa-eye-slash";
        } else {
            x.type = "password";
            y.className = "fas fa-eye";
        }
    }
</script>

<?= $this->endSection() ?>