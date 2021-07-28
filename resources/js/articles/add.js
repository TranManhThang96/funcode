require('../master');
$(document).ready(function () {
  $('.custom-select-2').select2({
    placeholder: "Select a option",
  });

  $('.select-tags').select2({
    placeholder: "Select a state",
    tags: true,
    tokenSeparators: [',', ' ']
  });

  $('#articles-image-remove').click(function () {
    var target_input = document.getElementById('image-input');
    var target_preview = document.getElementById('image-preview');
    target_input.value="";
    target_preview.src="/assets/images/no-image.png"
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

  // tinymce.init({
  //   selector: 'textarea#editor',
  //   plugins: [
  //     "image imagetool codesample",
  //   ],
  //   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | codesample",
  //   codesample_global_prismjs: true,
  //   file_picker_callback: function (callback, value, meta) {
  //     let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
  //     let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
  //
  //     let type = 'image' === meta.filetype ? 'Images' : 'Files',
  //       url  = '/filemanager?editor=tinymce5&type=' + type;
  //     tinymce.activeEditor.windowManager.openUrl({
  //       url : url,
  //       title : 'Filemanager',
  //       width : x * 0.8,
  //       height : y * 0.8,
  //       onMessage: (api, message) => {
  //         callback(message.content);
  //       }
  //     });
  //   }
  // });

  var quill = new Quill('#editor', {
    modules: {
      syntax: true,              // Include syntax module,
      toolbar: '#toolbar-container'
    },
    placeholder: 'Please write your content here ...',
    theme: 'snow'
  });

  $('#btn-submit').click(function (e) {
    e.preventDefault();
    if (!$('.ql-editor').hasClass('ql-blank')) {
      $("textarea[name='content']").val($('.ql-editor').html());
    }
    $("#articles-frm").submit();
  })
})
