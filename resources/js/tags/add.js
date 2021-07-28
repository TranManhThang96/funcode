require('../master');
$(document).ready(function () {
	let modalAddTag = $('#modal-add-tag');
	let modalEditTag = $('#modal-edit-tag');

	// handle when btn add tag click
	$('#btn-add-tag').on('click', function () {
		$('.page-loading').fadeIn();
		$.ajax({
			url: '/tags/create',
			type: 'get',
			success: function (response) {
				$('.page-loading').fadeOut();
        modalAddTag.html(response.data).modal('show');
        modalEditTag.empty();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.page-loading').fadeOut();
			}
		});
	})

	// handle when save tag click
	$(document).on('click', '#add-tag', function () {
		$('.page-loading').fadeIn();
		$.ajax({
			url: '/tags',
			type: 'post',
			data: $('#form-add-tag').serialize(),
			success: function (response) {
				$('.page-loading').fadeOut();
				modalAddTag.modal('hide');
				$('#frm-search input[name="page"]').val(1);
				getLists('/tags/search');
				toastr.success('Thêm tag thành công!', 'Thông báo')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.page-loading').fadeOut();
				if (jqXHR.status === 422) {
					let errors = jqXHR.responseJSON.errors;
					setError(errors, '#form-add-tag');
				} else {
					toastr.error('Thêm tag thất bại!', 'Lỗi')
				}
			}
		});
	})
})
