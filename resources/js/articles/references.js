$(document).ready(function () {
  let links = [];
  let editLink = null;
  init();
  $(window).keydown(function (e) {
    if (e.keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });
  function init() {
    $('#link-references-group .references-item').each(function (index, element) {
      let link = $(this).find("input[name='link_references[]']").val();
      links.push(link);
    });
  }
  let linkReferencesInput = $('#link-references-input');
  linkReferencesInput.bind("enterKey", function (e) {
    let link = e.target.value;
    // validate link
    let isValidLink = validateLink(link);
    if (!isValidLink) {
      toastr.warning('Link không hợp lệ!', 'Cảnh báo');
      return;
    }

    if (editLink) {
      editReferences(link);
    } else {
      addReferences(link);
    }
  });
  linkReferencesInput.keyup(function (e) {
    if (e.keyCode === 13) {
      $(this).trigger("enterKey");
    }
  });

  function checkLinkExist(link) {
    return links.includes(link);
  }

  function pushLinkDom(link) {
    let template = `<div class="row references-item mb-2">
                            <div class="col-9">
                                <input type="text" value="${link}" name="link_references[]" class="form-control" data-toggle="tooltip" title="${link}" readonly>
                            </div>
                            <div class="col-3 d-flex justify-content-between align-items-center actions">
                                <i class="mdi mdi-link btn-references-access" data-link="${link}"></i>
                                <i class="mdi mdi-tooltip-edit btn-references-edit" data-link="${link}"></i>
                                <i class="mdi mdi-delete btn-references-delete" data-link="${link}"></i>
                            </div>
                        </div>`;
    $('#link-references-group').append(template);
  }

  function clearInputReferencesInput() {
    $('#link-references-input').val('');
    editLink = null;
  }

  function addReferences(link) {
    // check link exist
    let linkExist = checkLinkExist(link);
    if (!linkExist) {
      // push
      links.push(link);

      // push dom
      pushLinkDom(link);

      // clear input
      clearInputReferencesInput();
    } else {
      //clear input
      clearInputReferencesInput();
      toastr.warning('Link đã tồn tại', 'Thông báo');
    }
  }

  function editReferences(link) {
    // not change
    if (link === editLink.toString()) {
      //clear input
      clearInputReferencesInput();
      toastr.info('Link không thay đổi', 'Thông báo');
      return;
    }

    // check link exist
    let linkExist = checkLinkExist(link);
    if (!linkExist) {
      // edit links array
      for (let index in links) {
        if (links[index] === editLink.toString()) {
          links[index] = link
          break; //Stop this loop, we found it!
        }
      }

      // edit dom
      $('#link-references-group .references-item').each(function (index, element) {
        let inputReferences = $(this).find("input[name='link_references[]']");
        if (inputReferences.val() === editLink.toString()) {
          $(this).empty().html(`<div class="col-9">
                                        <input type="text" value="${link}" name="link_references[]" class="form-control" data-toggle="tooltip" title="${link}" readonly>
                                      </div>
                                      <div class="col-3 d-flex justify-content-between align-items-center actions">
                                          <i class="mdi mdi-link btn-references-access" data-link="${link}"></i>
                                          <i class="mdi mdi-tooltip-edit btn-references-edit" data-link="${link}"></i>
                                          <i class="mdi mdi-delete btn-references-delete" data-link="${link}"></i>
                                      </div>`)
          return false; // breaks
        }
      });

      toastr.success('Cập nhật thành công', 'Thông báo');

      // clear input
      clearInputReferencesInput();
    } else {
      //clear input
      clearInputReferencesInput();
      toastr.warning('Link đã tồn tại', 'Thông báo');
    }
  }

  // validate
  function validateLink(link) {
    let linkRegex = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;
    link.replace(/\s/g, '')
    return linkRegex.test(link);
  }

  // access
  $(document).on('click', '.btn-references-access', function () {
    let link = $(this).data('link');
    window.open(link, '_blank');
  })

  // edit
  $(document).on('click', '.btn-references-edit', function () {
    let link = $(this).data('link');
    editLink = link;
    $('#link-references-input').val(link).focus();
  })

  // delete
  $(document).on('click', '.btn-references-delete', function () {
    let referencesDeleteButton = $(this);
    modalConfirm().then(function (confirm) {
      if (confirm) {
        let link = referencesDeleteButton.data('link');

        // delete links array
        const index = links.indexOf(link);
        if (index > -1) {
          links.splice(index, 1);
        }

        // delete dom
        referencesDeleteButton.parent().parent().remove();
      }
    })
  })
})
