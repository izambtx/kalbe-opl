<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-auto mr-auto">
            <a href="<?= base_url('admin/create') ?>" class="btn btn-outline-primary"><i class="fas fa-plus-circle"> </i> Add New</a>
        </div>
        <div class="col-auto pt-1 text-gray-900">
            <h4>Filter :</h4>
        </div>
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort By
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header">Sort By</h6>
                    <a class="dropdown-item" href="#">Machine</a>
                    <a class="dropdown-item" href="#">Non Machine</a>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <form class="form-inline border border-secondary my-2 my-lg-0 bg-white pl-2 rounded-lg">
                <i class="fas fa-search ml-1"></i>
                <input class="form-control rounded-lg border-0 ml-1" placeholder="Search" type="search" aria-label="Search">
            </form>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>


    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover text-gray-900">
                <thead>
                    <tr class="table-success">
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $user->username; ?></td>
                            <td><?= $user->email; ?></td>
                            <td><?= $user->name; ?></td>
                            <td>
                                <a href="<?= base_url('admin/' . $user->UI) ?>" class="btn"><i class="far fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <ul class="d-flex justify-content-center" id="ul">
                <li id="li"><a href="" id="a" class="aktif"> 1 </a></li>
                <li id="li"><a href="" id="a"> 2 </a></li>
                <li id="li"><a href="" id="a"> 3 </a></li>
            </ul>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>