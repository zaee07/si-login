            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?= $title ?></h1>
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $this->session->flashdata('message') ?>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="<?= base_url('assets1/img/avatars/') . $user['image']  ?>" class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $user['name'] ?></h5>
                                <p class="card-text"><?= $user['email'] ?></p>
                                <p class="card-text"><small class="text-body-secondary">Dibuat <?= date('d-m-Y', $user['created'])  ?></small></p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </main>