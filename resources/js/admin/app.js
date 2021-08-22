let pageLoadingElement = $('.page-loading');
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': window.$('meta[name="csrf-token"]').attr('content')
	},
	beforeSend: function () {
		if (this.loading) {
			pageLoadingElement.fadeIn();
		}
	},
	complete: function (res) {
		if (this.loading) {
			pageLoadingElement.fadeOut();
		}
		if (res['responseText'] == 'Session timeout occurred. Please login again') {
			window.location.href = '/';
		}
	}
});

$(document).ready(function () {
  window.toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
});
