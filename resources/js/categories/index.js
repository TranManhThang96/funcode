require('../master');
$(document).ready(function () {
	$(document).on('change', '#select-per-page', function () {
		$('#frm-search input[name="page"]').val(1);
		$('#frm-search input[name="per_page"]').val($(this).val());
		getLists();
	})
	
	$(document).on('click', '#btn-search', function (e) {
		e.preventDefault();
		$('#frm-search input[name="page"]').val(1);
		getLists();
	})
	
	$(document).on('click', '.page-item .page-link', function (e) {
		e.preventDefault();
		let page = $(this).text();
		changePage(page);
	});
})

