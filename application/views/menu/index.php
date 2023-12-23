    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?= $title ?> /</span> <?= $sub['title'] ?></h4>        
        <?= form_error('menu', '<div class="alert alert-danger">','</div>')?>
        <?= $this->session->flashdata('message') ?>
        <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMenu">Tambah Menu</a>
        <div class="toast-container">
            <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-semibold">Tips</div>
                            <small>Ihza</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body"> uncheck Access Management before delete the menu.
                        </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header"><?= $sub['title'] ?></h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                        $i = 1;
                        foreach ($menu as $m) :
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $m['menu'] ?></strong></td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url('menu/ubah/') , $m['id'] ?>"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="<?= base_url('menu/hapus/') , $m['id'] ?>" onclick="return confirm('yakin')"
                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                                </div>
                            </div>
                            </td>
                            </tr>
                        <?php
                        endforeach
                    ?>
                </tbody>
                </table>
            </div>
        </div>
        <hr class="my-5" />
            <!-- Modal -->
        <div class="modal fade" id="newMenu" tabindex="-1" aria-labelledby="newMenuLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newMenuLabel">Tambah Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('menu') ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="menu" id="menu" class="form-control" placeholder="nama menu">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
