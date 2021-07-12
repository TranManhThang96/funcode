require('../master');
$(document).ready(function () {
  $(document).on('change', '#select-per-page', function () {
    $('#frm-search input[name="page"]').val(1);
    $('#frm-search input[name="per_page"]').val($(this).val());
    getLists('/series/search');
  })

  $(document).on('click', '#btn-search', function (e) {
    e.preventDefault();
    $('#frm-search input[name="page"]').val(1);
    getLists('/series/search');
  })

  $(document).on('click', '.page-item .page-link', function (e) {
    e.preventDefault();
    let page = $(this).text();
    changePage(page, '/series/search');
  });

  $(document).on('click', '.btn-delete-series', function () {
    let seriesId = $(this).data('series-id');
    modalConfirm().then(function (confirm) {
      if (confirm) {
        $.ajax({
          url: `/series/${seriesId}`,
          type: 'DELETE',
          loading: true,
          success: function (response) {
            toastr.success('Xóa series thành công!', 'Thông báo');
            getLists('/series/search');
          },
          error: function (jqXHR, textStatus, errorThrown) {
            toastr.success('Xóa series thất bại!', 'Thông báo')
          }
        });
      }
    })
  })
})

