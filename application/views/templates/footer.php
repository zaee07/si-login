<footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © <?= date('Y') ?>, made with ❤️ by
                  <a href="https://zaee07.my.id" target="_blank" class="footer-link fw-bolder">Ihza</a>
                </div>
                <div>
                  <a href="https://github.com/zaee07/zaee07" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://github.com/zaee07/zaee07" target="_blank" class="footer-link me-4" >Support</a>
                </div>
              </div>
            </footer>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <div class="buy-now">
      <a
        href="https://github.com/zaee07/zaee07"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Hubungi kami</a
      >
    </div>
    <script src="<?= base_url() ?>/assets1/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>/assets1/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url() ?>/assets1/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>/assets1/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>/assets1/vendor/js/menu.js"></script>
    <script src="<?= base_url() ?>/assets1/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="<?= base_url() ?>/assets1/js/main.js"></script>
    <script src="<?= base_url() ?>/assets1/js/dashboards-analytics.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
            $(".admin-role").on("click", function () {
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