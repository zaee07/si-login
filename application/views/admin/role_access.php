            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?= $title ?></h1>
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $this->session->flashdata('message') ?>
                                <h5>Role : <?= $role['role'] ?></h5>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Access</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($menu as $m) :
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $m['menu'] ?></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input admin-role" type="checkbox" <?= check_access($role['id'], $m['id']) ?> data-role="<?= $role['id'] ?>" data-menu="<?= $m['id'] ?>" >
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
                        <div class="col-lg-6 text-center">
                            <a href="<?= base_url('admin/role') ?>" class="btn btn-danger">kembali</a>
                        </div>
                    </div>
                </main>