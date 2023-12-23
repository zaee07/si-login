<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title ?></h1>
        <div class="row mt-6 mx-6">
            <div class="col-md-6">
                <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $menu['id'] ?>">
                    <div class="form-group">
                        <input type="text" name="menu" id="menu" class="form-control" placeholder="nama menu" value="<?= $menu['menu'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah Menu</button>
                    <a href="<?= base_url('menu') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</main>