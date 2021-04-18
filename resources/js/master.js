/**
 * reset errors.
 */
resetError = () => {
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
};

/**
 * set errors.
 * @param errors
 * @param parentElement
 */
setError = (errors, parentElement = '') => {
    resetError();
    for (let error in errors) {
        let form_control;
        form_control = parentElement ? $(`${parentElement} .form-control[name="${error}"], ${parentElement} .custom-select[name="${error}"]`) : $(`.form-control[name="${error}"], .custom-select[name="${error}"]`);

        if (typeof form_control !== 'undefined') {
            form_control.addClass('is-invalid');
            form_control.parent().append(`<div class="invalid-feedback text-nowrap">${errors[error][0]}</div>`);
        }
    }
};

/**
 * handle when change page.
 * @param page
 */
changePage = (page, parentElement = null) => {
    if (!isNaN(page)) {
        $('#frm-search input[name="page"]').val(page);
    } else {
        let pageCurrent = 1;
        if (parentElement) {
            pageCurrent = parseInt($(`${parentElement} .page-item.active .page-link`).text());
        } else {
            pageCurrent = parseInt($('.page-item.active .page-link').text());
        }

        if (page === '›') {
            console.log('co vao day')
            let pageMax = $('.page-item:last').prev().children().text();
            console.log('co vao day', pageMax)
            console.log('co vao day', pageCurrent)
            if (pageMax > pageCurrent) {
                $('#frm-search input[name="page"]').val(pageCurrent + 1);
            }
        } else {
            if (pageCurrent > 1) {
                $('#frm-search input[name="page"]').val(pageCurrent - 1);
            }
        }
    }
    getLists();
};

/**
 * get lists.
 * @param successFunc
 * @param errorFunc
 */
getLists = (url = 'search', successFunc = null, errorFunc = null) => {
    $.ajax({
        type: 'GET',
        url: url,
        loading: true,
        data: $('#frm-search').serialize(),
    }).then(function (xhr) {
        $('#data-table').html(xhr.data);
        if (typeof successFunc === 'function') {
            successFunc(xhr);
        }
    }).catch(function (xhr) {
        // $('#data-table').html(xhr.responseJSON);
        if (typeof errorFunc === 'function') {
            errorFunc(xhr);
        }
    });
};
