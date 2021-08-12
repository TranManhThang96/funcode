require('../master');
$(document).ready(function () {
  $('.custom-select-2').select2();

  $(document).on('change', '#select-per-page', function () {
    $('#frm-search input[name="page"]').val(1);
    $('#frm-search input[name="per_page"]').val($(this).val());
    getLists('/articles/search');
  })

  $(document).on('click', '#btn-search', function (e) {
    e.preventDefault();
    $('#frm-search input[name="page"]').val(1);
    getLists('/articles/search');
  })

  $(document).on('click', '.page-item .page-link', function (e) {
    e.preventDefault();
    let page = $(this).text();
    changePage(page, '/articles/search');
  });

  //delete
  $(document).on('click', '.btn-delete-article', function () {
    let articleId = $(this).data('article-id');
    modalConfirm().then(function (confirm) {
      if (confirm) {
        $.ajax({
          url: `/articles/${articleId}`,
          type: 'DELETE',
          loading: true,
          success: function (response) {
            toastr.success('Xóa series thành công!', 'Thông báo');
            getLists('/articles/search');
          },
          error: function (jqXHR, textStatus, errorThrown) {
            toastr.success('Xóa series thất bại!', 'Thông báo')
          }
        });
      }
    })
  })

  //sorting
  $(document).on('click', '.sorting', function () {
    let enums = variableDefined();
    let sortingClass = $(this).hasClass(enums.SORTING_ASC_CLASS) ? enums.SORTING_ASC_CLASS : $(this).hasClass(enums.SORTING_DESC_CLASS) ? enums.SORTING_DESC_CLASS : null;
    let sort_by = $(this).data('sort-by');
    let order_by = enums.ORDER_BY_ASC;
    if (sortingClass) {
      if (sortingClass === enums.SORTING_ASC_CLASS) {
        $(this).removeClass(enums.SORTING_ASC_CLASS).addClass(enums.SORTING_DESC_CLASS);
        order_by = enums.ORDER_BY_DESC;
      } else {
        $(this).removeClass(enums.SORTING_DESC_CLASS).addClass(enums.SORTING_ASC_CLASS);
        order_by = enums.ORDER_BY_ASC;
      }
    } else {
      $('.sorting').removeClass(enums.SORTING_ASC_CLASS).removeClass(enums.SORTING_DESC_CLASS);
      $(this).addClass(enums.SORTING_ASC_CLASS);
      order_by = enums.ORDER_BY_ASC;
    }
    $('#frm-search input[name="sort_by"]').val(sort_by);
    $('#frm-search input[name="order_by"]').val(order_by);
    getLists('/articles/search');
  })
})

