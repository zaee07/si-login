        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Change Password</h3></div>
                                    <?= $this->session->userdata('reset_email') ?>
                                    <div class="card-body">
                                        <form method="post" action="<?= base_url('auth/changePassword') ?>">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password1" name="password1" type="password" autocomplete="off" />
                                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>');?>
                                                <label for="password1">New passsword</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password2" name="password2" type="password" autocomplete="off" />
                                                <?= form_error('password2', '<small class="text-danger pl-3">', '</small>');?>
                                                <label for="password2">Confirm New passsword</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-success" type="submit" >Change Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>