tinymce.init({
  selector: 'textarea#editor',
  plugins: `print preview importcss tinydrive searchreplace
  autolink autosave save directionality visualblocks
  visualchars fullscreen image link media template
  codesample table charmap hr pagebreak nonbreaking anchor
  toc insertdatetime advlist lists
  wordcount imagetools textpattern noneditable help charmap quickbars emoticons`,
  menu: {
    tc: {
      title: 'Comments',
      items: 'addcomment showcomments deleteallconversations'
    }
  },
  menubar: 'file edit view insert format tools table tc help',
  toolbar: `undo redo |
  bold italic underline strikethrough |
  fontselect fontsizeselect formatselect |
  alignleft aligncenter alignright alignjustify |
  codesample image |
  outdent indent |
  numlist bullist checklist |
  forecolor backcolor casechange permanentpen formatpainter removeformat |
  pagebreak | charmap emoticons | fullscreen  preview save print |
  insertfile media pageembed template link anchor |
  a11ycheck ltr rtl | showcomments addcomment`,
  content_css: ['/assets/libs/prism/prism.css'],
  file_picker_callback: function (callback, value, meta) {
    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

    let type = 'image' === meta.filetype ? 'Images' : 'Files',
      url = '/filemanager?editor=tinymce5&type=' + type;
    tinymce.activeEditor.windowManager.openUrl({
      url: url,
      title: 'Filemanager',
      width: x * 0.8,
      height: y * 0.8,
      onMessage: (api, message) => {
        callback(message.content);
      }
    });
  }
});
