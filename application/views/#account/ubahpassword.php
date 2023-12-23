            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?= $title ?></h1>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="col-lg-6">
                                    <?= $this->session->flashdata('message') ?>
                                </div>
                                <form action="<?= base_url('user/ubahpassword') ?>" method="post">
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">password saat ini</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                        <?= form_error('current_password', '<smal class="text-danger pl-3">','</smal>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password1" class="form-label">Password baru</label>
                                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                                        <?= form_error('new_password1', '<smal class="text-danger pl-3">','</smal>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password2" class="form-label">Password konfirmasi</label>
                                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                                        <?= form_error('new_password2', '<smal class="text-danger pl-3">','</smal>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success">Ubah Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>