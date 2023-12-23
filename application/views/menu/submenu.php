            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?= $title ?></h1>
                        <div class="row">
                            <div class="col-lg-8">
                                <?php
                                if( validation_errors() ) {
                                    echo '<div class="alert alert-danger">'.validation_errors().'</div>';
                                }
                                ?>
                                <?= $this->session->flashdata('message') ?>
                                <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newSubMenu">Tambah Sub Menu</a>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Url</th>
                                            <th scope="col">Icon</th>
                                            <th scope="col">Active</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($subMenu as $sm) :
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $sm['title'] ?></td>
                                            <td><?= $sm['menu'] ?></td>
                                            <td><?= $sm['url'] ?></td>
                                            <td><?= $sm['icon'] ?></td>
                                            <td><?= $sm['is_active'] ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a href="<?= base_url('menu/sub_edit/') , $sm['id'] ?>" class="badge text-bg-success text-decoration-none">Ubah</a>
                                                <a href="<?= base_url('menu/sub_hapus/') , $sm['id'] ?>" class="badge text-bg-danger text-decoration-none" onclick="return confirm('yakin?')">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php
                                        endforeach
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Modal -->
                <div class="modal fade" id="newSubMenu" tabindex="-1" aria-labelledby="newSubMenuLabel" aria-hidden="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="newSubMenuLabel">Tambah Sub Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('menu/submenu') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <input type="text" name="title" id="title" class="form-control" placeholder="nama sub menu">
                                </div>
                                <div class="form-group mb-3">
                                    <select name="menu_id" id="menu_id" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php
                                        foreach($menu as $m) :
                                            echo '<option value="'. $m['id'] . '">'. $m['menu'] . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" name="url" id="url" class="form-control" placeholder="url">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" name="icon" id="icon" class="form-control" placeholder="icon">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="active" name="is_active" checked>
                                        <label class="form-check-label" for="active">Active?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Tambah Sub Menu</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
