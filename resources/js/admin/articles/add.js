require('../master');
$(document).ready(function () {
  let modalAddCategory = $('#modal-add-category');
  let modalAddSeries = $('#modal-add-series');

  // handle when btn add category click
  $('#btn-add-category').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/categories/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddCategory.empty().html(response.data).modal('show');
        $('.select-category-option').select2({dropdownParent: '#modal-add-category .modal-content'});
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
      data: {
        name: $("#modal-add-category input[name='name']").val(),
        parent_id: $("#modal-add-category select[name='parent_id']").val(),
        page: 'articles'
      },
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddCategory.modal('hide');
        $('#articles-categories-options').empty().html(response.data.view);
        $('.select-category-option').select2();
        toastr.success('Thêm category thành công!', 'Thông báo')
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#modal-add-category');
        } else {
          toastr.error('Thêm category thất bại!', 'Lỗi')
        }
      }
    });
  })

  // handle when btn add series click
  $('#btn-add-series').on('click', function () {
    $('.page-loading').fadeIn();
    $.ajax({
      url: '/series/create',
      type: 'get',
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddSeries.html(response.data).modal('show');
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
      data: {
        name: $("#modal-add-series input[name='name']").val(),
        page: 'articles'
      },
      success: function (response) {
        $('.page-loading').fadeOut();
        modalAddSeries.modal('hide');
        $('#articles-series-options').empty().html(response.data.view);
        $('.select-series-option').select2();
        toastr.success('Thêm series thành công!', 'Thông báo')
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.page-loading').fadeOut();
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON.errors;
          setError(errors, '#modal-add-series');
        } else {
          toastr.error('Thêm series thất bại!', 'Lỗi')
        }
      }
    });
  })

  $('.custom-select-2').select2({
    placeholder: "Select a option",
  });

  $('.select-tags').select2({
    placeholder: "",
    tags: true,
    tokenSeparators: [',', ' ']
  });

  $('#articles-image-remove').click(function () {
    var target_input = document.getElementById('image-input');
    var target_preview = document.getElementById('image-preview');
    target_input.value = "";
    target_preview.src = "/assets/images/no-image.png"
  })

  $('#image-preview').click(function () {
    var route_prefix = '/filemanager';
    var target_input = document.getElementById('image-input');
    var target_preview = document.getElementById('image-preview');

    window.open(route_prefix + '?type=' + 'image' || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = function (items) {
      var file_path = items.map(function (item) {
        return item.url;
      }).join(',');
      // set the value of the desired input to image url
      target_input.value = file_path;
      target_input.dispatchEvent(new Event('change'));

      // clear previous preview
      target_preview.src = file_path;

      // trigger change event
      target_preview.dispatchEvent(new Event('change'));
    };
  })

  $('#btn-submit').click(function (e) {
    e.preventDefault();
    if (!$('.ql-editor').hasClass('ql-blank')) {
      $("textarea[name='content']").val($('.ql-editor').html());
    }
    $("#articles-frm").submit();
  })
})
