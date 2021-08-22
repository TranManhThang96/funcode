require('../master');
$(document).ready(function () {
  let modalAddSeries = $('#modal-add-series');
  let modalEditSeries = $('#modal-edit-series');

  // handle when btn add series click
  $('#btn-add-series').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/series/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddSeries.html(response.data).modal('show');
        modalEditSeries.empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
      }
    });
  })

  // handle when save series click
  $(document).on('click', '#add-series', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/series',
      type: 'post',
      data: $('#form-add-series').serialize(),
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddSeries.modal('hide');
        $('#frm-search input[name="page"]').val(1);
        getLists('/series/search');
        toastr["success"](response.msg);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-add-series');
        } else {
          modalAddSeries.modal('hide');
          toastr["error"](jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})
