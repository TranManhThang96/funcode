$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': window.$('meta[name="csrf-token"]').attr('content')
  },
  beforeSend: function () {
  },
  complete: function (res) {
    if (res['responseText'] == 'Session timeout occurred. Please login again') {
      window.location.href = '/';
    }
  }
});
