require('../master');
$(document).ready(function () {
  let modalEditCategory = $('#modal-edit-category');
  let modalAddCategory = $('#modal-add-category');

  // handle when btn add category click
  $(document).on('click', '.btn-edit-category', function () {
    let categoryId = $(this).data('category-id');
    $.ajax({
      url: `/categories/${categoryId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditCategory.html(response.data).modal('show');
        modalAddCategory.empty();
        $('.select-category-parent').select2({dropdownParent: '#modal-edit-category .modal-content'});
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save category click
  $(document).on('click', '#edit-category', function () {
    $('.page-loading').fadeIn();
    let categoryId = $('#form-edit-category #category-id').val();
    $.ajax({
      url: `/categories/${categoryId}`,
      type: 'put',
      data: $('#form-edit-category').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalEditCategory.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/categories/search');
        toastr.success(response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-category');
        } else {
          modalEditCategory.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

