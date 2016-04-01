function ValidarLogin(){
	var usuario = $("#txtUser").val();
	var password = $("#txtPass").val();
	var funcionAjax=$.ajax({
		url: "Validar.php",
		type: "post",
		data:{user:usuario,pass:password}
	});
	funcionAjax.done(function(retorno){
		console.log(retorno);
		if(retorno=="NoEsta"){	
				alert("El usuario no se encuentra");
				location.href="index.html";
			}else
			{
				alert("Usuario Logeado");
				location.href="index2.php";
			}
	});
	funcionAjax.fail(function(retorno){
		alert("Algo ha fallado");
	});
}

function ValidarRegistro(){

	var usuario = $("#txtUser2").val();
	var password = $("#txtPass2").val();
	var confirmPassword = $("#txtPass22").val();
	var funcionAjax=$.ajax({
		url: "registro.php",
		type: "post",
		data:{user:usuario,pass:password,pass2:confirmPassword}
	});
	debugger;
	funcionAjax.done(function(retorno){
		debugger;
		console.log(retorno);
		if(retorno=="NoEsta"){	
				alert("El usuario no pudo ser registrado. Reintentelo verificando que los datos ingresados sean correctos");
			}else
			{
				alert("Usuario Registrado");
			}
			location.href="index.html";
	});
	funcionAjax.fail(function(retorno){
		alert("Algo ha fallado");
	});

}