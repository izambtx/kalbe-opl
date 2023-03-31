<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 ml-5 mb-3 text-gray-800">Hello <span class="font-weight-bold"><?= user()->fullname; ?></span>, it's good to see you again!</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                OPL Pengetahuan Dasar
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $countPD; ?></div>
                        </div>
                        <div class="col-sm-2">
                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/ejnrjovh.json" trigger="hover" colors="outline:#121331,primary:#e4e4e4,secondary:#1663c7" style="width:50px;height:50px">
                            </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                OPL Improvement
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $countIM; ?></div>
                        </div>
                        <div class="col-sm-2">
                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/qtqvorle.json" trigger="hover" colors="outline:#121331,primary:#30e849,secondary:#ebe6ef,tertiary:#242424" style="width:50px;height:50px">
                            </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                OPL Trouble Shooting
                            </div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Total : <?= $countTS; ?></div>
                        </div>
                        <div class="col-sm-2">
                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" state="hover-2" style="width:50px;height:50px">
                            </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Returned Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <?php if (in_groups('user')) : ?>
                                    Pending Returned OPL
                                <?php elseif (in_groups('admin')) : ?>
                                    Registered Users
                                <?php else : ?>
                                    Pending Approve OPL
                                <?php endif; ?>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <?php if (!empty(($countIM + $countPD + $countTS) || ($countRIM + $countRPD + $countRTS))) : ?>
                                    <div class="col-auto">
                                        <?php if (in_groups('user')) : ?>
                                            <?php if (($countIM + $countPD + $countTS) > ($countRIM + $countRPD + $countRTS)) : ?>
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?= ceil(($countRIM + $countRPD + $countRTS) / ($countIM + $countPD + $countTS) * 100); ?>%
                                                </div>
                                            <?php else : ?>
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?= ceil(($countIM + $countPD + $countTS) / ($countRIM + $countRPD + $countRTS) * 100); ?>%
                                                </div>
                                            <?php endif; ?>
                                        <?php elseif (in_groups('admin')) : ?>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?= $countU; ?>
                                            </div>
                                        <?php else : ?>
                                            <?php if (($countIM + $countPD + $countTS) > ($countRIM + $countRPD + $countRTS)) : ?>
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?= ceil(($countRIM + $countRPD + $countRTS) / ($countIM + $countPD + $countTS) * 100); ?>%
                                                </div>
                                            <?php else : ?>
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?= ceil(($countIM + $countPD + $countTS) / ($countRIM + $countRPD + $countRTS) * 100); ?>%
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <?php if (in_groups('admin')) : ?>
                                            <span class="text-gray-900 font-weight-bold align-text-top">users</span>
                                        <?php else : ?>
                                            <div class="progress progress-sm mr-2">
                                                <?php if (($countIM + $countPD + $countTS) > ($countRIM + $countRPD + $countRTS)) : ?>
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= ceil(100 - ($countRIM + $countRPD + $countRTS) / ($countIM + $countPD + $countTS) * 100); ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php else : ?>
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= ceil(($countIM + $countPD + $countTS) / ($countRIM + $countRPD + $countRTS) * 100); ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>

                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/jefnhaqh.json" trigger="hover" colors="outline:#121331,primary:#e8b730,secondary:#e8b730,tertiary:#e4e4e4" style="width:50px;height:50px">
                            </lord-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="get" class="col-sm-12 bg-white pt-3 rounded-top">
        <div class="input-group col-sm-6 pl-3 p-0">
            <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="filter" name="filter">
                <option selected hidden disabled>Filter By</option>
                <option value="1">Users</option>
                <option value="2">OPL No.</option>
                <option value="3">Department</option>
                <option value="4">Mesin</option>
                <option value="5">User - Mesin</option>
                <option value="6">Department - Mesin</option>
            </select>
            <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search-plus"></i></button>
            <?php if ($filter == 2) : ?>
                <h6 class="text-gray-900 my-auto ml-3">Filter By : <span class="font-weight-bold text-gray-900">OPL No.</span></h6>
            <?php endif; ?>
        </div>
    </form>

    <!-- Filter Dropdown -->
    <div class="d-flex justify-content-center pb-3">
        <form action="" method="get" class="col-sm-12 form-inline bg-white pt-3 rounded-bottom">
            <div class="input-group mb-3 col-sm-2">
                <select id="month" name="month" class="custom-select text-gray-900 font-weight-bold">
                    <option value="">Select Month</option>
                    <?php
                    $selected_month = date('m'); //current month
                    for ($i_month = 1; $i_month <= 12; $i_month++) {
                        $selected = $selected_month == $i_month ? ' selected' : '';
                        echo '<option value="' . $i_month . '"' . $selected . '>(' . $i_month . ') ' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                    }
                    ?>
                </select>
            </div>
            <div class="input-group mb-3 col-sm-2">
                <?php
                $year_start  = 2023;
                $year_end = date('Y'); // current Year
                $user_selected_year = 1992; // user date of birth year

                echo '<select class="custom-select text-gray-900 font-weight-bold" id="year" name="year">' . "\n";
                echo '<option selected disabled hidden value="$year_end">Choose Year</option>' . "\n";
                for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                    $selected = ($user_selected_year == $i_year ? ' selected' : '');
                    echo '<option value="' . $i_year . '"' . '>' . $i_year . '</option>' . "\n";
                }
                echo '</select>' . "\n";
                ?>
            </div>
            <?php if ($filter == 1) : ?>
                <div class="input-group mb-3 col-sm-5">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="users" name="users">
                        <option selected hidden disabled>Choose User</option>
                        <?php foreach ($usersList as $uL) : ?>
                            <option value="<?= $uL['id'];  ?>"><?= $uL['fullname'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></button>
                </div>
            <?php elseif ($filter == 2) : ?>
                <div class="input-group mb-3 col-sm-3">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="oplNoPD" name="oplNoPD">
                        <option selected disabled hidden>Pengetahuan Dasar</option>
                        <?php foreach ($oplNoPD as $OPD) : ?>
                            <option value="<?= $OPD['id'];  ?>" <?= old('oplNoPD') == $OPD['id'] ? 'selected' : '' ?>><?= $OPD['username'];  ?> - <?= $OPD['opl_no'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group mb-3 col-sm-2">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="oplNoIM" name="oplNoIM">
                        <option selected disabled hidden>Improvement</option>
                        <?php foreach ($oplNoIM as $OIM) : ?>
                            <option value="<?= $OIM['id'];  ?>" <?= old('oplNoIM') == $OIM['id'] ? 'selected' : '' ?>><?= $OIM['username'];  ?> - <?= $OIM['opl_no'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="oplNoTS" name="oplNoTS">
                        <option selected disabled hidden>Trouble Shooting</option>
                        <?php foreach ($oplNoTS as $OTS) : ?>
                            <option value="<?= $OTS['id'];  ?>" <?= old('oplNoTS') == $OTS['id'] ? 'selected' : '' ?>><?= $OTS['username'];  ?> - <?= $OTS['opl_no'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></button>
                </div>
            <?php elseif ($filter == 3) : ?>
                <div class="input-group mb-3 col-sm-5">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="distribusi" name="distribusi">
                        <option selected disabled hidden>Choose Department</option>
                        <?php foreach ($distribusiList as $d) : ?>
                            <option value="<?= $d['id'];  ?>" <?= old('distribusi') == $d['id'] ? 'selected' : '' ?>><?= $d['nama_distribusi'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></button>
                </div>
            <?php elseif ($filter == 4) : ?>
                <div class="input-group mb-3 col-sm-5">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="mesin" name="mesin">
                        <option selected disabled hidden>Choose Mesin</option>
                        <?php foreach ($mesin as $m) : ?>
                            <option value="<?= $m['id'];  ?>" <?= old('mesin') == $m['id'] ? 'selected' : '' ?>><?= $m['nama_mesin'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></button>
                </div>
            <?php elseif ($filter == 5) : ?>
                <div class="input-group mb-3 col-sm-3 px-3 p-0">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="users" name="users">
                        <option selected hidden disabled>Choose User</option>
                        <?php foreach ($usersList as $uL) : ?>
                            <option value="<?= $uL['id'];  ?>"><?= $uL['fullname'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="mesin" name="mesin">
                        <option selected disabled hidden>Choose Mesin</option>
                        <?php foreach ($mesin as $m) : ?>
                            <option value="<?= $m['id'];  ?>" <?= old('mesin') == $m['id'] ? 'selected' : '' ?>><?= $m['nama_mesin'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></button>
                </div>
            <?php elseif ($filter == 6) : ?>
                <div class="input-group mb-3 col-sm-3">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="distribusi" name="distribusi">
                        <option selected disabled hidden>Choose Department</option>
                        <?php foreach ($distribusiList as $d) : ?>
                            <option value="<?= $d['id'];  ?>" <?= old('distribusi') == $d['id'] ? 'selected' : '' ?>><?= $d['nama_distribusi'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="mesin" name="mesin">
                        <option selected disabled hidden>Choose Mesin</option>
                        <?php foreach ($mesin as $m) : ?>
                            <option value="<?= $m['id'];  ?>" <?= old('mesin') == $m['id'] ? 'selected' : '' ?>><?= $m['nama_mesin'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></i></button>
                </div>
            <?php else : ?>
            <?php endif; ?>



            <?php if ($month && $year && $users) : ?>
                <div class="input-group mb-3 col-sm-5">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="users" name="users">
                        <option selected hidden disabled>Choose User</option>
                        <?php foreach ($usersList as $uL) : ?>
                            <option value="<?= $uL['id'];  ?>"><?= $uL['fullname'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></button>
                </div>
                <div class="ml-4 mb-3">
                    <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                    <div class="form-inline border border-success ml-2 rounded">
                        <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-tags mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <div class="input-group my-2 mx-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-tags mr-2"></i><?= $year; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <?php if (empty($distribusi)) : ?>
                        <?php else : ?>
                            <div class="input-group my-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-tags mr-2"></i><?= $distribusiNama['nama_distribusi']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($users)) : ?>
                        <?php else : ?>
                            <div class="input-group my-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-tags mr-2"></i><?= $usersNama['fullname']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif ($month && $year && $mesin) : ?>
                <div class="input-group mb-3 col-sm-5">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="mesin" name="mesin">
                        <option selected disabled hidden>Choose Mesin</option>
                        <?php foreach ($mesin as $m) : ?>
                            <option value="<?= $m['id'];  ?>" <?= old('mesin') == $m['id'] ? 'selected' : '' ?>><?= $m['nama_mesin'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></button>
                </div>
                <div class="ml-4 mb-3">
                    <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                    <div class="form-inline border border-success ml-2 rounded">
                        <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-tags mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <div class="input-group my-2 mx-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-tags mr-2"></i><?= $year; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <?php if (empty($distribusi)) : ?>
                        <?php else : ?>
                            <div class="input-group my-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-tags mr-2"></i><?= $distribusiNama['nama_distribusi']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($users)) : ?>
                        <?php else : ?>
                            <div class="input-group my-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-tags mr-2"></i><?= $usersNama['fullname']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif ($month && $year && $users && $mesin) : ?>
                <div class="input-group mb-3 col-sm-3 px-3 p-0">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="users" name="users">
                        <option selected hidden disabled>Choose User</option>
                        <?php foreach ($usersList as $uL) : ?>
                            <option value="<?= $uL['id'];  ?>"><?= $uL['fullname'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="mesin" name="mesin">
                        <option selected disabled hidden>Choose Mesin</option>
                        <?php foreach ($mesin as $m) : ?>
                            <option value="<?= $m['id'];  ?>" <?= old('mesin') == $m['id'] ? 'selected' : '' ?>><?= $m['nama_mesin'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></button>
                </div>
                <div class="ml-4 mb-3">
                    <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                    <div class="form-inline border border-success ml-2 rounded">
                        <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-tags mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <div class="input-group my-2 mx-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-tags mr-2"></i><?= $year; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <?php if (empty($distribusi)) : ?>
                        <?php else : ?>
                            <div class="input-group my-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-tags mr-2"></i><?= $distribusiNama['nama_distribusi']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($users)) : ?>
                        <?php else : ?>
                            <div class="input-group my-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-tags mr-2"></i><?= $usersNama['fullname']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif ($month && $year && $distribusi && $mesin) : ?>
                <div class="input-group mb-3 col-sm-3">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="distribusi" name="distribusi">
                        <option selected disabled hidden>Choose Department</option>
                        <?php foreach ($distribusiList as $d) : ?>
                            <option value="<?= $d['id'];  ?>" <?= old('distribusi') == $d['id'] ? 'selected' : '' ?>><?= $d['nama_distribusi'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                    <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="mesin" name="mesin">
                        <option selected disabled hidden>Choose Mesin</option>
                        <?php foreach ($mesin as $m) : ?>
                            <option value="<?= $m['id'];  ?>" <?= old('mesin') == $m['id'] ? 'selected' : '' ?>><?= $m['nama_mesin'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search"></i></i></button>
                </div>
                <div class="ml-4 mb-3">
                    <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                    <div class="form-inline border border-success ml-2 rounded">
                        <div class="input-group my-2 ml-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-tags mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <div class="input-group my-2 mx-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-tags mr-2"></i><?= $year; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <?php if (empty($distribusi)) : ?>
                        <?php else : ?>
                            <div class="input-group my-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-tags mr-2"></i><?= $distribusiNama['nama_distribusi']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($users)) : ?>
                        <?php else : ?>
                            <div class="input-group my-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded-sm border border-abu">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-tags mr-2"></i><?= $usersNama['fullname']; ?><i class="fas fa-times pl-2" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area / Bar Chart -->
        <div class="col-xl-8 col-lg-7 mt-3">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header rounded-lg bg-white border-bottom-0 py-4 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="font-weight-bold text-gray-900">Laporan Grafik OPL</h6>
                    <div class="dropdown no-arrow">
                        <?php
                        $request = \Config\Services::request();
                        $distribusi = $request->getVar('distribusi');
                        $users = $request->getVar('users');
                        $month = $request->getVar('month');
                        $year = $request->getVar('year');
                        if ($distribusi || $users || $month || $year) {
                            $param = "?month=" . $month . "&year=" . $year . "&distribusi=" . $distribusi . "&users=" . $users;
                        } else {
                            $param = "";
                        }
                        ?>
                        <?php if ($countTPD == 0 && $countTIM == 0  && $countTTS == 0) : ?>
                            <button type="button" id="tombolError" class="download-button dropdown-toggle">
                                <div class="docs">
                                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line y2="13" x2="8" y1="13" x1="16"></line>
                                        <line y2="17" x2="8" y1="17" x1="16"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    Download .XLSX
                                </div>
                                <div class="download">
                                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line y2="3" x2="12" y1="15" x1="12"></line>
                                    </svg>
                                </div>
                            </button>
                        <?php else : ?>
                            <a href="<?php base_url() ?>/opl/export<?= $param; ?>" class="download-button">
                                <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line y2="13" x2="8" y1="13" x1="16"></line>
                                        <line y2="17" x2="8" y1="17" x1="16"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>Download .XLSX</div>
                                <div class="download">
                                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line y2="3" x2="12" y1="15" x1="12"></line>
                                    </svg>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body mb-1">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-primary"></i> Pengetahuan Dasar
                        </span>
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-success"></i> Improvement
                        </span>
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-info"></i> Trouble Shooting
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5 mt-3" style="border-radius: 50px;">
            <div class="card shadow rounded">
                <!-- Card Header - Dropdown -->
                <div class="card-header rounded-top-lg border-bottom-0 pt-4 d-flex flex-row align-items-center justify-content-between bg-white">
                    <?php if (in_groups('admin')) : ?>
                        <h6 class="m-0 font-weight-bold text-gray-900">All OPL Per Category</h6>
                    <?php else : ?>
                        <h6 class="m-0 font-weight-bold text-gray-900">OPL <span class="text-success"><?= user()->username; ?></span> Per Category </h6>
                    <?php endif; ?>
                    <div class="dropdown no-arrow">
                        <a href="<?php base_url() ?>/opl/export" class="download-button dropdown-toggle">
                            <div class="docs py-0"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line y2="13" x2="8" y1="13" x1="16"></line>
                                    <line y2="17" x2="8" y1="17" x1="16"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                .XLSX</div>
                            <div class="download">
                                <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line y2="3" x2="12" y1="15" x1="12"></line>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body rounded-bottom-lg">
                    <div class="chart-pie py-2">
                        <?php if (!empty($countPD || $countIM || $countTS)) : ?>
                            <canvas id="myPieChart"></canvas>
                        <?php else : ?>
                            <div class="container h-100">
                                <div class="row align-items-center h-100">
                                    <span class="mx-auto text-center">Belum Ada OPL Yang Berkaitan Dengan User <span class="text-success font-weight-bold"><?= user()->username; ?></span></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mt-5 mb-3 text-center small">
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-primary"></i> Pengetahuan Dasar
                        </span>
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-success"></i> Improvement
                        </span>
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-info"></i> Trouble Shooting
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input id="oplPD" type="hidden" value="<?= $countPD; ?>"></input>
<input id="oplIM" type="hidden" value="<?= $countIM; ?>"></input>
<input id="oplTS" type="hidden" value="<?= $countTS; ?>"></input>
<input id="oplTMPD" type="hidden" value="<?= $countTMPD; ?>"></input>
<input id="oplTMIM" type="hidden" value="<?= $countTMIM; ?>"></input>
<input id="oplTMTS" type="hidden" value="<?= $countTMTS; ?>"></input>
<input id="oplTPD" type="hidden" value="<?= $countTPD; ?>"></input>
<input id="oplTIM" type="hidden" value="<?= $countTIM; ?>"></input>
<input id="oplTTS" type="hidden" value="<?= $countTTS; ?>"></input>

<!-- BUAT CHART AREA PENGETAHUAN DASAR -->

<?php $i = 1; ?>
<?php if ($countTMPD == 0) : ?>

    <input id="oplMPD1" type="hidden" value="0"></input>
    <input id="oplMPD2" type="hidden" value="0"></input>
    <input id="oplMPD3" type="hidden" value="0"></input>
    <input id="oplMPD4" type="hidden" value="0"></input>
    <input id="oplMPD5" type="hidden" value="0"></input>

<?php elseif ($countTMPD == 1) : ?>

    <?php foreach ($countMPD as $CMPD) : ?>
        <input id="oplMPD<?= $i++; ?>" type="hidden" value="<?= $CMPD['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMPD2" type="hidden" value="0"></input>
    <input id="oplMPD3" type="hidden" value="0"></input>
    <input id="oplMPD4" type="hidden" value="0"></input>
    <input id="oplMPD5" type="hidden" value="0"></input>

<?php elseif ($countTMPD == 2) : ?>

    <?php foreach ($countMPD as $CMPD) : ?>
        <input id="oplMPD<?= $i++; ?>" type="hidden" value="<?= $CMPD['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMPD3" type="hidden" value="0"></input>
    <input id="oplMPD4" type="hidden" value="0"></input>
    <input id="oplMPD5" type="hidden" value="0"></input>

<?php elseif ($countTMPD == 3) : ?>

    <?php foreach ($countMPD as $CMPD) : ?>
        <input id="oplMPD<?= $i++; ?>" type="hidden" value="<?= $CMPD['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMPD4" type="hidden" value="0"></input>
    <input id="oplMPD5" type="hidden" value="0"></input>

<?php elseif ($countTMPD == 4) : ?>

    <?php foreach ($countMPD as $CMPD) : ?>
        <input id="oplMPD<?= $i++; ?>" type="hidden" value="<?= $CMPD['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMPD5" type="hidden" value="0"></input>

<?php elseif ($countTMPD == 5) : ?>

    <?php foreach ($countMPD as $CMPD) : ?>
        <input id="oplMPD<?= $i++; ?>" type="hidden" value="<?= $CMPD['id']; ?>"></input>
    <?php endforeach; ?>
<?php endif; ?>

<!-- BUAT CHART AREA IMPROVEMENT -->

<?php $i = 1; ?>
<?php if ($countTMIM == 0) : ?>

    <input id="oplMIM1" type="hidden" value="0"></input>
    <input id="oplMIM2" type="hidden" value="0"></input>
    <input id="oplMIM3" type="hidden" value="0"></input>
    <input id="oplMIM4" type="hidden" value="0"></input>
    <input id="oplMIM5" type="hidden" value="0"></input>

<?php elseif ($countTMIM == 1) : ?>

    <?php foreach ($countMIM as $CMIM) : ?>
        <input id="oplMIM<?= $i++; ?>" type="hidden" value="<?= $CMIM['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMIM2" type="hidden" value="0"></input>
    <input id="oplMIM3" type="hidden" value="0"></input>
    <input id="oplMIM4" type="hidden" value="0"></input>
    <input id="oplMIM5" type="hidden" value="0"></input>

<?php elseif ($countTMIM == 2) : ?>

    <?php foreach ($countMIM as $CMIM) : ?>
        <input id="oplMIM<?= $i++; ?>" type="hidden" value="<?= $CMIM['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMIM3" type="hidden" value="0"></input>
    <input id="oplMIM4" type="hidden" value="0"></input>
    <input id="oplMIM5" type="hidden" value="0"></input>

<?php elseif ($countTMIM == 3) : ?>

    <?php foreach ($countMIM as $CMIM) : ?>
        <input id="oplMIM<?= $i++; ?>" type="hidden" value="<?= $CMIM['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMIM4" type="hidden" value="0"></input>
    <input id="oplMIM5" type="hidden" value="0"></input>

<?php elseif ($countTMIM == 4) : ?>

    <?php foreach ($countMIM as $CMIM) : ?>
        <input id="oplMIM<?= $i++; ?>" type="hidden" value="<?= $CMIM['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMIM5" type="hidden" value="0"></input>

<?php elseif ($countTMIM == 5) : ?>
    <?php foreach ($countMIM as $CMIM) : ?>
        <input id="oplMIM<?= $i++; ?>" type="hidden" value="<?= $CMIM['id']; ?>"></input>
    <?php endforeach; ?>
<?php endif; ?>

<!-- BUAT CHART AREA TROUBLE SHOOTING -->

<?php $i = 1; ?>
<?php if ($countTMTS == 0) : ?>
    <input id="oplMTS1" type="hidden" value="0"></input>
    <input id="oplMTS2" type="hidden" value="0"></input>
    <input id="oplMTS3" type="hidden" value="0"></input>
    <input id="oplMTS4" type="hidden" value="0"></input>
    <input id="oplMTS5" type="hidden" value="0"></input>
<?php elseif ($countTMTS == 1) : ?>

    <?php foreach ($countMTS as $CMTS) : ?>
        <input id="oplMTS<?= $i++; ?>" type="hidden" value="<?= $CMTS['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMTS2" type="hidden" value="0"></input>
    <input id="oplMTS3" type="hidden" value="0"></input>
    <input id="oplMTS4" type="hidden" value="0"></input>
    <input id="oplMTS5" type="hidden" value="0"></input>

<?php elseif ($countTMTS == 2) : ?>

    <?php foreach ($countMTS as $CMTS) : ?>
        <input id="oplMTS<?= $i++; ?>" type="hidden" value="<?= $CMTS['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMTS3" type="hidden" value="0"></input>
    <input id="oplMTS4" type="hidden" value="0"></input>
    <input id="oplMTS5" type="hidden" value="0"></input>

<?php elseif ($countTMTS == 3) : ?>

    <?php foreach ($countMTS as $CMTS) : ?>
        <input id="oplMTS<?= $i++; ?>" type="hidden" value="<?= $CMTS['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMTS4" type="hidden" value="0"></input>
    <input id="oplMTS5" type="hidden" value="0"></input>

<?php elseif ($countTMTS == 4) : ?>

    <?php foreach ($countMTS as $CMTS) : ?>
        <input id="oplMTS<?= $i++; ?>" type="hidden" value="<?= $CMTS['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="oplMTS5" type="hidden" value="0"></input>

<?php elseif ($countTMTS == 5) : ?>

    <?php foreach ($countMTS as $CMTS) : ?>
        <input id="oplMTS<?= $i++; ?>" type="hidden" value="<?= $CMTS['id']; ?>"></input>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>