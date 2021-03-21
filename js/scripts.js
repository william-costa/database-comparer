$(".copiarChaves").click(function () {
	var servidor = $('input[name="bd[servidor]"]').val();
	var usuario = $('input[name="bd[usuario]"]').val();
	var porta = $('input[name="bd[porta]"]').val();
	var senha = $('input[name="bd[senha]"]').val();

	$('input[name="bd2[servidor]"]').val(servidor);
	$('input[name="bd2[porta]"]').val(porta);
	$('input[name="bd2[usuario]"]').val(usuario);
	$('input[name="bd2[senha]"]').val(senha);
});

$("#salvar-favorito").click((e) => {
	e.preventDefault();
	let continueTest = true;
	if ($('input[name="bd[servidor]"]').val().trim() == "") {
		alertBox("Campo Servidor em branco", "warning", 4000);
		continueTest = false;
	}
	if ($('input[name="bd[porta]"]').val().trim() == "") {
		alertBox("Campo Porta em branco", "warning", 4000);
		continueTest = false;
	}
	if ($('input[name="bd[banco]"]').val().trim() == "") {
		alertBox("Campo Banco em branco", "warning", 4000);
		continueTest = false;
	}
	if (continueTest) {
		$.ajax({
			url: ".",
			type: "POST",
			data: {
				salvar: "true",
				host: $('input[name="bd[servidor]"]').val(),
				port: $('input[name="bd[porta]"]').val(),
				user: $('input[name="bd[usuario]"]').val(),
				password: $('input[name="bd[senha]"]').val(),
				database: $('input[name="bd[banco]"]').val(),
			},
			success: function (data) {
				alertBox("Favorito salvo com sucesso!</a>", "success");
			},
			error: function (data) {
				alertBox("Não foi possível gravar o favorito. Tente liberar permissão na pasta do comparador <a href= class='alert-link'>sudo chmod -R 777</a>", "danger");
			}
		});
	}

})
$("#carregar-favorito").click((e) => {
	e.preventDefault();
	$.ajax({
		url: ".",
		type: "POST",
		data: { carregar: "true" },
		success: function (data) {
			data = JSON.parse(data);
			if (data.host == "" && data.port == "" && data.user == "" && data.password == "" && data.database == "") {
				alertBox("Registro não encontrado. Use o botão Salvar para cirar um novo registro", "danger");
			} else {
				$('input[name="bd[servidor]"]').val(data.host);
				$('input[name="bd[porta]"]').val(data.port);
				$('input[name="bd[usuario]"]').val(data.user);
				$('input[name="bd[senha]"]').val(data.password);
				$('input[name="bd[banco]"]').val(data.database);
			}
		}
	});
})

$("#limpar-campos").click((e) => {
	e.preventDefault();
	$('input[name="bd[servidor]"]').val("");
	$('input[name="bd[porta]"]').val("");
	$('input[name="bd[usuario]"]').val("");
	$('input[name="bd[senha]"]').val("");
	$('input[name="bd[banco]"]').val("");
})

$("#limpar-campos2").click((e) => {
	e.preventDefault();
	$('input[name="bd2[servidor]"]').val("");
	$('input[name="bd2[porta]"]').val("");
	$('input[name="bd2[usuario]"]').val("");
	$('input[name="bd2[senha]"]').val("");
	$('input[name="bd2[banco]"]').val("");
})


function alertBox(message, type, delayTime = 2000, fadeOutTime = 1000) {
	let continueTest = true;
	$(".alert").map((inde, alertBoxElement) => {
		if (alertBoxElement.innerText == message + "\n×") {
			continueTest = false;
		}
	})
	if (continueTest) {
		let alertHtmlBox = document.createElement("div");
		alertHtmlBox.innerHTML = message;
		alertHtmlBox.innerHTML += `
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>`;
		alertHtmlBox.classList.add("alert");
		alertHtmlBox.classList.add("alert-" + type);
		$(alertHtmlBox).delay(delayTime).fadeOut(fadeOutTime, function () {
			$(alertHtmlBox).remove();
		});
		$("h1").after(alertHtmlBox);
	}
}