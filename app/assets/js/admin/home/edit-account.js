$('#btnEditar').on('click', function() {
	var fields = {
		email        : $("#txtEmail"),
		password     : $("#txtSenha"),
		newPassword  : $("#txtNovaSenha"),
		confPassword : $("#txtConfirmaSenha")
	};

	if (App.validate(fields)) {
		if (fields.newPassword.val() == fields.confPassword.val()) {
			var data = {
				email        : fields.email.val(),
				password     : fields.password.val(),
				newPassword  : fields.newPassword.val(),
				confPassword : fields.confPassword.val()
			};

			App.post('admin/home/update-account', data, function (response) {
				if (response.status) {
					App.alertAdmin({
						title: 'Conta alterada',
						text: 'Conta alterada com sucesso!',
						onClose: function () {
							App.redirect('admin/home');
						}
					});
				} else {
					App.alertAdmin({
						title: 'Erro na alteração',
						text: 'Houve algum erro na alteração, tente novamente mais tarde!'
					});
				}
			});
		} else {
			App.alertAdmin({
				title: 'Erro na alteração',
				text: 'A nova senha e a confirmação da senha não correspondem!'
			});

		}
	}
});