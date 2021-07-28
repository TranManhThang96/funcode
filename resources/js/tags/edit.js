require('../master');
$(document).ready(function () {
  let modalEditTag = $('#modal-edit-tag');
  let modalAddTag = $('#modal-add-tag');

  // handle when btn add tag click
  $(document).on('click', '.btn-edit-tag', function () {
    let tagId = $(this).data('tag-id');
    $.ajax({
      url: `/tags/${tagId}/edit`,
      type: 'get',
      loading: true,
      success: function (response) {
        modalEditTag.html(response.data).modal('show');
        modalAddTag.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
      }
    });
  })

  // handle when save tag click
  $(document).on('click', '#edit-tag', function () {
    let tagId = $('#form-edit-tag #tag-id').val();
    $.ajax({
      url: `/tags/${tagId}`,
      type: 'put',
      loading: true,
      data: $('#form-edit-tag').serialize(),
      success: function (response) {
        modalEditTag.modal('hide');
        toastr.success('Update tag thành công!', 'Thông báo')
        $('#frm-search input[name="page"]').val(1);
        getLists('/tags/search');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-tag');
        } else {
          toastr.error('Thêm tag thất bại!', 'Lỗi')
        }
      }
    });
  })
})

