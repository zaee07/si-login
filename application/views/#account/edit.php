            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?= $title ?></h1>
                        <div class="row">
                            <div class="col-lg-8">
                                <?= form_open_multipart('user/edit') ?>
                                    <div class="form-group row">
                                        <label for="email" class="form-label">Email address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama" class="form-label">name address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['name'] ?>">
                                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="form-label">Picture</label>
                                        <div class="input-group">
                                            <img src="<?= base_url('assets/img/'.$user['image']) ?>" class="img-thumbnail rounded-circle" width="100">
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="image" name="image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>