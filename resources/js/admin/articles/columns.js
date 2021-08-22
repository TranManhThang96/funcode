$(document).ready(function () {
  let columns = [];  //tat cac cac options
  let columnsChecked = []; // cac options dc checked
  init();

  function init() {
    // lay tu localstorage an vao columnsChecked
    let articlesColumns = window.localStorage.getItem('articles_columns');
    if (!articlesColumns) {
      articlesColumns = JSON.parse(articlesColumns);
    }

    // khoi tao columns
    $('.columns .body li').each(function (index, element) {
      let elementValue = $(element).find('.form-check-input').val();
      if (!columns.includes(elementValue)) {
        columns.push(elementValue);
      }

      // cap nhat columnsChecked
      if (articlesColumns && articlesColumns.includes(elementValue) && !columnsChecked.includes(elementValue)) {
        columnsChecked.push(elementValue);
        $(element).find('.form-check-input').prop('checked', true);
      }
    })

    // cap nhat nut update all
    if (columns.length === columnsChecked.length && columns.length > 0) {
      $('#articles-all-columns').prop('checked', true);
    }

    // cap nhat dom
    if (articlesColumns) {
      updateDom();
    }

    // update session
    updateSession();
  }

  // hien thi popup cho chon checkbox
  $('.toggle-options-button').click(function () {
    if ($('.toggle-options').hasClass('hidden')) {
      $('.toggle-options').removeClass('hidden').addClass('show');
    } else {
      $('.toggle-options').removeClass('show').addClass('hidden');
    }
  })

  // click vao checkbox all
  $(document).on('click', '#articles-all-columns', function () {
    let isCheckAll = $(this).is(':checked');
    $('.columns ul li').each(function (index, element) {
      $(element).find('.form-check-input').prop('checked', isCheckAll);
    })
  })

  $(document).on('click', '#btn-check-columns', function () {
    columnsChecked = [];
    $('.columns .body li').each(function (index, element) {
      let isCheck = $(element).find('.form-check-input').is(':checked');
      if (isCheck) {
        columnsChecked.push($(element).find('.form-check-input').val());
      }
      // update columnsChecked vao localstorage
      window.localStorage.setItem('articles_columns', JSON.stringify(columnsChecked));
    })

    // cap nhat dom
    updateDom();

    // close
    $('.toggle-options').removeClass('show').addClass('hidden');

    // update session
    updateSession();
  })

  // check tung input khi click vao checkbox
  $('.columns .body input[type="checkbox"]').change(function () {
    columnsChecked = [];
    $('.columns .body li').each(function (index, element) {
      let isCheck = $(element).find('.form-check-input').is(':checked');
      if (isCheck) {
        columnsChecked.push($(element).find('.form-check-input').val());
      }
    })

    // cap nhat nut update all
    if (columns.length === columnsChecked.length && columns.length > 0) {
      $('#articles-all-columns').prop('checked', true);
    } else {
      $('#articles-all-columns').prop('checked', false);
    }
  });

  function updateDom() {
    for (let column of columns) {
      if (columnsChecked.includes(column)) {
        $(`.${column}`).removeClass('column-hidden').addClass('column-show');
      } else {
        $(`.${column}`).removeClass('column-show').addClass('column-hidden');
      }
    }
  }

  function updateSession() {
    $.ajax({
      url: `/articles/columns`,
      type: 'POST',
      loading: true,
      data: {
        articles_columns: columnsChecked
      }
    });
  }
})
