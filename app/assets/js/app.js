var App = {

	url: window.URL,

	post: function (url, data, callback) {
		$.ajax({
			type: 'POST',
			url: App.url + url,
			data: data,
		}).done(function (data) {
			if (callback !== null && callback !== undefined) {
				data = jQuery.parseJSON(data);
				callback(data);
			}
		}).fail(function( jqXHR, textStatus, errorThrown ) {
			App.log({ jqXHR : jqXHR, textStatus : textStatus, errorThrown : errorThrown });
		});
	},

	redirect: function (url) {
		window.location.href = App.url + url;
	},

	validate: function (fields) {
		for (var field in fields) {
			if (fields[field].val() === '') {
				fields[field].focus();
				return false;
			}
		}
		return true;
	}
};