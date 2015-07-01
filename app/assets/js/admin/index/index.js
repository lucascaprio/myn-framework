(function () {
	'use strict';

	var $, Login;

	$ = jQuery;

	Login = {
		init: function () {
			this.events();
		},

		events: function () {
			$('#btnLogin').click(function (e) {
				e.preventDefault();
				var email = $('#txtEmail');
				var senha = $('#txtSenha');

				if(email.val() === '')
					email.focus();
				else if(senha.val() === '')
					senha.focus();
				else
					App.post('admin/index/login', { email: email.val(), senha: senha.val() }, function callbackLogin (response) {
						if( response.status )
							window.location.href = App.url +'admin/home';
						else {
							$('#titleModalInfo').html("Erro no login");
							$('#txtModalInfo').html('Houve algum erro no seu login, verifique se os dados informados estão corretos!');
							$('#myModalInfo').modal({'show' : true, 'keyboard' : true });
						}			
					});
			});

			$('#txtEmail, #txtSenha').keypress(function(event) {
				if( event.which == 13) {
					$('#btnLogin').click();
					event.preventDefault();
				}
			});
		}
	};

	$(document).ready(function () {
		Login.init();
	});
}());