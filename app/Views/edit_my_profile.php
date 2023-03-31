<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5">

    <!-- Page Heading -->
    <div class="row">
        <?= view('Myth\Auth\Views\_message_block') ?>

        <div class="card-form mx-auto shadow">
            <span class="title mt-4">Leave a Comment</span>
            <form class="form-kritik">
                <div class="group">
                    <input placeholder="‎" type="text" required="">
                    <label for="name">Name</label>
                </div>
                <div class="group">
                    <input placeholder="‎" type="email" id="email" name="email" required="">
                    <label for="email">Email</label>
                </div>
                <div class="group">
                    <textarea placeholder="‎" id="comment" name="comment" rows="5" required=""></textarea>
                    <label for="comment">Comment</label>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>