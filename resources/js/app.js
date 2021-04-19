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
