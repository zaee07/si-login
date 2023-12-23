<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title ?></h1>
        <div class="row mt-6">
            <div class="col-md-6">
                <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $sub_menu['id'] ?>">
                    <div class="form-group mb-3">
                        <input type="text" name="title" id="title" class="form-control" placeholder="nama sub menu" value="<?= $sub_menu['title'] ?>">
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
                        <input type="text" name="url" id="url" class="form-control" placeholder="url sub menu" value="<?= $sub_menu['url'] ?>">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="icon" id="icon" class="form-control" placeholder="icon sub menu" value="<?= $sub_menu['icon'] ?>">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input1" type="checkbox" name="is_active" id="is_active" <?= check($sub_menu['id']) ?> >
                        <label class="form-check-label" for="is_active1">Aktif ?</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah Sub Menu</button>
                    <a href="<?= base_url('menu/submenu') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</main>