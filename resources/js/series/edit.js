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
    let seriesId = $('#form-edit-series #series-id').val();
    $.ajax({
      url: `/series/${seriesId}`,
      type: 'put',
      loading: true,
      data: $('#form-edit-series').serialize(),
      success: function (response) {
        modalEditSeries.modal('hide');
        toastr.success(response.msg);
        $('#frm-search input[name="page"]').val(1);
        getLists('/series/search');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#form-edit-series');
        } else {
          modalEditSeries.modal('hide');
          toastr.error(jqXHR.responseJSON.userMsg);
        }
      }
    });
  })
})

