                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-muted m-1">Copyright &copy; Ihza <?= date('Y') ?></div>
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
        <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url()?>assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url()?>assets/demo/chart-area-demo.js"></script>
        <script src="<?= base_url()?>assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url()?>assets/js/datatables-simple-demo.js"></script>
        <script src="<?= base_url()?>assets/js/jquery-3.7.0.min.js"></script>
        <script>
            $(".form-check-input").on("click", function () {
                const menuId = $(this).data("menu");
                const roleId = $(this).data("role");

                $.ajax({
                    url: "<?= base_url('admin/changeaccess') ?>",
                    type: "post",
                    data: {
                        menuId: menuId,
                        roleId: roleId,
                    },
                    success: function () {
                        document.location.href =
                            "<?= base_url('admin/roleaccess/') ?>" + roleId;
                    },
                });
            });
        </script>
    </body>
</html>
