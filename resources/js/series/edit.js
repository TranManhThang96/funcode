require('../master');
$(document).ready(function () {
	let modalEditSeries = $('#modal-edit-series');
	let modalAddSeries = $('#modal-add-series');

	// handle when btn add series click
	$(document).on('click', '.btn-edit-series', function () {
		let seriesId = $(this).data('series-id');
		$.ajax({
			url: `/series/${seriesId}/edit`,
			type: 'get',
			loading: true,
			success: function (response) {
				modalEditSeries.html(response.data).modal('show');
				modalAddSeries.empty();
			},
			error: function (jqXHR, textStatus, errorThrown) {
			}
		});
	})

	// handle when save series click
	$(document).on('click', '#edit-series', function () {
		$('.page-loading').fadeIn();
		let seriesId = $('#form-edit-series #series-id').val();
		$.ajax({
			url: `/series/${seriesId}`,
			type: 'put',
			data: $('#form-edit-series').serialize(),
			success: function (response) {
				$('.page-loading').fadeOut();
				modalEditSeries.modal('hide');
				$('#frm-search input[name="page"]').val(1);
				getLists('/series/search');
				toastr.success('Update series thành công!', 'Thông báo')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.page-loading').fadeOut();
				if (jqXHR.status === 422) {
					let errors = jqXHR.responseJSON.errors;
					setError(errors, '#form-edit-series');
				} else {
					toastr.error('Thêm series thất bại!', 'Lỗi')
				}
			}
		});
	})
})

