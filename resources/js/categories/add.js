require('../master');
$(document).ready(function () {
	let modalAddCategory = $('#modal-add-category');
	let modalEditCategory = $('#modal-edit-category');

	// handle when btn add category click
	$('#btn-add-category').on('click', function () {
		$('.page-loading').fadeIn();
		$.ajax({
			url: '/categories/create',
			type: 'get',
			success: function (response) {
				$('.page-loading').fadeOut();
				modalAddCategory.html(response.data).modal('show');
				modalEditCategory.empty();
				$('.select-category-parent').select2({dropdownParent: '#modal-add-category .modal-content'});
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.page-loading').fadeOut();
			}
		});
	})

	// handle when save category click
	$(document).on('click', '#add-category', function () {
		$('.page-loading').fadeIn();
		$.ajax({
			url: '/categories',
			type: 'post',
			data: $('#form-add-category').serialize(),
			success: function (response) {
				$('.page-loading').fadeOut();
				modalAddCategory.modal('hide');
				$('#frm-search input[name="page"]').val(1);
				getLists('/categories/search');
				toastr.success('Thêm category thành công!', 'Thông báo')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.page-loading').fadeOut();
				if (jqXHR.status === 422) {
					let errors = jqXHR.responseJSON.errors;
					setError(errors, '#form-add-category');
				} else {
					toastr.error('Thêm category thất bại!', 'Lỗi')
				}
			}
		});
	})
})
