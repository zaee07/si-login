$(function () {
	console.log("tes");
	$(".tambah").on("click", function () {
		console.log("ok");
		$("#newMenuLabel").html("Tambah Menu");
		$(".modal-footer button[type=submit]").html("Tambah Menu");
	});
	$(".ubah").on("click", function () {
		console.log("okee");
		$("#newMenuLabel").html("Ubah Menu");
		$(".modal-footer button[type=submit]").html("Ubah Menu");

		$(".modal-body form").attr("action", "http://localhost/login/menu/ubah");

		const id = $(this).data("id");

		$.ajax({
			url: "http://localhost/login/menu/ubah",
			data: { id: id },
			method: "post",
			dataType: "json",
			success: function (data) {
				// console.log(data);
				$("#menu").val(data.menu);
				$("#id").val(data.id);
			},
		});
	});
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
					"<?= base_url('admin/changeaccess/') ?>" + roleId;
			},
		});
	});
});
